@extends('layouts.admin')

@section('title', 'Booking Detail')
@section('page-title', 'Booking Detail')

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="glass-card p-4" style="border-top:4px solid #e8192c">
            <h5 style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:24px">
                <i class="bi bi-info-circle me-2" style="color:#e8192c"></i>Booking Information
            </h5>
            <table class="table mb-0">
                <tr><th style="width:35%;color:#6c757d;font-weight:600;font-size:0.85rem;border-color:#f3f4f6">Customer</th><td style="color:#1a1a2e;font-weight:600;border-color:#f3f4f6">{{ $booking->customer_name }}</td></tr>
                <tr><th style="color:#6c757d;font-weight:600;font-size:0.85rem;border-color:#f3f4f6">Car</th><td style="color:#1a1a2e;font-weight:600;border-color:#f3f4f6">{{ $booking->car_name }}</td></tr>
                <tr><th style="color:#6c757d;font-weight:600;font-size:0.85rem;border-color:#f3f4f6">Pickup Date</th><td style="color:#1a1a2e;border-color:#f3f4f6">{{ $booking->pickup_date }}</td></tr>
                <tr><th style="color:#6c757d;font-weight:600;font-size:0.85rem;border-color:#f3f4f6">Return Date</th><td style="color:#1a1a2e;border-color:#f3f4f6">{{ $booking->return_date }}</td></tr>
                <tr><th style="color:#6c757d;font-weight:600;font-size:0.85rem;border-color:#f3f4f6">Journey Start</th><td style="color:#1a1a2e;border-color:#f3f4f6">{{ $booking->pickup_location ?? 'N/A' }}</td></tr>
                <tr><th style="color:#6c757d;font-weight:600;font-size:0.85rem;border-color:#f3f4f6">Journey End</th><td style="color:#1a1a2e;border-color:#f3f4f6">{{ $booking->dropoff_location ?? 'N/A' }}</td></tr>
                <tr><th style="color:#6c757d;font-weight:600;font-size:0.85rem;border-color:#f3f4f6">Rental Days</th><td style="color:#1a1a2e;border-color:#f3f4f6">{{ $booking->rental_days ?? 'N/A' }}</td></tr>
                <tr><th style="color:#6c757d;font-weight:600;font-size:0.85rem;border-color:#f3f4f6">Total Amount</th><td style="color:#10b981;font-weight:700;font-size:1.1rem;border-color:#f3f4f6">{{ $booking->total_amount }}</td></tr>
                <tr><th style="color:#6c757d;font-weight:600;font-size:0.85rem;border-color:#f3f4f6">Status</th><td style="border-color:#f3f4f6"><span class="status-badge-{{ $booking->status }}">{{ ucfirst($booking->status) }}</span></td></tr>
            </table>
            @if($booking->status === 'pending')
            <div class="mt-4 d-flex gap-2">
                <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-primary"><i class="bi bi-check-circle me-2"></i>Approve Booking</button>
                </form>
                <form action="{{ route('admin.bookings.reject', $booking->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-danger"><i class="bi bi-x-circle me-2"></i>Reject Booking</button>
                </form>
            </div>
            @endif
            <a href="{{ route('admin.bookings') }}" class="btn btn-outline-red mt-3">
                <i class="bi bi-arrow-left me-2"></i>Back to Bookings
            </a>
        </div>
    </div>
    @if($car)
    <div class="col-lg-4">
        <div class="glass-card p-4" style="border-top:4px solid #3b82f6">
            <h5 style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:16px">
                <i class="bi bi-car-front me-2" style="color:#3b82f6"></i>Car Details
            </h5>
            @include('partials.car-image', ['car' => $car, 'class' => 'img-fluid rounded mb-3'])
            <h5 style="color:#1a1a2e;font-family:'Montserrat',sans-serif;font-weight:700">{{ $car->display_name }}</h5>
            <p style="color:#6c757d;font-size:0.85rem;margin:4px 0">
                <i class="bi bi-geo-alt me-1" style="color:#e8192c"></i>{{ $car->location }}
            </p>
            <p style="color:#e8192c;font-weight:700;margin:4px 0">{{ $car->formatted_price }}</p>
            <span style="background:{{ $car->availability==='available'?'#d1fae5':'#f3f4f6' }};color:{{ $car->availability==='available'?'#065f46':'#6b7280' }};padding:4px 12px;border-radius:20px;font-size:0.78rem;font-weight:600">
                {{ ucfirst($car->availability) }}
            </span>
        </div>
    </div>
    @endif
</div>
@endsection
