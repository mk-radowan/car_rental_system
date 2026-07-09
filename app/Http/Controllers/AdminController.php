<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Models\User;
use App\Http\Controllers\CarController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::where('role', 'customer')->count(),
            'total_cars' => Car::count(),
            'total_bookings' => Booking::count(),
            'pending' => Booking::where('status', 'pending')->count(),
            'approved' => Booking::where('status', 'approved')->count(),
            'rejected' => Booking::where('status', 'rejected')->count(),
        ];

        $recentBookings = Booking::orderBy('created_at', 'desc')->limit(10)->get();

        $availableCars = Car::where('availability', 'available')->count();
        $bookedCars = Car::where('availability', 'booked')->count();

        return view('admin.dashboard', compact('stats', 'recentBookings', 'availableCars', 'bookedCars'));
    }

    public function cars()
    {
        $cars = Car::orderBy('created_at', 'desc')->get();
        return view('admin.cars.index', [
            'cars' => $cars,
            'cities' => CarController::CITIES,
            'categories' => CarController::CATEGORIES,
        ]);
    }

    public function createCar()
    {
        return view('admin.cars.create', [
            'cities' => CarController::CITIES,
            'categories' => CarController::CATEGORIES,
        ]);
    }

    public function storeCar(Request $request)
    {
        $validated = $request->validate([
            'brand' => ['required', 'string', 'max:100'],
            'model' => ['required', 'string', 'max:100'],
            'category' => ['required', 'string'],
            'location' => ['required', 'string'],
            'fuel_type' => ['required', 'string'],
            'transmission' => ['required', 'string'],
            'seats' => ['required', 'integer', 'min:2', 'max:9'],
            'price_per_day' => ['required', 'integer', 'min:100'],
            'rating' => ['required', 'numeric', 'min:1', 'max:5'],
            'image' => ['required', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'availability' => ['required', 'in:available,booked'],
        ]);

        Car::create($validated);

        return redirect()->route('admin.cars')
            ->with('success', 'Car added successfully.');
    }

    public function editCar(string $id)
    {
        $car = Car::findOrFail($id);
        return view('admin.cars.edit', [
            'car' => $car,
            'cities' => CarController::CITIES,
            'categories' => CarController::CATEGORIES,
        ]);
    }

    public function updateCar(Request $request, string $id)
    {
        $car = Car::findOrFail($id);

        $validated = $request->validate([
            'brand' => ['required', 'string', 'max:100'],
            'model' => ['required', 'string', 'max:100'],
            'category' => ['required', 'string'],
            'location' => ['required', 'string'],
            'fuel_type' => ['required', 'string'],
            'transmission' => ['required', 'string'],
            'seats' => ['required', 'integer', 'min:2', 'max:9'],
            'price_per_day' => ['required', 'integer', 'min:100'],
            'rating' => ['required', 'numeric', 'min:1', 'max:5'],
            'image' => ['required', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'availability' => ['required', 'in:available,booked'],
        ]);

        $car->update($validated);

        return redirect()->route('admin.cars')
            ->with('success', 'Car updated successfully.');
    }

    public function destroyCar(string $id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return redirect()->route('admin.cars')
            ->with('success', 'Car deleted successfully.');
    }

    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users-create');
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique(User::class, 'email')],
            'phone' => ['required', 'digits:11'],
            'password' => ['required', 'string', 'min:6'],
            'role' => ['required', Rule::in(['admin', 'customer'])],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'is_active' => true,
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    public function editUser(string $id)
    {
        $user = User::findOrFail($id);

        return view('admin.users-edit', compact('user'));
    }

    public function updateUser(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique(User::class, 'email')->ignore($user->id)],
            'phone' => ['required', 'digits:11'],
            'role' => ['required', Rule::in(['admin', 'customer'])],
            'password' => ['nullable', 'string', 'min:6'],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];
        $user->role = $validated['role'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function toggleUserStatus(string $id)
    {
        $user = User::findOrFail($id);

        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot disable your own account.');
        }

        $user->is_active = !$user->is_active;
        $user->save();

        $statusMessage = $user->is_active ? 'enabled' : 'disabled';

        return back()->with('success', 'User ' . $statusMessage . ' successfully.');
    }

    public function destroyUser(string $id)
    {
        $user = User::findOrFail($id);

        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }

    public function bookings()
    {
        $bookings = Booking::orderBy('created_at', 'desc')->get();
        return view('admin.bookings', compact('bookings'));
    }

    public function createBookingForCustomer()
    {
        $customers = User::where('role', 'customer')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $cars = Car::where('availability', 'available')
            ->orderBy('brand')
            ->orderBy('model')
            ->get();

        return view('admin.booking-car-create', compact('customers', 'cars'));
    }

    public function storeBookingForCustomer(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'car_id' => ['required', 'exists:cars,id'],
            'pickup_date' => ['required', 'date', 'after_or_equal:today'],
            'return_date' => ['required', 'date', 'after:pickup_date'],
            'pickup_location' => ['required', 'string', 'max:255', 'regex:/^Division\s*:\s*.+,\s*.+(?:,\s*.+)?$/i'],
            'dropoff_location' => ['required', 'string', 'max:255', 'regex:/^Division\s*:\s*.+,\s*.+(?:,\s*.+)?$/i'],
            'pickup_city' => ['nullable', 'string', 'max:100'],
            'pickup_pourosova' => ['nullable', 'string', 'max:100'],
            'pickup_ward' => ['nullable', 'string', 'max:50'],
            'dropoff_city' => ['nullable', 'string', 'max:100'],
            'dropoff_pourosova' => ['nullable', 'string', 'max:100'],
            'dropoff_ward' => ['nullable', 'string', 'max:50'],
        ]);

        $user = User::findOrFail((int) $validated['user_id']);
        $car = Car::findOrFail((int) $validated['car_id']);

        if ($user->role !== 'customer' || !$user->is_active) {
            return back()->with('error', 'Please select a valid active customer.')->withInput();
        }

        if (!$car->isAvailable()) {
            return back()->with('error', 'Selected car is not available.')->withInput();
        }

        $pickup = Carbon::parse($validated['pickup_date'])->format('d/m/Y');
        $return = Carbon::parse($validated['return_date'])->format('d/m/Y');

        if (Booking::hasOverlappingBooking($car->id, $pickup, $return)) {
            return back()->with('error', 'This car is already booked for these dates.')->withInput();
        }

        $days = Carbon::parse($validated['pickup_date'])->diffInDays(Carbon::parse($validated['return_date'])) + 1;
        $total = $car->price_per_day * $days;

        $pickupLocation = $this->buildRouteLocation(
            $validated['pickup_location'],
            $validated['pickup_city'] ?? null,
            $validated['pickup_pourosova'] ?? null,
            $validated['pickup_ward'] ?? null
        );

        $dropoffLocation = $this->buildRouteLocation(
            $validated['dropoff_location'],
            $validated['dropoff_city'] ?? null,
            $validated['dropoff_pourosova'] ?? null,
            $validated['dropoff_ward'] ?? null
        );

        Booking::create([
            'user_id' => $user->id,
            'car_id' => $car->id,
            'pickup_date' => $pickup,
            'return_date' => $return,
            'pickup_location' => $pickupLocation,
            'dropoff_location' => $dropoffLocation,
            'rental_days' => $days,
            'total_amount' => '৳' . number_format($total),
            'status' => 'approved',
            'customer_name' => $user->name,
            'car_name' => $car->display_name,
        ]);

        $car->availability = 'booked';
        $car->save();

        return redirect()->route('admin.bookings')->with('success', 'Booking created successfully for customer.');
    }

    private function buildRouteLocation(string $baseLocation, ?string $city, ?string $pourosova, ?string $ward): string
    {
        $parts = [$baseLocation];

        if (!empty($city)) {
            $parts[] = 'City: ' . trim($city);
        }

        if (!empty($pourosova)) {
            $parts[] = 'Pourosova: ' . trim($pourosova);
        }

        if (!empty($ward)) {
            $parts[] = 'Ward: ' . trim($ward);
        }

        return implode(' | ', $parts);
    }

    public function approveBooking(string $id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Only pending bookings can be approved.');
        }

        $car = Car::find($booking->car_id);
        if (!$car) {
            return back()->with('error', 'Car not found.');
        }

        if (Booking::hasOverlappingBooking($booking->car_id, $booking->pickup_date, $booking->return_date, $id)) {
            return back()->with('error', 'Cannot approve: overlapping booking exists for these dates.');
        }

        $booking->status = 'approved';
        $booking->save();

        $car->availability = 'booked';
        $car->save();

        return back()->with('success', 'Booking approved. Car marked as booked.');
    }

    public function rejectBooking(string $id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Only pending bookings can be rejected.');
        }

        $booking->status = 'rejected';
        $booking->save();

        return back()->with('success', 'Booking rejected. Car remains available.');
    }

    public function viewBooking(string $id)
    {
        $booking = Booking::findOrFail($id);
        $user = User::find($booking->user_id);
        $car = Car::find($booking->car_id);

        return view('admin.booking-detail', compact('booking', 'user', 'car'));
    }

    public function analytics()
    {
        $bookingsByStatus = [
            'pending' => Booking::where('status', 'pending')->count(),
            'approved' => Booking::where('status', 'approved')->count(),
            'rejected' => Booking::where('status', 'rejected')->count(),
        ];

        $categoryStats = Car::query()
            ->selectRaw('category, COUNT(*) as total')
            ->groupBy('category')
            ->pluck('total', 'category')
            ->toArray();

        $cityStats = Car::all()->groupBy('location')->map->count()->toArray();

        return view('admin.analytics', compact('bookingsByStatus', 'categoryStats', 'cityStats'));
    }
}
