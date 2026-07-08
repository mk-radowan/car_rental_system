@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div style="background:linear-gradient(135deg,#1a1a2e 0%,#16213e 100%);padding:80px 0 60px">
    <div class="container text-center" style="padding-top:40px">
        <div style="width:80px;height:80px;background:#e8192c;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:2rem;color:white;font-weight:800;font-family:'Montserrat',sans-serif;margin:0 auto 16px">
            {{ substr($user->name,0,1) }}
        </div>
        <h1 style="font-family:'Montserrat',sans-serif;font-weight:800;color:white;font-size:1.8rem">{{ $user->name }}</h1>
        <p style="color:rgba(255,255,255,0.6);margin:0">{{ ucfirst($user->role) }} Account</p>
    </div>
</div>

<div class="container py-5" style="margin-top:-30px">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="auth-card" style="border-top:4px solid #e8192c">
                <h4 style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:24px">
                    <i class="bi bi-pencil-square me-2" style="color:#e8192c"></i>Edit Profile
                </h4>
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $user->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $user->email) }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone', $user->phone) }}" required>
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Account Role</label>
                        <input type="text" class="form-control" value="{{ ucfirst($user->role) }}" disabled
                               style="background:#f8f9fa;color:#6c757d">
                    </div>
                    <hr style="border-color:#f0f2f5;margin:24px 0">
                    <p style="color:#6c757d;font-size:0.85rem;margin-bottom:16px">
                        <i class="bi bi-info-circle me-1"></i>Leave password blank to keep your current password
                    </p>
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                               placeholder="••••••••">
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••">
                    </div>
                    <button type="submit" class="btn btn-primary w-100" style="padding:14px">
                        <i class="bi bi-check-circle me-2"></i>Update Profile
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
