<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Brand</label>
        <input type="text" name="brand" class="form-control" value="{{ old('brand', optional($car)->brand) }}" required
            placeholder="e.g. Honda">
    </div>
    <div class="col-md-6">
        <label class="form-label">Model</label>
        <input type="text" name="model" class="form-control" value="{{ old('model', optional($car)->model) }}"
            required placeholder="e.g. City">
    </div>
    <div class="col-md-6">
        <label class="form-label">Category</label>
        <select name="category" class="form-select" required>
            @foreach ($categories as $cat)
                <option value="{{ $cat }}"
                    {{ old('category', optional($car)->category) === $cat ? 'selected' : '' }}>{{ $cat }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Location (District / Upazila)</label>
        <input type="hidden" name="location" value="{{ old('location', $car->location ?? '') }}"
            data-bd-location-value>
        <div class="row g-2" data-bd-location-picker
            data-selected-location="{{ old('location', $car->location ?? '') }}"
            data-all-districts-label="Select District" data-all-upazilas-label="Select Upazila">
            <div class="col-6">
                <select class="form-select" data-bd-district-select required>
                    <option value="">Select District</option>
                </select>
            </div>
            <div class="col-6">
                <select class="form-select" data-bd-upazila-select disabled>
                    <option value="">Select Upazila</option>
                </select>
            </div>
        </div>
        <small style="color:#6c757d;font-size:0.78rem">Pick a district first, then choose an upazila if available. The
            saved value will be used for car filtering.</small>
    </div>
    <div class="col-md-4">
        <label class="form-label">Fuel Type</label>
        <select name="fuel_type" class="form-select" required>
            @foreach (['Petrol', 'Diesel', 'Electric', 'CNG'] as $fuel)
                <option value="{{ $fuel }}"
                    {{ old('fuel_type', $car->fuel_type ?? '') === $fuel ? 'selected' : '' }}>{{ $fuel }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">Transmission</label>
        <select name="transmission" class="form-select" required>
            @foreach (['Manual', 'Automatic'] as $t)
                <option value="{{ $t }}"
                    {{ old('transmission', $car->transmission ?? '') === $t ? 'selected' : '' }}>{{ $t }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">Seats</label>
        <input type="number" name="seats" class="form-control" value="{{ old('seats', $car->seats ?? 5) }}"
            min="2" max="9" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Price per Day ( ৳)</label>
        <div class="input-group">
            <span class="input-group-text" style="background:white;border:1.5px solid #e2e8f0;border-right:none">
                ৳</span>
            <input type="number" name="price_per_day" class="form-control" style="border-left:none"
                value="{{ old('price_per_day', $car->price_per_day ?? 1200) }}" min="100" required
                placeholder="1200">
        </div>
    </div>
    <div class="col-md-4">
        <label class="form-label">Rating (1–5)</label>
        <input type="number" name="rating" class="form-control" step="0.1" min="1" max="5"
            value="{{ old('rating', $car->rating ?? 4.0) }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Availability</label>
        <select name="availability" class="form-select" required>
            <option value="available"
                {{ old('availability', $car->availability ?? 'available') === 'available' ? 'selected' : '' }}>
                Available</option>
            <option value="booked" {{ old('availability', $car->availability ?? '') === 'booked' ? 'selected' : '' }}>
                Booked</option>
        </select>
    </div>
    <div class="col-12">
        <label class="form-label">Image URL / Path</label>
        <input type="text" name="image" class="form-control"
            value="{{ old('image', optional($car)->image ?? '/images/cars/sedan.svg') }}"
            placeholder="/images/cars/sedan.svg or https://..." required>
        <small style="color:#6c757d;font-size:0.78rem">Use local path e.g. /images/cars/suv.svg or a full image
            URL</small>
    </div>
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3" placeholder="Brief description of the car...">{{ old('description', $car->description ?? '') }}</textarea>
    </div>
</div>
