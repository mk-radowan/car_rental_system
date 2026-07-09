@extends('layouts.admin')

@section('title', 'Edit User')
@section('page-title', 'Edit User')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="glass-card p-4" style="border-top:4px solid #3b82f6">
                <h5 style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:20px">
                    <i class="bi bi-pencil-square me-2" style="color:#3b82f6"></i>Edit User
                </h5>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $user->email) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" maxlength="11"
                                value="{{ old('phone', $user->phone) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select" required>
                                <option value="customer" {{ old('role', $user->role) === 'customer' ? 'selected' : '' }}>
                                    Customer</option>
                                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin
                                </option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">New Password (optional)</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="Leave blank to keep old password">
                        </div>
                    </div>

                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-2"></i>Update User
                        </button>
                        <a href="{{ route('admin.users') }}" class="btn btn-outline-red">
                            <i class="bi bi-arrow-left me-2"></i>Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
