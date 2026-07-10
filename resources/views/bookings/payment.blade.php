@extends('layouts.app')

@section('title', 'Payment')

@section('content')
    <div style="background:linear-gradient(135deg,#0f172a 0%,#1e293b 100%);padding:80px 0 56px">
        <div class="container" style="padding-top:40px">
            <div class="hero-badge" style="background:rgba(255,255,255,0.12);color:#e2e8f0;border-color:rgba(255,255,255,0.2)">
                Secure Checkout
            </div>
            <h1 style="font-family:'Montserrat',sans-serif;font-weight:800;color:white;font-size:2rem;margin-top:12px;margin-bottom:8px">
                Complete Booking Payment
            </h1>
            <p style="color:rgba(255,255,255,0.7);margin:0">Bangladesh real-time methods: bKash, Nagad, Rocket, Card</p>
        </div>
    </div>

    <div class="container py-5" style="margin-top:-24px">
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="glass-card p-4" style="border-top:4px solid #e8192c">
                    <h5 style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:18px">
                        <i class="bi bi-credit-card-2-front me-2" style="color:#e8192c"></i>Choose Payment Method
                    </h5>

                    <form method="POST" action="{{ route('bookings.payment.process', $booking) }}" id="payment-form">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Gateway Provider</label>
                            <select name="payment_provider" class="form-select @error('payment_provider') is-invalid @enderror">
                                <option value="sslcommerz" {{ old('payment_provider', 'sslcommerz') === 'sslcommerz' ? 'selected' : '' }}>SSLCommerz (bKash / Nagad / Rocket / Card)</option>
                                <option value="bkash_pgw" {{ old('payment_provider') === 'bkash_pgw' ? 'selected' : '' }}>bKash PGW API</option>
                            </select>
                            @error('payment_provider')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="method-box p-3 w-100" style="display:block;border:1px solid #fecdd3;border-radius:12px;background:#fff5f7;cursor:pointer">
                                    <input class="form-check-input me-2" type="radio" name="payment_method" value="bkash"
                                        {{ old('payment_method', 'bkash') === 'bkash' ? 'checked' : '' }}>
                                    <strong style="color:#c2185b">bKash</strong>
                                    <div style="font-size:0.8rem;color:#64748b;margin-top:4px">Instant wallet payment</div>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="method-box p-3 w-100" style="display:block;border:1px solid #dcfce7;border-radius:12px;background:#f0fdf4;cursor:pointer">
                                    <input class="form-check-input me-2" type="radio" name="payment_method" value="nagad"
                                        {{ old('payment_method') === 'nagad' ? 'checked' : '' }}>
                                    <strong style="color:#047857">Nagad</strong>
                                    <div style="font-size:0.8rem;color:#64748b;margin-top:4px">Fast digital wallet</div>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="method-box p-3 w-100" style="display:block;border:1px solid #fde68a;border-radius:12px;background:#fffbeb;cursor:pointer">
                                    <input class="form-check-input me-2" type="radio" name="payment_method" value="rocket"
                                        {{ old('payment_method') === 'rocket' ? 'checked' : '' }}>
                                    <strong style="color:#b45309">Rocket</strong>
                                    <div style="font-size:0.8rem;color:#64748b;margin-top:4px">DBBL mobile wallet</div>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="method-box p-3 w-100" style="display:block;border:1px solid #dbeafe;border-radius:12px;background:#eff6ff;cursor:pointer">
                                    <input class="form-check-input me-2" type="radio" name="payment_method" value="card"
                                        {{ old('payment_method') === 'card' ? 'checked' : '' }}>
                                    <strong style="color:#1d4ed8">Card</strong>
                                    <div style="font-size:0.8rem;color:#64748b;margin-top:4px">Visa / MasterCard</div>
                                </label>
                            </div>
                        </div>

                        @error('payment_method')
                            <div class="text-danger small mb-2">{{ $message }}</div>
                        @enderror

                        <div class="alert alert-light border" style="font-size:0.84rem">
                            <strong>Flow:</strong> Pay Now চাপলে আপনি selected gateway page-এ redirect হবেন, payment complete হলে auto callback এ ফিরে আসবেন।
                        </div>

                        <div class="mt-4 p-3" style="border-radius:10px;background:#f8fafc;border:1px solid #e2e8f0">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <div style="font-size:0.82rem;color:#64748b">Payable Amount</div>
                                    <strong style="font-size:1.5rem;color:#059669">{{ $booking->total_amount }}</strong>
                                </div>
                                <span class="badge" style="background:#dcfce7;color:#166534;border:1px solid #bbf7d0">Real-time Confirm</span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-4" style="padding:13px">
                            <i class="bi bi-shield-check me-2"></i>Pay Now
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="glass-card p-4" style="border-top:4px solid #0ea5e9">
                    <h6 style="font-family:'Montserrat',sans-serif;font-weight:700;color:#0f172a">Booking Summary</h6>
                    <hr>
                    <div class="d-flex justify-content-between mb-2"><span>Car</span><strong>{{ $booking->car_name }}</strong></div>
                    <div class="d-flex justify-content-between mb-2"><span>Pickup</span><strong>{{ $booking->pickup_date }}</strong></div>
                    <div class="d-flex justify-content-between mb-2"><span>Return</span><strong>{{ $booking->return_date }}</strong></div>
                    <div class="d-flex justify-content-between mb-2"><span>Status</span><strong class="text-warning">{{ ucfirst($booking->status) }}</strong></div>
                    <div class="d-flex justify-content-between mb-0"><span>Payment</span><strong class="text-danger">{{ ucfirst($booking->payment_status ?? 'unpaid') }}</strong></div>

                    <hr>
                    <p style="font-size:0.82rem;color:#64748b;margin:0">
                        Payment complete হলে booking history page-এ payment reference দেখাবে।
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection
