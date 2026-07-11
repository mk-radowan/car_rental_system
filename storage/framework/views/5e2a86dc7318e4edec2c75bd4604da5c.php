

<?php $__env->startSection('title', 'Booking History'); ?>

<?php $__env->startSection('content'); ?>

    <div style="background:linear-gradient(135deg,#1a1a2e 0%,#16213e 100%);padding:80px 0 60px">
        <div class="container" style="padding-top:40px">
            <div class="hero-badge" style="background:rgba(255,255,255,0.1);color:white;border-color:rgba(255,255,255,0.2)">My
                Bookings</div>
            <h1 style="font-family:'Montserrat',sans-serif;font-weight:800;color:white;font-size:2rem;margin-top:12px">
                My Booking</h1>
            <p style="color:rgba(255,255,255,0.6);margin:0">Track all your car rental bookings</p>
        </div>
    </div>

    <div class="container py-5" style="margin-top:-20px">
        <div class="glass-card" style="overflow:hidden;border-top:4px solid #e8192c">
            <?php if($bookings->isEmpty()): ?>
                <div class="text-center py-5">
                    <i class="bi bi-calendar-x" style="font-size:4rem;color:#e8192c;opacity:0.3"></i>
                    <h5 style="color:#1a1a2e;margin-top:20px;font-family:'Montserrat',sans-serif;font-weight:700">No
                        Bookings Yet</h5>
                    <p style="color:#6c757d">You haven't made any bookings yet. Start exploring our fleet!</p>
                    <a href="<?php echo e(route('cars.index')); ?>" class="btn btn-primary">
                        <i class="bi bi-car-front me-2"></i> Browse Cars
                    </a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th><i class="bi bi-car-front me-2"></i>Car</th>
                                <th><i class="bi bi-calendar me-2"></i>Pickup</th>
                                <th><i class="bi bi-calendar-check me-2"></i>Return</th>
                                <th><i class="bi bi-sign-turn-right me-2"></i>Journey Route</th>
                                <th><span class="me-2" style="font-weight:700">৳</span>Amount</th>
                                <th>Status</th>
                                <th>Payment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <strong style="color:#1a1a2e"><?php echo e($booking->car_name); ?></strong>
                                    </td>
                                    <td style="color:#374151"><?php echo e($booking->pickup_date); ?></td>
                                    <td style="color:#374151"><?php echo e($booking->return_date); ?></td>
                                    <td style="color:#374151;font-size:0.82rem;line-height:1.5">
                                        <div><strong>Start:</strong> <?php echo e($booking->pickup_location ?? 'N/A'); ?></div>
                                        <div><strong>End:</strong> <?php echo e($booking->dropoff_location ?? 'N/A'); ?></div>
                                    </td>
                                    <td>
                                        <strong style="color:#10b981"><?php echo e($booking->total_amount); ?></strong>
                                    </td>
                                    <td>
                                        <span class="status-badge-<?php echo e($booking->status); ?>">
                                            <?php echo e(ucfirst($booking->status)); ?>

                                        </span>
                                    </td>
                                    <td style="min-width:220px">
                                        <?php if(($booking->payment_status ?? 'unpaid') === 'paid'): ?>
                                            <span class="badge" style="background:#dcfce7;color:#166534;border:1px solid #bbf7d0">
                                                Paid via <?php echo e(strtoupper($booking->payment_method ?? '-')); ?>

                                            </span>
                                            <div style="font-size:0.75rem;color:#64748b;margin-top:4px">
                                                Ref: <?php echo e($booking->payment_reference ?? 'N/A'); ?>

                                            </div>
                                            <div class="mt-2 d-flex gap-1 flex-wrap">
                                                <a href="<?php echo e(route('bookings.invoice', $booking->id)); ?>" class="btn btn-sm btn-outline-secondary">
                                                    View Invoice
                                                </a>
                                                <a href="<?php echo e(route('bookings.invoice.download', $booking->id)); ?>" class="btn btn-sm btn-outline-red">
                                                    Download
                                                </a>
                                            </div>
                                        <?php elseif(($booking->payment_status ?? 'unpaid') === 'processing'): ?>
                                            <span class="badge" style="background:#e0f2fe;color:#075985;border:1px solid #bae6fd">
                                                Payment Processing
                                            </span>
                                        <?php elseif(in_array($booking->payment_status ?? 'unpaid', ['failed', 'cancelled'], true)): ?>
                                            <span class="badge" style="background:#fee2e2;color:#991b1b;border:1px solid #fecaca">
                                                <?php echo e(ucfirst($booking->payment_status)); ?>

                                            </span>
                                            <div class="mt-1">
                                                <a href="<?php echo e(route('bookings.payment.show', $booking->id)); ?>" class="btn btn-sm btn-outline-red">
                                                    Retry Payment
                                                </a>
                                            </div>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('bookings.payment.show', $booking->id)); ?>" class="btn btn-sm btn-outline-red">
                                                Pay Now
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

        <div class="mt-4 d-flex gap-3">
            <a href="<?php echo e(route('cars.index')); ?>" class="btn btn-primary">
                <i class="bi bi-car-front me-2"></i>Browse More Cars
            </a>
            <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-outline-red">
                <i class="bi bi-grid me-2"></i>Dashboard
            </a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel Project\car_rental_system\resources\views/bookings/history.blade.php ENDPATH**/ ?>