@extends('layouts.app')

@section('title', 'Invoice')

@section('content')
    <div style="background:linear-gradient(135deg,#0f172a 0%,#1e293b 100%);padding:80px 0 56px">
        <div class="container" style="padding-top:40px">
            <h1 style="font-family:'Montserrat',sans-serif;font-weight:800;color:white;font-size:2rem;margin:0">Booking Invoice</h1>
        </div>
    </div>

    <div class="container py-5" style="margin-top:-24px">
        <div class="glass-card p-4" style="border-top:4px solid #e8192c">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                <div>
                    <h5 class="mb-1" style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e">Invoice #INV-{{ str_pad((string) $booking->id, 6, '0', STR_PAD_LEFT) }}</h5>
                    <div class="text-muted" style="font-size:0.9rem">Issued: {{ optional($booking->created_at)->format('d M Y, h:i A') }}</div>
                </div>
                <span class="badge" style="background:#dcfce7;color:#166534;border:1px solid #bbf7d0;padding:8px 12px">
                    {{ strtoupper($booking->payment_status ?? 'unpaid') }}
                </span>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="p-3" style="border:1px solid #e2e8f0;border-radius:10px;background:#f8fafc">
                        <div class="text-muted" style="font-size:0.8rem">Customer</div>
                        <strong>{{ $booking->customer_name }}</strong>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3" style="border:1px solid #e2e8f0;border-radius:10px;background:#f8fafc">
                        <div class="text-muted" style="font-size:0.8rem">Car</div>
                        <strong>{{ $booking->car_name }}</strong>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Description</th>
                            <th class="text-center">Pickup</th>
                            <th class="text-center">Return</th>
                            <th class="text-center">Days</th>
                            <th class="text-end">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Car Rental Charge ({{ $booking->car_name }})</td>
                            <td class="text-center">{{ $booking->pickup_date }}</td>
                            <td class="text-center">{{ $booking->return_date }}</td>
                            <td class="text-center">{{ $booking->rental_days }}</td>
                            <td class="text-end"><strong>{{ $booking->total_amount }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="row g-3">
                <div class="col-md-7">
                    <div class="p-3" style="border:1px solid #e2e8f0;border-radius:10px;background:#fff">
                        <div><strong>Journey Start:</strong> {{ $booking->pickup_location ?? 'N/A' }}</div>
                        <div><strong>Journey End:</strong> {{ $booking->dropoff_location ?? 'N/A' }}</div>
                        <div><strong>Payment Ref:</strong> {{ $booking->payment_reference ?? 'N/A' }}</div>
                        <div><strong>Method:</strong> {{ strtoupper($booking->payment_method ?? 'N/A') }}</div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="p-3" style="border:1px solid #e2e8f0;border-radius:10px;background:#fef2f3">
                        <div class="d-flex justify-content-between"><span>Subtotal</span><strong>{{ $booking->total_amount }}</strong></div>
                        <div class="d-flex justify-content-between"><span>Tax</span><strong>৳0</strong></div>
                        <hr>
                        <div class="d-flex justify-content-between" style="font-size:1.1rem"><span>Total Paid</span><strong style="color:#059669">{{ $booking->total_amount }}</strong></div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 flex-wrap mt-4">
                <a href="{{ route('bookings.invoice.download', $booking->id) }}" class="btn btn-primary">
                    <i class="bi bi-download me-1"></i>Download
                </a>
                <button type="button" class="btn btn-outline-secondary" onclick="window.print()">
                    <i class="bi bi-printer me-1"></i>Print
                </button>
                <a href="{{ route('bookings.history') }}" class="btn btn-outline-red">
                    My Bookings
                </a>
            </div>
        </div>
    </div>
@endsection
