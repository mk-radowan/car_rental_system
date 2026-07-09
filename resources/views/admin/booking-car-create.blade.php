@extends('layouts.admin')

@section('title', 'Booking Car')
@section('page-title', 'Booking Car')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="glass-card p-4" style="border-top:4px solid #e8192c">
                <h5 style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:20px">
                    <i class="bi bi-plus-circle me-2" style="color:#e8192c"></i>Booking Car
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

                <form method="POST" action="{{ route('admin.booking-car.store') }}">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Customer</label>
                            <select name="user_id" class="form-select" required>
                                <option value="">Select Customer</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        {{ old('user_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }} ({{ $customer->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Car</label>
                            <select name="car_id" class="form-select" required>
                                <option value="">Select Car</option>
                                @foreach ($cars as $car)
                                    <option value="{{ $car->id }}" {{ old('car_id') == $car->id ? 'selected' : '' }}>
                                        {{ $car->display_name }} - {{ $car->formatted_price }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Pickup Date</label>
                            <input type="date" name="pickup_date" class="form-control" min="{{ date('Y-m-d') }}"
                                value="{{ old('pickup_date') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Return Date</label>
                            <input type="date" name="return_date" class="form-control"
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}" value="{{ old('return_date') }}" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Start Location</label>
                            <input type="hidden" name="pickup_location" value="{{ old('pickup_location') }}"
                                data-bd-location-value>
                            <div class="row g-2" data-bd-location-picker
                                data-selected-location="{{ old('pickup_location') }}"
                                data-all-divisions-label="Select Division" data-all-districts-label="Select District"
                                data-all-upazilas-label="Select Upazila">
                                <div class="col-md-4">
                                    <select class="form-select" data-bd-division-select required>
                                        <option value="">Select Division</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select" data-bd-district-select required>
                                        <option value="">Select District</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select" data-bd-upazila-select>
                                        <option value="">Select Upazila</option>
                                    </select>
                                </div>
                            </div>
                            @error('pickup_location')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">City (optional)</label>
                            <input type="text" name="pickup_city" class="form-control" value="{{ old('pickup_city') }}"
                                placeholder="e.g. Dhaka City">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pourosova (optional)</label>
                            <input type="text" name="pickup_pourosova" class="form-control"
                                value="{{ old('pickup_pourosova') }}" placeholder="e.g. Gazipur Pourosova">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Ward (optional)</label>
                            <input type="text" name="pickup_ward" class="form-control" value="{{ old('pickup_ward') }}"
                                placeholder="e.g. Ward 5">
                        </div>

                        <div class="col-12">
                            <label class="form-label">End Location</label>
                            <input type="hidden" name="dropoff_location" value="{{ old('dropoff_location') }}"
                                data-bd-location-value>
                            <div class="row g-2" data-bd-location-picker
                                data-selected-location="{{ old('dropoff_location') }}"
                                data-all-divisions-label="Select Division" data-all-districts-label="Select District"
                                data-all-upazilas-label="Select Upazila">
                                <div class="col-md-4">
                                    <select class="form-select" data-bd-division-select required>
                                        <option value="">Select Division</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select" data-bd-district-select required>
                                        <option value="">Select District</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select" data-bd-upazila-select>
                                        <option value="">Select Upazila</option>
                                    </select>
                                </div>
                            </div>
                            @error('dropoff_location')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">City (optional)</label>
                            <input type="text" name="dropoff_city" class="form-control"
                                value="{{ old('dropoff_city') }}" placeholder="e.g. Chattogram City">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pourosova (optional)</label>
                            <input type="text" name="dropoff_pourosova" class="form-control"
                                value="{{ old('dropoff_pourosova') }}" placeholder="e.g. Comilla Pourosova">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Ward (optional)</label>
                            <input type="text" name="dropoff_ward" class="form-control"
                                value="{{ old('dropoff_ward') }}" placeholder="e.g. Ward 3">
                        </div>
                    </div>

                    <div class="alert alert-info mt-3 mb-0" role="alert">
                        New booking will be created as approved and selected car will be marked booked.
                    </div>

                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-2"></i>Create Booking
                        </button>
                        <a href="{{ route('admin.bookings') }}" class="btn btn-outline-red">
                            <i class="bi bi-arrow-left me-2"></i>Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
