@extends('layouts.app')

@section('title', 'Payment Result')

@section('content')
    <div style="background:linear-gradient(135deg,#0f172a 0%,#1e293b 100%);padding:80px 0 56px">
        <div class="container" style="padding-top:40px">
            <h1 style="font-family:'Montserrat',sans-serif;font-weight:800;color:white;font-size:2rem;margin:0">Payment Status</h1>
        </div>
    </div>

    <div class="container py-5" style="margin-top:-24px">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="glass-card p-4" style="border-top:4px solid #e8192c">
                    @php
                        $normalized = strtolower((string) $result);
                        $isSuccess = in_array($normalized, ['success', 'paid'], true);
                        $isCancelled = in_array($normalized, ['cancelled', 'canceled'], true);
                    @endphp

                    @if ($isSuccess)
                        <div class="alert alert-success" role="alert">
                            <strong>Payment Successful.</strong> Your booking payment is confirmed.
                        </div>
                    @elseif($isCancelled)
                        <div class="alert alert-warning" role="alert">
                            <strong>Payment Cancelled.</strong> You can retry payment anytime.
                        </div>
                    @else
                        <div class="alert alert-danger" role="alert">
                            <strong>Payment Failed.</strong> Please try again.
                        </div>
                    @endif

                    <div class="mb-3">
                        <div><strong>Booking ID:</strong> #{{ $booking->id }}</div>
                        <div><strong>Car:</strong> {{ $booking->car_name }}</div>
                        <div><strong>Amount:</strong> {{ $booking->total_amount }}</div>
                        <div><strong>Payment Status:</strong> {{ ucfirst($booking->payment_status ?? 'unpaid') }}</div>
                        <div><strong>Reference:</strong> {{ $booking->payment_reference ?? 'N/A' }}</div>
                    </div>

                    <div class="d-flex gap-2 flex-wrap">
                        @auth
                            <a href="{{ route('bookings.history') }}" class="btn btn-primary">Go To Booking History</a>
                            @if (($booking->payment_status ?? 'unpaid') !== 'paid')
                                <a href="{{ route('bookings.payment.show', $booking->id) }}" class="btn btn-outline-red">Retry Payment</a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                        @endauth

                        <a href="{{ route('cars.show', $booking->car_id) }}" class="btn btn-outline-secondary">Back To Car</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
