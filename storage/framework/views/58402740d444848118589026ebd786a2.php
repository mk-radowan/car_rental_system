

<?php $__env->startSection('title', 'Booking Car'); ?>
<?php $__env->startSection('page-title', 'Booking Car'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="glass-card p-4" style="border-top:4px solid #e8192c">
                <h5 style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:20px">
                    <i class="bi bi-plus-circle me-2" style="color:#e8192c"></i>Booking Car
                </h5>

                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0 ps-3">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('admin.booking-car.store')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Customer</label>
                            <select name="user_id" class="form-select" required>
                                <option value="">Select Customer</option>
                                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($customer->id); ?>"
                                        <?php echo e(old('user_id') == $customer->id ? 'selected' : ''); ?>>
                                        <?php echo e($customer->name); ?> (<?php echo e($customer->email); ?>)
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Car</label>
                            <select name="car_id" class="form-select" required>
                                <option value="">Select Car</option>
                                <?php $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($car->id); ?>" <?php echo e(old('car_id') == $car->id ? 'selected' : ''); ?>>
                                        <?php echo e($car->display_name); ?> - <?php echo e($car->formatted_price); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Pickup Date</label>
                            <input type="date" name="pickup_date" class="form-control" min="<?php echo e(date('Y-m-d')); ?>"
                                value="<?php echo e(old('pickup_date')); ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Return Date</label>
                            <input type="date" name="return_date" class="form-control"
                                min="<?php echo e(date('Y-m-d', strtotime('+1 day'))); ?>" value="<?php echo e(old('return_date')); ?>" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Start Location</label>
                            <input type="hidden" name="pickup_location" value="<?php echo e(old('pickup_location')); ?>"
                                data-bd-location-value>
                            <div class="row g-2" data-bd-location-picker
                                data-selected-location="<?php echo e(old('pickup_location')); ?>"
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
                            <?php $__errorArgs = ['pickup_location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">City (optional)</label>
                            <input type="text" name="pickup_city" class="form-control" value="<?php echo e(old('pickup_city')); ?>"
                                placeholder="e.g. Dhaka City">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pourosova (optional)</label>
                            <input type="text" name="pickup_pourosova" class="form-control"
                                value="<?php echo e(old('pickup_pourosova')); ?>" placeholder="e.g. Gazipur Pourosova">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Ward (optional)</label>
                            <input type="text" name="pickup_ward" class="form-control" value="<?php echo e(old('pickup_ward')); ?>"
                                placeholder="e.g. Ward 5">
                        </div>

                        <div class="col-12">
                            <label class="form-label">End Location</label>
                            <input type="hidden" name="dropoff_location" value="<?php echo e(old('dropoff_location')); ?>"
                                data-bd-location-value>
                            <div class="row g-2" data-bd-location-picker
                                data-selected-location="<?php echo e(old('dropoff_location')); ?>"
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
                            <?php $__errorArgs = ['dropoff_location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">City (optional)</label>
                            <input type="text" name="dropoff_city" class="form-control"
                                value="<?php echo e(old('dropoff_city')); ?>" placeholder="e.g. Chattogram City">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pourosova (optional)</label>
                            <input type="text" name="dropoff_pourosova" class="form-control"
                                value="<?php echo e(old('dropoff_pourosova')); ?>" placeholder="e.g. Comilla Pourosova">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Ward (optional)</label>
                            <input type="text" name="dropoff_ward" class="form-control"
                                value="<?php echo e(old('dropoff_ward')); ?>" placeholder="e.g. Ward 3">
                        </div>
                    </div>

                    <div class="alert alert-info mt-3 mb-0" role="alert">
                        New booking will be created as approved and selected car will be marked booked.
                    </div>

                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-2"></i>Create Booking
                        </button>
                        <a href="<?php echo e(route('admin.bookings')); ?>" class="btn btn-outline-red">
                            <i class="bi bi-arrow-left me-2"></i>Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel Project\car_rental_system\resources\views/admin/booking-car-create.blade.php ENDPATH**/ ?>