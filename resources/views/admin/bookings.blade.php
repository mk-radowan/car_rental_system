@extends('layouts.admin')

@section('title', 'Booking Requests')
@section('page-title', 'Booking Requests')

@section('content')
<div class="glass-card" style="overflow:hidden">
    <div style="padding:20px 24px;border-bottom:1px solid #f3f4f6">
        <h5 style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e;margin:0">
            <i class="bi bi-calendar-check me-2" style="color:#e8192c"></i>All Booking Requests
        </h5>
    </div>
    <div class="table-responsive admin-table">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Car</th>
                    <th>Pickup</th>
                    <th>Return</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                <tr>
                    <td><strong>{{ $booking->customer_name }}</strong></td>
                    <td>{{ $booking->car_name }}</td>
                    <td>{{ $booking->pickup_date }}</td>
                    <td>{{ $booking->return_date }}</td>
                    <td><strong style="color:#10b981">{{ $booking->total_amount }}</strong></td>
                    <td><span class="status-badge-{{ $booking->status }}">{{ ucfirst($booking->status) }}</span></td>
                    <td>
                        <div class="d-flex gap-1 flex-wrap">
                            <a href="{{ route('admin.bookings.view', $booking->id) }}" class="btn btn-sm" style="background:#f3f4f6;color:#374151;border:none;border-radius:20px">View</a>
                            @if($booking->status === 'pending')
                            <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST" class="d-inline">
                                @csrf<button class="btn btn-sm" style="background:#d1fae5;color:#065f46;border:none;border-radius:20px">✓ Approve</button>
                            </form>
                            <form action="{{ route('admin.bookings.reject', $booking->id) }}" method="POST" class="d-inline">
                                @csrf<button class="btn btn-sm" style="background:#fee2e2;color:#991b1b;border:none;border-radius:20px">✕ Reject</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4" style="color:#6c757d">
                        <i class="bi bi-calendar-x d-block mb-2" style="font-size:2rem;color:#e8192c;opacity:0.4"></i>
                        No bookings found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
