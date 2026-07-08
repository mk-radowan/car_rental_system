<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request, int $carId)
    {
        $car = Car::findOrFail($carId);

        $validated = $request->validate([
            'pickup_date' => ['required', 'date', 'after_or_equal:today'],
            'return_date' => ['required', 'date', 'after:pickup_date'],
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

        Booking::create([
            'user_id' => auth()->id(),
            'car_id' => $carId,
            'pickup_date' => $pickup,
            'return_date' => $return,
            'rental_days' => $days,
            'total_amount' => '৳'.number_format($total),
            'status' => 'pending',
            'customer_name' => auth()->user()->name,
            'car_name' => $car->display_name,
        ]);

        return redirect()->route('bookings.history')
            ->with('success', 'Booking request sent successfully. Waiting for admin approval.');
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
