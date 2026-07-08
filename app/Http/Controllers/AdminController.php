<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Models\User;
use App\Http\Controllers\CarController;
use Illuminate\Http\Request;

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

    public function bookings()
    {
        $bookings = Booking::orderBy('created_at', 'desc')->get();
        return view('admin.bookings', compact('bookings'));
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
