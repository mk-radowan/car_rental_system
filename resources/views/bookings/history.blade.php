@extends('layouts.app')

@section('title', 'Booking History')

@section('content')

    <div style="background:linear-gradient(135deg,#1a1a2e 0%,#16213e 100%);padding:80px 0 60px">
        <div class="container" style="padding-top:40px">
            <div class="hero-badge" style="background:rgba(255,255,255,0.1);color:white;border-color:rgba(255,255,255,0.2)">My
                Bookings</div>
            <h1 style="font-family:'Montserrat',sans-serif;font-weight:800;color:white;font-size:2rem;margin-top:12px">
                Booking History</h1>
            <p style="color:rgba(255,255,255,0.6);margin:0">Track all your car rental bookings</p>
        </div>
    </div>

    <div class="container py-5" style="margin-top:-20px">
        <div class="glass-card" style="overflow:hidden;border-top:4px solid #e8192c">
            @if ($bookings->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-calendar-x" style="font-size:4rem;color:#e8192c;opacity:0.3"></i>
                    <h5 style="color:#1a1a2e;margin-top:20px;font-family:'Montserrat',sans-serif;font-weight:700">No
                        Bookings Yet</h5>
                    <p style="color:#6c757d">You haven't made any bookings yet. Start exploring our fleet!</p>
                    <a href="{{ route('cars.index') }}" class="btn btn-primary">
                        <i class="bi bi-car-front me-2"></i> Browse Cars
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th><i class="bi bi-car-front me-2"></i>Car</th>
                                <th><i class="bi bi-calendar me-2"></i>Pickup</th>
                                <th><i class="bi bi-calendar-check me-2"></i>Return</th>
                                <th><i class="bi bi-sign-turn-right me-2"></i>Journey Route</th>
                                <th><span class="me-2" style="font-weight:700">৳</span>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td>
                                        <strong style="color:#1a1a2e">{{ $booking->car_name }}</strong>
                                    </td>
                                    <td style="color:#374151">{{ $booking->pickup_date }}</td>
                                    <td style="color:#374151">{{ $booking->return_date }}</td>
                                    <td style="color:#374151;font-size:0.82rem;line-height:1.5">
                                        <div><strong>Start:</strong> {{ $booking->pickup_location ?? 'N/A' }}</div>
                                        <div><strong>End:</strong> {{ $booking->dropoff_location ?? 'N/A' }}</div>
                                    </td>
                                    <td>
                                        <strong style="color:#10b981">{{ $booking->total_amount }}</strong>
                                    </td>
                                    <td>
                                        <span class="status-badge-{{ $booking->status }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="mt-4 d-flex gap-3">
            <a href="{{ route('cars.index') }}" class="btn btn-primary">
                <i class="bi bi-car-front me-2"></i>Browse More Cars
            </a>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-red">
                <i class="bi bi-grid me-2"></i>Dashboard
            </a>
        </div>
    </div>
@endsection
