<?php ($car = $car ?? null); ?>

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Brand</label>
        <input type="text" name="brand" class="form-control" value="<?php echo e(old('brand', optional($car)->brand)); ?>" required
            placeholder="e.g. Honda">
    </div>
    <div class="col-md-6">
        <label class="form-label">Model</label>
        <input type="text" name="model" class="form-control" value="<?php echo e(old('model', optional($car)->model)); ?>"
            required placeholder="e.g. City">
    </div>
    <div class="col-md-6">
        <label class="form-label">Category</label>
        <select name="category" class="form-select" required>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($cat); ?>"
                    <?php echo e(old('category', optional($car)->category) === $cat ? 'selected' : ''); ?>><?php echo e($cat); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Location (Division)</label>
        <input type="hidden" name="location" value="<?php echo e(old('location', $car->location ?? '')); ?>"
            data-bd-location-value>
        <div class="row g-2" data-bd-location-picker
            data-selected-location="<?php echo e(old('location', $car->location ?? '')); ?>"
            data-all-divisions-label="Select Division">
            <div class="col-12">
                <select class="form-select" data-bd-division-select required>
                    <option value="">Select Division</option>
                </select>
            </div>
        </div>
        <small style="color:#6c757d;font-size:0.78rem">Selected division will make this car available across all
            districts and
            upazilas under that division.</small>
    </div>
    <div class="col-md-4">
        <label class="form-label">Fuel Type</label>
        <select name="fuel_type" class="form-select" required>
            <?php $__currentLoopData = ['Petrol', 'Diesel', 'Electric', 'CNG']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fuel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($fuel); ?>"
                    <?php echo e(old('fuel_type', $car->fuel_type ?? '') === $fuel ? 'selected' : ''); ?>><?php echo e($fuel); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">Transmission</label>
        <select name="transmission" class="form-select" required>
            <?php $__currentLoopData = ['Manual', 'Automatic']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($t); ?>"
                    <?php echo e(old('transmission', $car->transmission ?? '') === $t ? 'selected' : ''); ?>><?php echo e($t); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">Seats</label>
        <input type="number" name="seats" class="form-control" value="<?php echo e(old('seats', $car->seats ?? 5)); ?>"
            min="2" max="9" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Price per Day ( ৳)</label>
        <div class="input-group">
            <span class="input-group-text" style="background:white;border:1.5px solid #e2e8f0;border-right:none">
                ৳</span>
            <input type="number" name="price_per_day" class="form-control" style="border-left:none"
                value="<?php echo e(old('price_per_day', $car->price_per_day ?? 1200)); ?>" min="100" required
                placeholder="1200">
        </div>
    </div>
    <div class="col-md-4">
        <label class="form-label">Rating (1–5)</label>
        <input type="number" name="rating" class="form-control" step="0.1" min="1" max="5"
            value="<?php echo e(old('rating', $car->rating ?? 4.0)); ?>" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Availability</label>
        <select name="availability" class="form-select" required>
            <option value="available"
                <?php echo e(old('availability', $car->availability ?? 'available') === 'available' ? 'selected' : ''); ?>>
                Available</option>
            <option value="booked" <?php echo e(old('availability', $car->availability ?? '') === 'booked' ? 'selected' : ''); ?>>
                Booked</option>
        </select>
    </div>
    <div class="col-12">
        <label class="form-label">Image URL / Path</label>
        <input type="text" name="image" class="form-control"
            value="<?php echo e(old('image', optional($car)->image ?? '/images/cars/sedan.svg')); ?>"
            placeholder="/images/cars/sedan.svg or https://..." required>
        <small style="color:#6c757d;font-size:0.78rem">Use local path e.g. /images/cars/suv.svg or a full image
            URL</small>
    </div>
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3" placeholder="Brief description of the car..."><?php echo e(old('description', $car->description ?? '')); ?></textarea>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Laravel Project\car_rental_system\resources\views/admin/cars/_form.blade.php ENDPATH**/ ?>