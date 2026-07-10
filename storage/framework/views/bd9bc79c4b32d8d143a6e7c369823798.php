<?php $__env->startSection('title', 'Booking Requests'); ?>
<?php $__env->startSection('page-title', 'Booking Requests'); ?>

<?php $__env->startSection('content'); ?>
<div class="glass-card" style="overflow:hidden">
    <div style="padding:20px 24px;border-bottom:1px solid #f3f4f6">
        <h5 style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e;margin:0">
            <i class="bi bi-calendar-check me-2" style="color:#e8192c"></i>All Booking Requests
        </h5>
    </div>
    <div class="table-responsive admin-table">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Car</th>
                    <th>Pickup</th>
                    <th>Return</th>
                    <th>Invoice</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><strong><?php echo e($booking->customer_name); ?></strong></td>
                    <td><?php echo e($booking->car_name); ?></td>
                    <td><?php echo e($booking->pickup_date); ?></td>
                    <td><?php echo e($booking->return_date); ?></td>
                    <td>
                        <?php if(($booking->payment_status ?? 'unpaid') === 'paid'): ?>
                            <div class="d-flex gap-1">
                                <a href="<?php echo e(route('admin.bookings.invoice', $booking->id)); ?>" class="btn btn-sm" title="View Invoice"
                                   style="background:#eef2ff;color:#3730a3;border:none;border-radius:8px">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?php echo e(route('admin.bookings.invoice.download', $booking->id)); ?>" class="btn btn-sm" title="Download Invoice"
                                   style="background:#ecfdf5;color:#065f46;border:none;border-radius:8px">
                                    <i class="bi bi-download"></i>
                                </a>
                            </div>
                        <?php else: ?>
                            <span class="badge" style="background:#f3f4f6;color:#6b7280">Not Paid</span>
                        <?php endif; ?>
                    </td>
                    <td><span class="status-badge-<?php echo e($booking->status); ?>"><?php echo e(ucfirst($booking->status)); ?></span></td>
                    <td>
                        <div class="d-flex gap-1 flex-wrap">
                            <a href="<?php echo e(route('admin.bookings.view', $booking->id)); ?>" class="btn btn-sm" style="background:#f3f4f6;color:#374151;border:none;border-radius:20px">View</a>
                            <?php if($booking->status === 'pending'): ?>
                            <form action="<?php echo e(route('admin.bookings.approve', $booking->id)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?><button class="btn btn-sm" style="background:#d1fae5;color:#065f46;border:none;border-radius:20px">✓ Approve</button>
                            </form>
                            <form action="<?php echo e(route('admin.bookings.reject', $booking->id)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?><button class="btn btn-sm" style="background:#fee2e2;color:#991b1b;border:none;border-radius:20px">✕ Reject</button>
                            </form>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" class="text-center py-4" style="color:#6c757d">
                        <i class="bi bi-calendar-x d-block mb-2" style="font-size:2rem;color:#e8192c;opacity:0.4"></i>
                        No bookings found.
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /opt/lampp/htdocs/car_rental_system/resources/views/admin/bookings.blade.php ENDPATH**/ ?>