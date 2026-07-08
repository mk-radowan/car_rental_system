@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-md-4 col-lg-2">
            <div class="glass-card stat-card primary">
                <div style="font-size:1.8rem;color:#e8192c;margin-bottom:8px"><i class="bi bi-people"></i></div>
                <div class="stat-value">{{ $stats['total_users'] }}</div>
                <div class="stat-label">Total Users</div>
            </div>
        </div>
        <div class="col-md-4 col-lg-2">
            <div class="glass-card stat-card info">
                <div style="font-size:1.8rem;color:#3b82f6;margin-bottom:8px"><i class="bi bi-car-front"></i></div>
                <div class="stat-value">{{ $stats['total_cars'] }}</div>
                <div class="stat-label">Total Cars</div>
            </div>
        </div>
        <div class="col-md-4 col-lg-2">
            <div class="glass-card stat-card success">
                <div style="font-size:1.8rem;color:#10b981;margin-bottom:8px"><i class="bi bi-calendar-check"></i></div>
                <div class="stat-value">{{ $stats['total_bookings'] }}</div>
                <div class="stat-label">Total Bookings</div>
            </div>
        </div>
        <div class="col-md-4 col-lg-2">
            <div class="glass-card stat-card warning">
                <div style="font-size:1.8rem;color:#f59e0b;margin-bottom:8px"><i class="bi bi-hourglass-split"></i></div>
                <div class="stat-value">{{ $stats['pending'] }}</div>
                <div class="stat-label">Pending</div>
            </div>
        </div>
        <div class="col-md-4 col-lg-2">
            <div class="glass-card stat-card success">
                <div style="font-size:1.8rem;color:#10b981;margin-bottom:8px"><i class="bi bi-check-circle"></i></div>
                <div class="stat-value">{{ $stats['approved'] }}</div>
                <div class="stat-label">Approved</div>
            </div>
        </div>
        <div class="col-md-4 col-lg-2">
            <div class="glass-card stat-card danger">
                <div style="font-size:1.8rem;color:#e8192c;margin-bottom:8px"><i class="bi bi-x-circle"></i></div>
                <div class="stat-value">{{ $stats['rejected'] }}</div>
                <div class="stat-label">Rejected</div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="glass-card p-4" style="border-left:4px solid #e8192c">
                <h5 style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:16px">
                    <i class="bi bi-bar-chart me-2" style="color:#e8192c"></i>Fleet Availability
                </h5>
                <div class="d-flex gap-4">
                    <div>
                        <div style="font-family:'Montserrat',sans-serif;font-weight:800;font-size:1.8rem;color:#10b981">
                            {{ $availableCars }}</div>
                        <div style="font-size:0.82rem;color:#6c757d">Available</div>
                    </div>
                    <div>
                        <div style="font-family:'Montserrat',sans-serif;font-weight:800;font-size:1.8rem;color:#f59e0b">
                            {{ $bookedCars }}</div>
                        <div style="font-size:0.82rem;color:#6c757d">Booked</div>
                    </div>
                </div>
                <div style="margin-top:16px;background:#f3f4f6;border-radius:8px;height:8px;overflow:hidden">
                    @php
                        $total = $availableCars + $bookedCars;
                        $pct = $total > 0 ? round(($availableCars / $total) * 100) : 0;
                    @endphp
                    <div
                        style="height:100%;width:{{ $pct }}%;background:#10b981;border-radius:8px;transition:width 0.5s">
                    </div>
                </div>
                <p style="font-size:0.78rem;color:#6c757d;margin:6px 0 0">{{ $pct }}% fleet available</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="glass-card p-4" style="border-left:4px solid #3b82f6">
                <h5 style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:16px">
                    <i class="bi bi-lightning-charge me-2" style="color:#3b82f6"></i>Quick Actions
                </h5>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('admin.cars.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i>Add Car
                    </a>
                    <a href="{{ route('admin.bookings') }}" class="btn btn-sm"
                        style="background:#fef3c7;color:#92400e;border:none;border-radius:20px;font-weight:600">
                        <i class="bi bi-clock me-1"></i>View Requests
                    </a>
                    <a href="{{ route('admin.analytics') }}" class="btn btn-sm"
                        style="background:#f0f9ff;color:#0369a1;border:none;border-radius:20px;font-weight:600">
                        <i class="bi bi-bar-chart me-1"></i>Analytics
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="glass-card" style="overflow:hidden">
        <div
            style="padding:20px 24px;border-bottom:1px solid #f3f4f6;display:flex;justify-content:space-between;align-items:center">
            <h5 style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e;margin:0">
                <i class="bi bi-clock-history me-2" style="color:#e8192c"></i>Recent Bookings
            </h5>
            <a href="{{ route('admin.bookings') }}"
                style="font-size:0.85rem;color:#e8192c;text-decoration:none;font-weight:600">View All →</a>
        </div>
        <div class="table-responsive admin-table">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Car</th>
                        <th>Pickup</th>
                        <th>Return</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentBookings as $booking)
                        <tr>
                            <td><strong>{{ $booking->customer_name }}</strong></td>
                            <td>{{ $booking->car_name }}</td>
                            <td>{{ $booking->pickup_date }}</td>
                            <td>{{ $booking->return_date }}</td>
                            <td><span class="status-badge-{{ $booking->status }}">{{ ucfirst($booking->status) }}</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.bookings.view', $booking->id) }}" class="btn btn-sm"
                                    style="background:#f3f4f6;color:#374151;border:none;border-radius:20px">View</a>
                                @if ($booking->status === 'pending')
                                    <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST"
                                        class="d-inline">@csrf<button class="btn btn-sm"
                                            style="background:#d1fae5;color:#065f46;border:none;border-radius:20px;margin:0 2px">✓
                                            Approve</button></form>
                                    <form action="{{ route('admin.bookings.reject', $booking->id) }}" method="POST"
                                        class="d-inline">@csrf<button class="btn btn-sm"
                                            style="background:#fee2e2;color:#991b1b;border:none;border-radius:20px">✕
                                            Reject</button></form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
