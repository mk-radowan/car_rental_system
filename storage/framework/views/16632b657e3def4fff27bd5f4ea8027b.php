

<?php $__env->startSection('title', 'Browse Cars'); ?>

<?php $__env->startSection('content'); ?>

    
    <div style="background:linear-gradient(135deg,#1a1a2e 0%,#16213e 100%);padding:80px 0 60px;margin-top:0">
        <div class="container text-center" style="padding-top:40px">
            <div class="hero-badge" style="background:rgba(255,255,255,0.1);color:white;border-color:rgba(255,255,255,0.2)">
                Our Fleet</div>
            <h1 style="font-family:'Montserrat',sans-serif;font-weight:800;color:white;font-size:2.5rem;margin-top:12px">
                Browse Cars in Bangladesh</h1>
            <p style="color:rgba(255,255,255,0.7);margin:0">Explore our premium fleet across 64 Bangladeshi districts</p>
        </div>
    </div>

    <div class="container py-4">
        <div class="row">
            
            <div class="col-lg-3">
                <div class="filter-sidebar" style="margin-top:-30px">
                    <h5 style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:20px">
                        <i class="bi bi-sliders me-2" style="color:#e8192c"></i>Filters
                    </h5>
                    <form method="GET" action="<?php echo e(route('cars.index')); ?>">
                        <div class="mb-3">
                            <label class="form-label"
                                style="font-size:0.78rem;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;color:#6c757d">
                                <i class="bi bi-search me-1" style="color:#e8192c"></i>Search
                            </label>
                            <input type="text" name="search" class="form-control form-control-sm"
                                value="<?php echo e($filters['search'] ?? ''); ?>" placeholder="Brand, model...">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                style="font-size:0.78rem;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;color:#6c757d">
                                <i class="bi bi-geo-alt me-1" style="color:#e8192c"></i>Location
                            </label>
                            <input type="hidden" name="location" value="<?php echo e($filters['location'] ?? ''); ?>"
                                data-bd-location-value>
                            <div class="row g-2" data-bd-location-picker
                                data-selected-location="<?php echo e($filters['location'] ?? ''); ?>"
                                data-all-districts-label="All Districts" data-all-upazilas-label="All Upazilas">
                                <div class="col-6">
                                    <select class="form-select form-select-sm" data-bd-district-select>
                                        <option value="">All Districts</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <select class="form-select form-select-sm" data-bd-upazila-select disabled>
                                        <option value="">All Upazilas</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                style="font-size:0.78rem;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;color:#6c757d">
                                <i class="bi bi-tag me-1" style="color:#e8192c"></i>Category
                            </label>
                            <select name="category" class="form-select form-select-sm">
                                <option value="">All Categories</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cat); ?>"
                                        <?php echo e(($filters['category'] ?? '') === $cat ? 'selected' : ''); ?>><?php echo e($cat); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                style="font-size:0.78rem;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;color:#6c757d">
                                <i class="bi bi-circle me-1" style="color:#e8192c"></i>Availability
                            </label>
                            <select name="availability" class="form-select form-select-sm">
                                <option value="available"
                                    <?php echo e(($filters['availability'] ?? 'available') === 'available' ? 'selected' : ''); ?>>
                                    Available</option>
                                <option value="booked"
                                    <?php echo e(($filters['availability'] ?? '') === 'booked' ? 'selected' : ''); ?>>Booked</option>
                                <option value="" <?php echo e(($filters['availability'] ?? '') === '' ? 'selected' : ''); ?>>All
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                style="font-size:0.78rem;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;color:#6c757d">
                                <i class="bi bi-currency-rupee me-1" style="color:#e8192c"></i>Min Price ( ৳/day)
                            </label>
                            <input type="number" name="min_price" class="form-control form-control-sm"
                                value="<?php echo e($filters['min_price'] ?? ''); ?>" placeholder="e.g. 1000">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                style="font-size:0.78rem;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;color:#6c757d">
                                <i class="bi bi-currency-rupee me-1" style="color:#e8192c"></i>Max Price ( ৳/day)
                            </label>
                            <input type="number" name="max_price" class="form-control form-control-sm"
                                value="<?php echo e($filters['max_price'] ?? ''); ?>" placeholder="e.g. 10000">
                        </div>
                        <div class="mb-4">
                            <label class="form-label"
                                style="font-size:0.78rem;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;color:#6c757d">
                                <i class="bi bi-calendar me-1" style="color:#e8192c"></i>Duration
                            </label>
                            <select name="rental_days" class="form-select form-select-sm">
                                <option value="">Any Duration</option>
                                <?php $__currentLoopData = [1, 2, 3, 5, 7, 14, 30]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($d); ?>"
                                        <?php echo e(($filters['rental_days'] ?? '') == $d ? 'selected' : ''); ?>><?php echo e($d); ?>

                                        Day<?php echo e($d > 1 ? 's' : ''); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm w-100 mb-2">
                            <i class="bi bi-funnel me-1"></i> Apply Filters
                        </button>
                        <a href="<?php echo e(route('cars.index')); ?>" class="btn btn-outline-red btn-sm w-100">
                            <i class="bi bi-x-circle me-1"></i> Clear Filters
                        </a>
                    </form>
                </div>
            </div>

            
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                    <div>
                        <h5 style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e;margin:0">
                            Available Cars
                        </h5>
                        <p style="color:#6c757d;font-size:0.85rem;margin:0"><?php echo e($cars->total()); ?> cars found</p>
                    </div>
                </div>
                <div class="row">
                    <?php $__empty_1 = true; $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php echo $__env->make('partials.car-card', ['car' => $car, 'filters' => $filters], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-12">
                            <div class="glass-card p-5 text-center">
                                <i class="bi bi-car-front" style="font-size:4rem;color:#e8192c;opacity:0.3"></i>
                                <h5 style="color:#1a1a2e;margin-top:20px">No Cars Found</h5>
                                <p style="color:#6c757d">No cars match your filters. Try adjusting your search criteria.
                                </p>
                                <a href="<?php echo e(route('cars.index')); ?>" class="btn btn-primary">
                                    <i class="bi bi-arrow-left me-1"></i> Clear Filters
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <?php echo e($cars->withQueryString()->links()); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel Project\car_rental_system\resources\views/cars/index.blade.php ENDPATH**/ ?>