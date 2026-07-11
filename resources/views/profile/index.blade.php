@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body text-center py-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-danger text-white fw-bold fs-3 mb-3"
                         style="width:72px;height:72px;">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <h2 class="h4 fw-bold mb-1">{{ $user->name }}</h2>
                    <p class="text-muted mb-0">{{ ucfirst($user->role) }} Account</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h4 class="mb-0 fw-semibold">
                        <i class="bi bi-pencil-square me-2 text-danger"></i>Edit Profile
                    </h4>
                </div>
                <div class="card-body p-4">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="table-responsive">
                        <table class="table align-middle mb-3">
                            <tbody>
                                <tr>
                                    <th class="text-muted fw-semibold" style="width:30%;">Full Name</th>
                                    <td>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                               value="{{ old('name', $user->name) }}" required>
                                        @error('name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted fw-semibold">Email Address</th>
                                    <td>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email', $user->email) }}" required>
                                        @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted fw-semibold">Phone Number</th>
                                    <td>
                                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                               value="{{ old('phone', $user->phone) }}" required>
                                        @error('phone')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted fw-semibold">Account Role</th>
                                    <td>
                                        <input type="text" class="form-control" value="{{ ucfirst($user->role) }}" disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted fw-semibold">New Password</th>
                                    <td>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                               placeholder="Leave blank to keep current password">
                                        @error('password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted fw-semibold">Confirm Password</th>
                                    <td>
                                        <input type="password" name="password_confirmation" class="form-control"
                                               placeholder="Re-enter new password">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-check-circle me-2"></i>Update Profile
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
