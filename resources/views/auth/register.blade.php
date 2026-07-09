@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div style="background:linear-gradient(135deg,#f8f9fa 0%,#fef2f3 100%);min-height:100vh;padding-top:80px">
        <div class="container py-5">
            <div class="row align-items-center g-5 justify-content-center">

                {{-- Left info panel --}}
                <div class="col-lg-4 d-none d-lg-block">
                    <div class="hero-badge mb-3">Join Pothik</div>
                    <h2
                        style="font-family:'Montserrat',sans-serif;font-weight:800;color:#1a1a2e;font-size:1.9rem;margin-bottom:16px">
                        Start Your Journey<br><span style="color:#e8192c">Today — Free!</span>
                    </h2>
                    <p style="color:#6c757d;margin-bottom:28px;line-height:1.7">Create an account and gain instant access to
                        500+ premium cars across 12 Indian cities.</p>
                    @php
                        $perks = [
                            'No hidden fees — all prices in ৳',
                            'Instant booking requests',
                            'Real-time availability',
                            '24/7 customer support',
                        ];
                    @endphp
                    @foreach ($perks as $perk)
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div
                                style="width:32px;height:32px;background:#e8192c;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                                <i class="bi bi-check text-white" style="font-size:1rem"></i>
                            </div>
                            <span style="color:#374151;font-size:0.9rem">{{ $perk }}</span>
                        </div>
                    @endforeach
                </div>

                {{-- Register Form --}}
                <div class="col-lg-6 col-md-9">
                    <div class="auth-card">
                        <div class="text-center mb-4">
                            <div
                                style="width:64px;height:64px;background:#fef2f3;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;border:2px solid rgba(232,25,44,0.2)">
                                <i class="bi bi-person-plus-fill" style="font-size:1.8rem;color:#e8192c"></i>
                            </div>
                            <h2 style="font-family:'Montserrat',sans-serif;font-weight:800;color:#1a1a2e">Create Account
                            </h2>
                            <p style="color:#6c757d;font-size:0.9rem">Join thousands of happy Pothik customers</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Full Name *</label>
                                    <div class="input-group">
                                        <span class="input-group-text"
                                            style="background:white;border:1.5px solid #e2e8f0;border-right:none;border-radius:8px 0 0 8px">
                                            <i class="bi bi-person" style="color:#e8192c"></i>
                                        </span>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            style="border-left:none;border-radius:0 8px 8px 0" value="{{ old('name') }}"
                                            placeholder="Rahul Sharma" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email Address *</label>
                                    <div class="input-group">
                                        <span class="input-group-text"
                                            style="background:white;border:1.5px solid #e2e8f0;border-right:none;border-radius:8px 0 0 8px">
                                            <i class="bi bi-envelope" style="color:#e8192c"></i>
                                        </span>
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            style="border-left:none;border-radius:0 8px 8px 0" value="{{ old('email') }}"
                                            placeholder="rahul@email.com" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone (11-digit) *</label>
                                    <div class="input-group">
                                        <span class="input-group-text"
                                            style="background:white;border:1.5px solid #e2e8f0;border-right:none;border-radius:8px 0 0 8px">
                                            <i class="bi bi-telephone" style="color:#e8192c"></i>
                                        </span>
                                        <input type="text" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            style="border-left:none;border-radius:0 8px 8px 0" value="{{ old('phone') }}"
                                            placeholder="01000000000" maxlength="11" inputmode="numeric" pattern="[0-9]{11}"
                                            required>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Account Role *</label>
                                    <div class="input-group">
                                        <span class="input-group-text"
                                            style="background:white;border:1.5px solid #e2e8f0;border-right:none;border-radius:8px 0 0 8px">
                                            <i class="bi bi-shield-person" style="color:#e8192c"></i>
                                        </span>
                                        <select name="role" class="form-select @error('role') is-invalid @enderror"
                                            style="border-left:none;border-radius:0 8px 8px 0" required>
                                            <option value="customer" {{ old('role') === 'customer' ? 'selected' : '' }}>
                                                Customer
                                            </option>
                                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Password * (min 6 chars)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"
                                            style="background:white;border:1.5px solid #e2e8f0;border-right:none;border-radius:8px 0 0 8px">
                                            <i class="bi bi-lock" style="color:#e8192c"></i>
                                        </span>
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            style="border-left:none;border-radius:0 8px 8px 0" placeholder="••••••••"
                                            required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Confirm Password *</label>
                                    <div class="input-group">
                                        <span class="input-group-text"
                                            style="background:white;border:1.5px solid #e2e8f0;border-right:none;border-radius:8px 0 0 8px">
                                            <i class="bi bi-lock-fill" style="color:#e8192c"></i>
                                        </span>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            style="border-left:none;border-radius:0 8px 8px 0" placeholder="••••••••"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mt-4" style="padding:14px">
                                <i class="bi bi-person-plus me-2"></i> Create My Account
                            </button>
                        </form>

                        <hr style="margin:24px 0;border-color:#f0f2f5">
                        <p class="text-center mb-0" style="color:#6c757d;font-size:0.9rem">
                            Already registered? <a href="{{ route('login') }}">Sign in here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
