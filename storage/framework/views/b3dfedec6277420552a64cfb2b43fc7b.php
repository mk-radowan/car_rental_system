

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>


<div style="background:linear-gradient(135deg,#1a1a2e 0%,#16213e 100%);padding:80px 0 60px">
    <div class="container" style="padding-top:40px">
        <div class="d-flex align-items-center gap-4">
            <div style="width:70px;height:70px;background:#e8192c;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.8rem;color:white;font-weight:800;font-family:'Montserrat',sans-serif;flex-shrink:0">
                <?php echo e(substr(auth()->user()->name,0,1)); ?>

            </div>
            <div>
                <p style="color:rgba(255,255,255,0.6);font-size:0.85rem;margin:0">Welcome back,</p>
                <h1 style="font-family:'Montserrat',sans-serif;font-weight:800;color:white;font-size:1.8rem;margin:0">
                    <?php echo e(auth()->user()->name); ?>!
                </h1>
            </div>
        </div>
    </div>
</div>

<div class="container py-4" style="margin-top:-30px">
    
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="glass-card" style="padding:28px 24px;border-top:4px solid #e8192c;text-align:center">
                <i class="bi bi-calendar-check" style="font-size:2rem;color:#e8192c;margin-bottom:10px;display:block"></i>
                <div style="font-family:'Montserrat',sans-serif;font-weight:800;font-size:2.5rem;color:#1a1a2e;line-height:1"><?php echo e($totalBookings); ?></div>
                <p style="color:#6c757d;margin:6px 0 0">Total Bookings</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="glass-card" style="padding:28px 24px;border-top:4px solid #f59e0b;text-align:center">
                <i class="bi bi-hourglass-split" style="font-size:2rem;color:#f59e0b;margin-bottom:10px;display:block"></i>
                <div style="font-family:'Montserrat',sans-serif;font-weight:800;font-size:2.5rem;color:#1a1a2e;line-height:1"><?php echo e($pendingBookings->count()); ?></div>
                <p style="color:#6c757d;margin:6px 0 0">Pending Requests</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="glass-card" style="padding:28px 24px;border-top:4px solid #10b981;text-align:center">
                <i class="bi bi-check-circle" style="font-size:2rem;color:#10b981;margin-bottom:10px;display:block"></i>
                <div style="font-family:'Montserrat',sans-serif;font-weight:800;font-size:2.5rem;color:#1a1a2e;line-height:1"><?php echo e($approvedBookings->count()); ?></div>
                <p style="color:#6c757d;margin:6px 0 0">Approved Rentals</p>
            </div>
        </div>
    </div>

    
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="glass-card p-4">
                <h4 style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:20px">
                    <i class="bi bi-hourglass-split me-2" style="color:#f59e0b"></i>Pending Bookings
                </h4>
                <?php $__empty_1 = true; $__currentLoopData = $pendingBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div style="padding:16px 0;border-bottom:1px solid #f0f2f5">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <strong style="color:#1a1a2e;font-size:0.95rem"><?php echo e($booking->car_name); ?></strong>
                            <p style="color:#6c757d;font-size:0.82rem;margin:4px 0">
                                <i class="bi bi-calendar me-1"></i><?php echo e($booking->pickup_date); ?> → <?php echo e($booking->return_date); ?>

                            </p>
                        </div>
                        <div class="text-end">
                            <span class="status-badge-pending">Pending</span>
                            <div style="color:#10b981;font-weight:700;font-size:0.9rem;margin-top:4px"><?php echo e($booking->total_amount); ?></div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="text-center py-4">
                    <i class="bi bi-check-circle" style="font-size:2.5rem;color:#10b981;opacity:0.4"></i>
                    <p style="color:#6c757d;margin-top:10px;font-size:0.9rem">No pending bookings.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="glass-card p-4">
                <h4 style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:20px">
                    <i class="bi bi-check-circle me-2" style="color:#10b981"></i>Approved Rentals
                </h4>
                <?php $__empty_1 = true; $__currentLoopData = $approvedBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div style="padding:16px 0;border-bottom:1px solid #f0f2f5">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <strong style="color:#1a1a2e;font-size:0.95rem"><?php echo e($booking->car_name); ?></strong>
                            <p style="color:#6c757d;font-size:0.82rem;margin:4px 0">
                                <i class="bi bi-calendar me-1"></i><?php echo e($booking->pickup_date); ?> → <?php echo e($booking->return_date); ?>

                            </p>
                        </div>
                        <span class="status-badge-approved">Approved</span>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="text-center py-4">
                    <i class="bi bi-car-front" style="font-size:2.5rem;color:#e8192c;opacity:0.4"></i>
                    <p style="color:#6c757d;margin-top:10px;font-size:0.9rem">No approved bookings yet.</p>
                </div>
                <?php endif; ?>
                <a href="<?php echo e(route('bookings.history')); ?>" class="btn btn-outline-red btn-sm mt-3">
                    <i class="bi bi-clock-history me-1"></i> Full History
                </a>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="<?php echo e(route('cars.index')); ?>" class="btn btn-primary">
            <i class="bi bi-car-front me-2"></i>Browse More Cars
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel Project\car_rental_system\resources\views/dashboard.blade.php ENDPATH**/ ?>