<?php
namespace App\Http\Controllers;
use App\Models\Car;
use App\Models\Review;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public const CITIES = [
        'Dhaka', 'Rajshahi', 'Barishal', 'Chittagong', 'Khulna', 'Sylhet',
        'Mymensingh', 'Comilla', 'Rangpur', 'Bogra', 'Jessore', 'Pabna', 'Narsingdi', 'Tangail', 'Cox\'s Bazar', 'Feni', 'Brahmanbaria', 'Dinajpur',
        'Noakhali', 'Gazipur', 'Narayanganj', 'Madaripur', 'Kushtia', 'Jamalpur', 'Patuakhali', 'Satkhira', 'Barguna', 'Bhola', 'Sirajganj', 'Kurigram', 'Thakurgaon',
        'Sherpur', 'Netrokona', 'Kishoreganj', 'Habiganj', 'Sunamganj', 'Lakshmipur', 'Jhalokathi', 'Pirojpur', 'Magura', 'Chuadanga', 'Meherpur', 'Narail', 'Jhenaidah', 'Bagerhat',   'Joypurhat', 'Naogaon', 'Natore', 'Chapainawabganj', 'Kushtia', 'Pabna', 'Sirajganj', 'Rajbari', 'Faridpur', 'Gopalganj', 'Shariatpur', 'Munshiganj', 'Gazipur', 'Narsingdi', 'Tangail', 'Mymensingh', 'Jamalpur', 'Sherpur', 'Netrokona', 'Bogra', 'Joypurhat', 'Naogaon', 'Natore', 'Pabna', 'Sirajganj', 'Rajshahi', 'Chapainawabganj', 'Kushtia', 'Jhenaidah', 'Magura', 'Narail', 'Jessore', 'Satkhira', 'Khulna', 'Bagerhat', 'Chuadanga', 'Meherpur', 'Kushtia', 'Jashore', 'Jhenaidah', 'Magura', 'Narail', 'Satkhira', 'Bagerhat', 'Chuadanga', 'Meherpur', 'Kushtia', 'Jashore', 'Jhenaidah', 'Magura', 'Narail', 'Satkhira', 'Bagerhat', 'Chuadanga', 'Meherpur',
    ];

    public const CATEGORIES = [
        'Hatchback', 'Sedan', 'SUV', 'Luxury', 'Sports', 'Electric',
    ];

    public function index(Request $request)
    {
        $query = Car::query();

        if ($request->filled('location')) {
            $query->byLocation($request->location);
        }

        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        if ($request->filled('availability')) {
            $query->where('availability', $request->availability);
        } else {
            $query->where('availability', 'available');
        }

        if ($request->filled('min_price')) {
            $query->priceRange((int) $request->min_price, null);
        }

        if ($request->filled('max_price')) {
            $query->priceRange(null, (int) $request->max_price);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('brand', 'like', "%{$search}%")
                  ->orWhere('model', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        $cars = $query->orderBy('rating', 'desc')->paginate(12);

        return view('cars.index', [
            'cars' => $cars,
            'cities' => self::CITIES,
            'categories' => self::CATEGORIES,
            'filters' => $request->all(),
        ]);
    }

    public function show(string $id)
    {
        $car = Car::findOrFail($id);
        $reviews = Review::where('car_id', $id)->orderBy('created_at', 'desc')->get();

        return view('cars.show', compact('car', 'reviews'));
    }

    public function home()
    {
        $featuredCars = Car::where('availability', 'available')
            ->orderBy('rating', 'desc')
            ->limit(6)
            ->get();

        $categories = self::CATEGORIES;

        return view('home', compact('featuredCars', 'categories'));
    }
}
