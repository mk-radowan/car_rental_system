<div class="col-md-6 col-lg-4 mb-4">
    <div class="glass-card car-card h-100" style="overflow:hidden">
        <div style="position:relative;overflow:hidden">
            <?php echo $__env->make('partials.car-image', ['car' => $car, 'class' => 'card-img-top'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <div style="position:absolute;top:14px;right:14px">
                <span
                    style="background:<?php echo e($car->availability === 'available' ? '#d1fae5' : '#f3f4f6'); ?>;color:<?php echo e($car->availability === 'available' ? '#065f46' : '#6b7280'); ?>;padding:4px 12px;border-radius:20px;font-size:0.75rem;font-weight:700;font-family:'Montserrat',sans-serif">
                    <?php echo e(ucfirst($car->availability)); ?>

                </span>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div>
                    <h5 style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:2px">
                        <?php echo e($car->brand); ?> <?php echo e($car->model); ?>

                    </h5>
                    <p style="color:#6c757d;font-size:0.82rem;margin:0">
                        <i class="bi bi-geo-alt me-1" style="color:#e8192c"></i><?php echo e($car->location); ?>

                    </p>
                </div>
                <span class="badge-price"><?php echo e($car->formatted_price); ?></span>
            </div>

            <div style="background:#f8f9fa;border-radius:10px;padding:12px;margin:14px 0">
                <div class="row g-2" style="font-size:0.8rem;color:#374151">
                    <div class="col-6 d-flex align-items-center gap-2">
                        <i class="bi bi-fuel-pump" style="color:#e8192c"></i><?php echo e($car->fuel_type); ?>

                    </div>
                    <div class="col-6 d-flex align-items-center gap-2">
                        <i class="bi bi-gear" style="color:#e8192c"></i><?php echo e($car->transmission); ?>

                    </div>
                    <div class="col-6 d-flex align-items-center gap-2">
                        <i class="bi bi-people" style="color:#e8192c"></i><?php echo e($car->seats); ?> seats
                    </div>
                    <div class="col-6 d-flex align-items-center gap-2 rating-stars" style="font-size:0.8rem">
                        <i class="bi bi-star-fill"></i><?php echo e($car->rating); ?>

                    </div>
                </div>
            </div>

            <span
                style="background:#fef2f3;color:#e8192c;border:1px solid rgba(232,25,44,0.2);padding:3px 12px;border-radius:20px;font-size:0.75rem;font-weight:600">
                <?php echo e($car->category); ?>

            </span>

            <?php if(!empty($filters['rental_days'])): ?>
                <p style="font-size:0.82rem;color:#10b981;margin:10px 0 0;font-weight:600">
                    <i class="bi bi-calculator me-1"></i>Est. <?php echo e($filters['rental_days']); ?> days:
                    ৳<?php echo e(number_format($car->price_per_day * (int) $filters['rental_days'])); ?>

                </p>
            <?php endif; ?>

            <a href="<?php echo e(route('cars.show', $car->id)); ?><?php echo e(!empty($filters['rental_days']) ? '?days=' . $filters['rental_days'] : ''); ?>"
                class="btn btn-primary w-100 mt-3">
                <i class="bi bi-eye me-2"></i>View Details
            </a>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Laravel Project\car_rental_system\resources\views/partials/car-card.blade.php ENDPATH**/ ?>