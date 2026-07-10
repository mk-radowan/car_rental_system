<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function store(Request $request, int $carId)
    {
        $car = Car::findOrFail($carId);

        $validated = $request->validate([
            'pickup_date' => ['required', 'date', 'after_or_equal:today'],
            'return_date' => ['required', 'date', 'after:pickup_date'],
            'pickup_location' => ['required', 'string', 'max:255', 'regex:/^Division\s*:\s*.+,\s*.+,\s*.+$/i'],
            'dropoff_location' => ['required', 'string', 'max:255', 'regex:/^Division\s*:\s*.+,\s*.+,\s*.+$/i'],
        ]);

        if (!$car->isAvailable()) {
            return back()->with('error', 'This car is not available for booking.');
        }

        $pickup = Carbon::parse($validated['pickup_date'])->format('d/m/Y');
        $return = Carbon::parse($validated['return_date'])->format('d/m/Y');

        if (Booking::hasOverlappingBooking($carId, $pickup, $return)) {
            return back()->with('error', 'This car is already booked for the selected dates. Please choose different dates.');
        }

        $days = Carbon::parse($validated['pickup_date'])->diffInDays(Carbon::parse($validated['return_date'])) + 1;
        $total = $car->price_per_day * $days;

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'car_id' => $carId,
            'pickup_date' => $pickup,
            'return_date' => $return,
            'pickup_location' => $validated['pickup_location'],
            'dropoff_location' => $validated['dropoff_location'],
            'rental_days' => $days,
            'total_amount' => '৳' . number_format($total),
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'customer_name' => auth()->user()->name,
            'car_name' => $car->display_name,
        ]);

        return redirect()->route('bookings.payment.show', $booking)
            ->with('success', 'Booking request created. Please complete your payment.');
    }

    public function showPayment(Booking $booking)
    {
        if ((int) $booking->user_id !== (int) auth()->id()) {
            abort(403);
        }

        if ($booking->payment_status === 'paid') {
            return redirect()->route('bookings.history')
                ->with('success', 'Payment is already completed for this booking.');
        }

        return view('bookings.payment', compact('booking'));
    }

    public function processPayment(Request $request, Booking $booking)
    {
        if ((int) $booking->user_id !== (int) auth()->id()) {
            abort(403);
        }

        if ($booking->payment_status === 'paid') {
            return redirect()->route('bookings.history')
                ->with('success', 'Payment is already completed for this booking.');
        }

        $validated = $request->validate([
            'payment_method' => ['required', 'in:bkash,nagad,rocket,card'],
            'payment_provider' => ['required', 'in:sslcommerz,bkash_pgw'],
        ]);

        $method = $validated['payment_method'];
        $provider = $validated['payment_provider'];

        if ($provider === 'bkash_pgw' && $method !== 'bkash') {
            return back()->withErrors([
                'payment_method' => 'bKash PGW provider supports only bKash method.',
            ])->withInput();
        }

        if ($provider === 'sslcommerz') {
            return $this->initiateSslCommerzPayment($booking, $method);
        }

        return $this->initiateBkashPayment($booking);
    }

    public function sslCommerzSuccess(Request $request, Booking $booking)
    {
        $tranId = (string) $request->input('tran_id', '');
        $status = strtoupper((string) $request->input('status', ''));

        if ($tranId === '' || $tranId !== (string) $booking->payment_reference || !in_array($status, ['VALID', 'VALIDATED'], true)) {
            return redirect()->route('payments.result', ['booking' => $booking->id, 'result' => 'failed']);
        }

        $booking->update([
            'payment_status' => 'paid',
            'paid_at' => now(),
        ]);

        return redirect()->route('payments.result', ['booking' => $booking->id, 'result' => 'success']);
    }

    public function sslCommerzFail(Booking $booking)
    {
        $booking->update([
            'payment_status' => 'failed',
        ]);

        return redirect()->route('payments.result', ['booking' => $booking->id, 'result' => 'failed']);
    }

    public function sslCommerzCancel(Booking $booking)
    {
        $booking->update([
            'payment_status' => 'cancelled',
        ]);

        return redirect()->route('payments.result', ['booking' => $booking->id, 'result' => 'cancelled']);
    }

    public function bkashCallback(Request $request, Booking $booking)
    {
        $status = strtolower((string) $request->input('status', ''));
        $paymentId = (string) $request->input('paymentID', '');

        if (!in_array($status, ['success', 'completed'], true)) {
            $booking->update(['payment_status' => 'failed']);

            return redirect()->route('payments.result', ['booking' => $booking->id, 'result' => 'failed']);
        }

        $booking->update([
            'payment_status' => 'paid',
            'paid_at' => now(),
            'payment_reference' => $paymentId !== '' ? $paymentId : $booking->payment_reference,
        ]);

        return redirect()->route('payments.result', ['booking' => $booking->id, 'result' => 'success']);
    }

    public function paymentResult(Request $request, Booking $booking)
    {
        $result = $request->query('result', $booking->payment_status ?? 'pending');

        return view('bookings.payment-result', [
            'booking' => $booking,
            'result' => $result,
        ]);
    }

    public function invoice(Booking $booking)
    {
        if ((int) $booking->user_id !== (int) auth()->id()) {
            abort(403);
        }

        return view('bookings.invoice', compact('booking'));
    }

    public function downloadInvoice(Booking $booking)
    {
        if ((int) $booking->user_id !== (int) auth()->id()) {
            abort(403);
        }

        $filename = 'invoice-' . $booking->id . '.pdf';
        $pdf = Pdf::loadView('bookings.invoice-download', compact('booking'))
            ->setPaper('a4');

        return $pdf->download($filename);
    }

    private function initiateSslCommerzPayment(Booking $booking, string $method)
    {
        $baseUrl = rtrim((string) env('SSLCOMMERZ_BASE_URL', 'https://sandbox.sslcommerz.com'), '/');
        $storeId = (string) env('SSLCOMMERZ_STORE_ID', '');
        $storePassword = (string) env('SSLCOMMERZ_STORE_PASSWORD', '');

        if ($storeId === '' || $storePassword === '') {
            return back()->with('error', 'SSLCommerz credentials not set. Add SSLCOMMERZ_STORE_ID and SSLCOMMERZ_STORE_PASSWORD in .env');
        }

        $amount = (float) preg_replace('/[^0-9.]/', '', (string) $booking->total_amount);
        $tranId = 'CRS-' . $booking->id . '-' . strtoupper(Str::random(6));

        $booking->update([
            'payment_method' => $method,
            'payment_status' => 'processing',
            'payment_reference' => $tranId,
        ]);

        $payload = [
            'store_id' => $storeId,
            'store_passwd' => $storePassword,
            'total_amount' => number_format($amount, 2, '.', ''),
            'currency' => 'BDT',
            'tran_id' => $tranId,
            'success_url' => route('payments.ssl.success', $booking->id),
            'fail_url' => route('payments.ssl.fail', $booking->id),
            'cancel_url' => route('payments.ssl.cancel', $booking->id),
            'cus_name' => $booking->customer_name,
            'cus_email' => auth()->user()->email ?? 'customer@example.com',
            'cus_phone' => auth()->user()->phone ?? '01700000000',
            'product_name' => $booking->car_name,
            'product_category' => 'Car Rental',
            'product_profile' => 'general',
            'shipping_method' => 'NO',
            'multi_card_name' => strtoupper($method),
            'value_a' => (string) $booking->id,
        ];

        $response = Http::asForm()->post($baseUrl . '/gwprocess/v4/api.php', $payload);
        $data = $response->json();

        if ($response->failed() || empty($data['GatewayPageURL'])) {
            Log::error('SSLCommerz init failed', ['booking_id' => $booking->id, 'response' => $data]);

            return back()->with('error', 'Could not initiate SSLCommerz payment. Please try again.');
        }

        return redirect()->away($data['GatewayPageURL']);
    }

    private function initiateBkashPayment(Booking $booking)
    {
        $baseUrl = rtrim((string) env('BKASH_BASE_URL', 'https://tokenized.sandbox.bka.sh/v1.2.0-beta'), '/');
        $appKey = (string) env('BKASH_APP_KEY', '');
        $appSecret = (string) env('BKASH_APP_SECRET', '');
        $username = (string) env('BKASH_USERNAME', '');
        $password = (string) env('BKASH_PASSWORD', '');

        if ($appKey === '' || $appSecret === '' || $username === '' || $password === '') {
            return back()->with('error', 'bKash PGW credentials not set. Add BKASH_* keys in .env');
        }

        $grantResponse = Http::withHeaders([
            'username' => $username,
            'password' => $password,
            'Content-Type' => 'application/json',
        ])->post($baseUrl . '/tokenized/checkout/token/grant', [
            'app_key' => $appKey,
            'app_secret' => $appSecret,
        ]);

        $grantData = $grantResponse->json();
        $token = $grantData['id_token'] ?? null;

        if ($grantResponse->failed() || !$token) {
            Log::error('bKash token grant failed', ['booking_id' => $booking->id, 'response' => $grantData]);

            return back()->with('error', 'Could not connect to bKash gateway.');
        }

        $invoice = 'BK' . $booking->id . now()->format('His');
        $amount = number_format((float) preg_replace('/[^0-9.]/', '', (string) $booking->total_amount), 2, '.', '');

        $booking->update([
            'payment_method' => 'bkash',
            'payment_status' => 'processing',
            'payment_reference' => $invoice,
        ]);

        $createResponse = Http::withToken($token)
            ->withHeaders([
                'X-APP-Key' => $appKey,
                'Content-Type' => 'application/json',
            ])
            ->post($baseUrl . '/tokenized/checkout/create', [
                'mode' => '0011',
                'payerReference' => (string) $booking->user_id,
                'callbackURL' => route('payments.bkash.callback', $booking->id),
                'amount' => $amount,
                'currency' => 'BDT',
                'intent' => 'sale',
                'merchantInvoiceNumber' => $invoice,
            ]);

        $createData = $createResponse->json();
        $bkashUrl = $createData['bkashURL'] ?? null;

        if ($createResponse->failed() || !$bkashUrl) {
            Log::error('bKash create payment failed', ['booking_id' => $booking->id, 'response' => $createData]);

            return back()->with('error', 'Could not initiate bKash payment.');
        }

        return redirect()->away($bkashUrl);

        $booking->update([
            'payment_method' => $method,
            'payment_status' => 'paid',
            'payment_reference' => $paymentReference,
            'paid_at' => now(),
        ]);

        return redirect()->route('bookings.history')
            ->with('success', 'Payment successful via ' . strtoupper($method) . '. Ref: ' . $paymentReference);
    }

    public function history()
    {
        $bookings = Booking::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        $pending = $bookings->where('status', 'pending');
        $approved = $bookings->where('status', 'approved');
        $rejected = $bookings->where('status', 'rejected');

        return view('bookings.history', compact('bookings', 'pending', 'approved', 'rejected'));
    }

    public function dashboard()
    {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        $userId = auth()->id();

        $pendingBookings = Booking::where('user_id', $userId)
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        $approvedBookings = Booking::where('user_id', $userId)
            ->where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $totalBookings = Booking::where('user_id', $userId)->count();

        return view('dashboard', compact('pendingBookings', 'approvedBookings', 'totalBookings'));
    }
}
