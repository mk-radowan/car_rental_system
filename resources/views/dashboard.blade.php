@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div style="background:linear-gradient(135deg,#1a1a2e 0%,#16213e 100%);padding:80px 0 55px;margin-top:0">
        <div class="container" style="padding-top:40px">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <p style="color:rgba(255,255,255,0.6);margin:0">Welcome back,</p>
                    <h1 style="font-family:'Montserrat',sans-serif;font-weight:800;color:#fff;font-size:2rem;margin:0">
                        {{ auth()->user()->name }}
                    </h1>
                </div>
                <a href="{{ route('cars.index') }}" class="btn btn-primary">
                    <i class="bi bi-car-front me-2"></i>Browse Cars
                </a>
            </div>
        </div>
    </div>

    <div class="container py-4" style="margin-top:-24px">
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="glass-card p-3" style="border-left:4px solid #3b82f6">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div style="font-size:0.82rem;color:#6c757d">Total Bookings</div>
                            <div style="font-family:'Montserrat',sans-serif;font-size:1.8rem;font-weight:800;color:#1a1a2e">
                                {{ $totalBookings }}</div>
                        </div>
                        <i class="bi bi-calendar-check" style="font-size:1.6rem;color:#3b82f6"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-card p-3" style="border-left:4px solid #f59e0b">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div style="font-size:0.82rem;color:#6c757d">Pending</div>
                            <div style="font-family:'Montserrat',sans-serif;font-size:1.8rem;font-weight:800;color:#1a1a2e">
                                {{ $pendingBookings->count() }}</div>
                        </div>
                        <i class="bi bi-hourglass-split" style="font-size:1.6rem;color:#f59e0b"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-card p-3" style="border-left:4px solid #10b981">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div style="font-size:0.82rem;color:#6c757d">Approved</div>
                            <div style="font-family:'Montserrat',sans-serif;font-size:1.8rem;font-weight:800;color:#1a1a2e">
                                {{ $approvedBookings->count() }}</div>
                        </div>
                        <i class="bi bi-check-circle" style="font-size:1.6rem;color:#10b981"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="glass-card" style="overflow:hidden">
                    <div style="padding:16px 20px;border-bottom:1px solid #f3f4f6"
                        class="d-flex justify-content-between align-items-center">
                        <h5 style="margin:0;font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e">
                            <i class="bi bi-hourglass-split me-2" style="color:#f59e0b"></i>Pending Bookings
                        </h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Car</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pendingBookings as $booking)
                                    <tr>
                                        <td>{{ $booking->car_name }}</td>
                                        <td>{{ $booking->pickup_date }} - {{ $booking->return_date }}</td>
                                        <td><span class="status-badge-pending">{{ $booking->total_amount }}</span></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">No pending bookings.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="glass-card" style="overflow:hidden">
                    <div style="padding:16px 20px;border-bottom:1px solid #f3f4f6"
                        class="d-flex justify-content-between align-items-center">
                        <h5 style="margin:0;font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e">
                            <i class="bi bi-check-circle me-2" style="color:#10b981"></i>Approved Rentals
                        </h5>
                        <a href="{{ route('bookings.history') }}"
                            style="font-size:0.82rem;color:#e8192c;text-decoration:none">View All</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Car</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($approvedBookings as $booking)
                                    <tr>
                                        <td>{{ $booking->car_name }}</td>
                                        <td>{{ $booking->pickup_date }} - {{ $booking->return_date }}</td>
                                        <td><span class="status-badge-approved">Approved</span></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">No approved bookings yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
