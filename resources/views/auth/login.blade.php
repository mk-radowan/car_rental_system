@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div
        style="background:linear-gradient(135deg,#f8f9fa 0%,#fef2f3 100%);min-height:100vh;display:flex;align-items:center;padding-top:80px">
        <div class="container py-5">
            <div class="row align-items-center g-5 justify-content-center">

                {{-- Left panel --}}
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="text-center">
                        <div class="hero-badge mb-3">Welcome Back</div>
                        <h2
                            style="font-family:'Montserrat',sans-serif;font-weight:800;color:#1a1a2e;font-size:2rem;margin-bottom:16px">
                            Your Next Adventure<br><span style="color:#e8192c">Starts Here</span>
                        </h2>
                        <p style="color:#6c757d;margin-bottom:30px">Sign in to manage your bookings and explore premium cars
                            across 12 Indian cities.</p>
                        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=500&q=80&auto=format&fit=crop"
                            alt="Car" style="width:100%;border-radius:20px;box-shadow:0 20px 60px rgba(0,0,0,0.15)">
                        <div class="d-flex justify-content-center gap-4 mt-4">
                            <div class="text-center">
                                <div
                                    style="font-family:'Montserrat',sans-serif;font-weight:800;font-size:1.5rem;color:#e8192c">
                                    500+</div>
                                <div style="font-size:0.75rem;color:#6c757d">Cars</div>
                            </div>
                            <div style="width:1px;background:#e2e8f0"></div>
                            <div class="text-center">
                                <div
                                    style="font-family:'Montserrat',sans-serif;font-weight:800;font-size:1.5rem;color:#e8192c">
                                    12</div>
                                <div style="font-size:0.75rem;color:#6c757d">Cities</div>
                            </div>
                            <div style="width:1px;background:#e2e8f0"></div>
                            <div class="text-center">
                                <div
                                    style="font-family:'Montserrat',sans-serif;font-weight:800;font-size:1.5rem;color:#e8192c">
                                    24/7</div>
                                <div style="font-size:0.75rem;color:#6c757d">Support</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Login Form --}}
                <div class="col-lg-5 col-md-8">
                    <div class="auth-card">
                        <div class="text-center mb-4">
                            <div
                                style="width:64px;height:64px;background:#fef2f3;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;border:2px solid rgba(232,25,44,0.2)">
                                <i class="bi bi-person-fill" style="font-size:1.8rem;color:#e8192c"></i>
                            </div>
                            <h2 style="font-family:'Montserrat',sans-serif;font-weight:800;color:#1a1a2e">Welcome Back!</h2>
                            <p style="color:#6c757d;font-size:0.9rem">Sign in to your Pothik account</p>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"
                                        style="background:white;border:1.5px solid #e2e8f0;border-right:none;border-radius:8px 0 0 8px">
                                        <i class="bi bi-envelope" style="color:#e8192c"></i>
                                    </span>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        style="border-left:none;border-radius:0 8px 8px 0" value="{{ old('email') }}"
                                        placeholder="you@example.com" required autofocus>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"
                                        style="background:white;border:1.5px solid #e2e8f0;border-right:none;border-radius:8px 0 0 8px">
                                        <i class="bi bi-lock" style="color:#e8192c"></i>
                                    </span>
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        style="border-left:none;border-radius:0 8px 8px 0" placeholder="••••••••" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4 form-check">
                                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember"
                                    style="color:#6c757d;font-size:0.88rem">Remember me for 30 days</label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100" style="padding:14px">
                                <i class="bi bi-box-arrow-in-right me-2"></i> Sign In
                            </button>
                        </form>

                        <hr style="margin:24px 0;border-color:#f0f2f5">
                        <p class="text-center mb-3" style="color:#6c757d;font-size:0.9rem">
                            Don't have an account? <a href="{{ route('register') }}">Register Free</a>
                        </p>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
