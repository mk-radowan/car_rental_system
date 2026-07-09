@extends('layouts.app')

@section('title', $car->display_name)

@section('content')

    {{-- Page Header --}}
    <div style="background:linear-gradient(135deg,#1a1a2e 0%,#16213e 100%);padding:80px 0 40px;margin-top:0">
        <div class="container" style="padding-top:40px">
            <nav style="--bs-breadcrumb-divider:'›'">
                <ol class="breadcrumb mb-2" style="font-size:0.85rem">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"
                            style="color:rgba(255,255,255,0.6);text-decoration:none">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cars.index') }}"
                            style="color:rgba(255,255,255,0.6);text-decoration:none">Cars</a></li>
                    <li class="breadcrumb-item active" style="color:rgba(255,255,255,0.4)">{{ $car->brand }}
                        {{ $car->model }}</li>
                </ol>
            </nav>
            <h1 style="font-family:'Montserrat',sans-serif;font-weight:800;color:white;font-size:2rem;margin:0">
                {{ $car->brand }} {{ $car->model }}
            </h1>
        </div>
    </div>

    <div class="container py-5">
        <div class="row g-4">
            {{-- Car Image --}}
            <div class="col-lg-7">
                @include('partials.car-image', ['car' => $car, 'class' => 'car-detail-img'])

                {{-- Reviews Section --}}
                <div class="mt-5">
                    <h3 style="font-family:'Montserrat',sans-serif;font-weight:800;color:#1a1a2e;margin-bottom:24px">
                        <i class="bi bi-star-fill me-2" style="color:#e8192c"></i>Customer Reviews
                    </h3>

                    @auth
                        @if (auth()->user()->isCustomer())
                            <div class="glass-card p-4 mb-4">
                                <h5
                                    style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:16px">
                                    Write a Review</h5>
                                <form method="POST" action="{{ route('reviews.store', $car->id) }}">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label">Rating (1-5)</label>
                                            <select name="rating" class="form-select" required>
                                                @for ($i = 5; $i >= 1; $i--)
                                                    <option value="{{ $i }}">{{ $i }}
                                                        Star{{ $i > 1 ? 's' : '' }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="form-label">Your Comment</label>
                                            <textarea name="comment" class="form-control" rows="2" required maxlength="500"
                                                placeholder="Share your experience..."></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm mt-3">
                                        <i class="bi bi-send me-1"></i> Submit Review
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth

                    @forelse($reviews as $review)
                        <div class="glass-card p-4 mb-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="d-flex gap-3">
                                    <div
                                        style="width:42px;height:42px;background:#e8192c;border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-family:'Montserrat',sans-serif;flex-shrink:0">
                                        {{ substr($review->user_name, 0, 1) }}
                                    </div>
                                    <div>
                                        <strong style="color:#1a1a2e;font-size:0.9rem">{{ $review->user_name }}</strong>
                                        <div class="rating-stars" style="font-size:0.8rem">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p style="color:#374151;margin:12px 0 0;font-size:0.9rem;line-height:1.6">
                                {{ $review->comment }}</p>
                        </div>
                    @empty
                        <div class="glass-card p-4 text-center">
                            <i class="bi bi-chat-dots" style="font-size:2rem;color:#e8192c;opacity:0.4"></i>
                            <p style="color:#6c757d;margin:12px 0 0">No reviews yet. Be the first to review!</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Car Details + Booking --}}
            <div class="col-lg-5">
                <div class="glass-card p-4 mb-4" style="border-top:4px solid #e8192c">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="badge"
                            style="background:#fef2f3;color:#e8192c;border:1px solid rgba(232,25,44,0.2);font-weight:600;border-radius:20px">
                            {{ $car->category }}
                        </span>
                        <span class="badge {{ $car->availability === 'available' ? '' : '' }}"
                            style="background:{{ $car->availability === 'available' ? '#d1fae5' : '#f3f4f6' }};color:{{ $car->availability === 'available' ? '#065f46' : '#6b7280' }};border-radius:20px;font-weight:600">
                            <i class="bi bi-circle-fill me-1"
                                style="font-size:0.5rem"></i>{{ ucfirst($car->availability) }}
                        </span>
                    </div>

                    <h1
                        style="font-family:'Montserrat',sans-serif;font-weight:800;color:#1a1a2e;font-size:1.8rem;margin-bottom:4px">
                        {{ $car->brand }} {{ $car->model }}
                    </h1>
                    <p style="color:#6c757d;font-size:0.9rem;margin-bottom:16px">
                        <i class="bi bi-geo-alt me-1" style="color:#e8192c"></i>{{ $car->location }}
                    </p>

                    <div class="d-flex align-items-center gap-2 mb-4">
                        <h2
                            style="font-family:'Montserrat',sans-serif;font-weight:800;color:#e8192c;font-size:2rem;margin:0">
                            {{ $car->formatted_price }}
                        </h2>
                    </div>

                    <div class="rating-stars mb-4" style="font-size:0.9rem">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="bi bi-star{{ $i <= $car->rating ? '-fill' : '' }}"></i>
                        @endfor
                        <span style="color:#6c757d;font-size:0.85rem;margin-left:6px">{{ $car->rating }}/5.0</span>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <div style="background:#f8f9fa;border-radius:10px;padding:14px;text-align:center">
                                <i class="bi bi-fuel-pump"
                                    style="font-size:1.3rem;color:#e8192c;display:block;margin-bottom:4px"></i>
                                <span style="font-size:0.8rem;color:#6c757d">{{ $car->fuel_type }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div style="background:#f8f9fa;border-radius:10px;padding:14px;text-align:center">
                                <i class="bi bi-gear"
                                    style="font-size:1.3rem;color:#e8192c;display:block;margin-bottom:4px"></i>
                                <span style="font-size:0.8rem;color:#6c757d">{{ $car->transmission }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div style="background:#f8f9fa;border-radius:10px;padding:14px;text-align:center">
                                <i class="bi bi-people"
                                    style="font-size:1.3rem;color:#e8192c;display:block;margin-bottom:4px"></i>
                                <span style="font-size:0.8rem;color:#6c757d">{{ $car->seats }} Seats</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div style="background:#f8f9fa;border-radius:10px;padding:14px;text-align:center">
                                <i class="bi bi-shield-check"
                                    style="font-size:1.3rem;color:#e8192c;display:block;margin-bottom:4px"></i>
                                <span style="font-size:0.8rem;color:#6c757d">Insured</span>
                            </div>
                        </div>
                    </div>

                    @if ($car->description)
                        <p
                            style="color:#374151;font-size:0.9rem;line-height:1.7;padding:14px;background:#f8f9fa;border-radius:10px;margin-bottom:20px">
                            {{ $car->description }}
                        </p>
                    @endif

                    @auth
                        @if (auth()->user()->isCustomer() && $car->isAvailable())
                            <hr style="border-color:#f0f2f5;margin:20px 0">
                            <h5 style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:16px">
                                <i class="bi bi-calendar-plus me-2" style="color:#e8192c"></i>Book This Car
                            </h5>
                            <form method="POST" action="{{ route('bookings.store', $car->id) }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Pickup Date</label>
                                    <input type="date" name="pickup_date"
                                        class="form-control @error('pickup_date') is-invalid @enderror"
                                        min="{{ date('Y-m-d') }}" value="{{ old('pickup_date') }}" required>
                                    @error('pickup_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Return Date</label>
                                    <input type="date" name="return_date"
                                        class="form-control @error('return_date') is-invalid @enderror"
                                        min="{{ date('Y-m-d', strtotime('+1 day')) }}" value="{{ old('return_date') }}"
                                        required>
                                    @error('return_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Journey Start Location (Division / District / Upazila)</label>
                                    <input type="hidden" name="pickup_location" value="{{ old('pickup_location') }}"
                                        data-bd-location-value>
                                    <div class="row g-2" data-bd-location-picker
                                        data-selected-location="{{ old('pickup_location') }}"
                                        data-all-divisions-label="Select Division"
                                        data-all-districts-label="Select District" data-all-upazilas-label="Select Upazila">
                                        <div class="col-12">
                                            <select class="form-select form-select-sm @error('pickup_location') is-invalid @enderror"
                                                data-bd-division-select required>
                                                <option value="">Select Division</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <select class="form-select form-select-sm" data-bd-district-select required>
                                                <option value="">Select District</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <select class="form-select form-select-sm" data-bd-upazila-select required>
                                                <option value="">Select Upazila</option>
                                            </select>
                                        </div>
                                    </div>
                                    @error('pickup_location')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Journey End Location (Division / District / Upazila)</label>
                                    <input type="hidden" name="dropoff_location" value="{{ old('dropoff_location') }}"
                                        data-bd-location-value>
                                    <div class="row g-2" data-bd-location-picker
                                        data-selected-location="{{ old('dropoff_location') }}"
                                        data-all-divisions-label="Select Division"
                                        data-all-districts-label="Select District" data-all-upazilas-label="Select Upazila">
                                        <div class="col-12">
                                            <select class="form-select form-select-sm @error('dropoff_location') is-invalid @enderror"
                                                data-bd-division-select required>
                                                <option value="">Select Division</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <select class="form-select form-select-sm" data-bd-district-select required>
                                                <option value="">Select District</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <select class="form-select form-select-sm" data-bd-upazila-select required>
                                                <option value="">Select Upazila</option>
                                            </select>
                                        </div>
                                    </div>
                                    @error('dropoff_location')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div
                                    style="background:#fef2f3;border-radius:10px;padding:14px;margin-bottom:16px;border:1px solid rgba(232,25,44,0.15)">
                                    <p style="margin:0;font-size:0.85rem;color:#374151">
                                        <i class="bi bi-info-circle me-1" style="color:#e8192c"></i>
                                        Est. ৳{{ number_format($car->price_per_day) }}/day × rental days
                                    </p>
                                </div>
                                <button type="submit" class="btn btn-primary w-100" style="padding:14px">
                                    <i class="bi bi-calendar-plus me-2"></i>Request Booking
                                </button>
                                <p style="font-size:0.78rem;color:#92400e;margin-top:10px;text-align:center">
                                    <i class="bi bi-clock me-1"></i>Booking will be pending until admin approval
                                </p>
                            </form>
                        @elseif(!$car->isAvailable())
                            <div class="alert alert-warning mt-3">
                                <i class="bi bi-exclamation-triangle me-2"></i>This car is currently not available for booking.
                            </div>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary w-100 mt-3" style="padding:14px">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Login to Book This Car
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
