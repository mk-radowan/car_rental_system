<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Car extends Model
{
    protected $fillable = [
        'brand',
        'model',
        'category',
        'location',
        'availability',
        'fuel_type',
        'transmission',
        'seats',
        'price_per_day',
        'rating',
        'image',
        'description',
    ];

    protected $casts = [
        'price_per_day' => 'integer',
        'seats' => 'integer',
        'rating' => 'float',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'car_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'car_id');
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->brand . ' ' . $this->model;
    }

    public function getFormattedPriceAttribute(): string
    {
        return '৳' . number_format($this->price_per_day) . '/day';
    }

    // MAIN IMAGE URL
    public function getImageUrlAttribute(): string
    {
        // if image filename exists in DB
        if (!empty($this->image)) {
            return asset('images/cars/models/' . $this->image);
        }

        return asset($this->categoryImagePath());
    }

    // FALLBACK IMAGE
    public function categoryImagePath(): string
    {
        $slug = Str::slug($this->brand . '-' . $this->model);

        foreach (['jpg', 'png', 'webp'] as $ext) {
            $path = "images/cars/models/{$slug}.{$ext}";

            if (file_exists(public_path($path))) {
                return $path;
            }
        }

        return "images/cars/default.svg";
    }

    public function getFallbackImageUrlAttribute(): string
    {
        return asset($this->categoryImagePath());
    }

    public function isAvailable(): bool
    {
        return $this->availability === 'available';
    }

    public function scopeAvailable($query)
    {
        return $query->where('availability', 'available');
    }

    public function scopeByLocation($query, ?string $location)
    {
        if ($location) {
            return $query->where('location', 'like', '%' . trim($location) . '%');
        }

        return $query;
    }

    public function scopeByCategory($query, ?string $category)
    {
        if ($category) {
            return $query->where('category', $category);
        }

        return $query;
    }

    public function scopePriceRange($query, ?int $min, ?int $max)
    {
        if ($min) {
            $query->where('price_per_day', '>=', $min);
        }

        if ($max) {
            $query->where('price_per_day', '<=', $max);
        }

        return $query;
    }
}