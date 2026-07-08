
<?php $__env->startSection('title', 'Manage Cars'); ?>
<?php $__env->startSection('page-title', 'Manage Cars'); ?>
<?php $__env->startSection('content'); ?>
    <div class="mb-4">
        <a href="<?php echo e(route('admin.cars.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Add New Car
        </a>
    </div>
    <div class="glass-card" style="overflow:hidden">
        <div style="padding:20px 24px;border-bottom:1px solid #f3f4f6">
            <h5 style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e;margin:0">
                <i class="bi bi-car-front me-2" style="color:#e8192c"></i>Fleet Management
            </h5>
        </div>
        <div class="table-responsive admin-table">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Car</th>
                        <th>Category</th>
                        <th>Location</th>
                        <th>Price/Day</th>
                        <th>Availability</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="<?php echo e($car->image_url); ?>" width="56" height="40" class="rounded"
                                        style="object-fit:cover;border:1px solid #f3f4f6"
                                        onerror="this.onerror=null;this.src='<?php echo e($car->fallback_image_url); ?>';">
                                    <strong style="color:#1a1a2e"><?php echo e($car->brand); ?> <?php echo e($car->model); ?></strong>
                                </div>
                            </td>
                            <td><span
                                    style="background:#fef2f3;color:#e8192c;padding:3px 10px;border-radius:20px;font-size:0.75rem;font-weight:600"><?php echo e($car->category); ?></span>
                            </td>
                            <td style="color:#374151"><?php echo e($car->location); ?></td>
                            <td><strong style="color:#10b981"> ৳<?php echo e(number_format($car->price_per_day)); ?>/day</strong></td>
                            <td>
                                <span
                                    style="background:<?php echo e($car->availability === 'available' ? '#d1fae5' : '#f3f4f6'); ?>;color:<?php echo e($car->availability === 'available' ? '#065f46' : '#6b7280'); ?>;padding:3px 12px;border-radius:20px;font-size:0.78rem;font-weight:600">
                                    <?php echo e(ucfirst($car->availability)); ?>

                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="<?php echo e(route('admin.cars.edit', $car->id)); ?>" class="btn btn-sm"
                                        style="background:#eff6ff;color:#1d4ed8;border:none;border-radius:20px">
                                        <i class="bi bi-pencil me-1"></i>Edit
                                    </a>
                                    <form action="<?php echo e(route('admin.cars.destroy', $car->id)); ?>" method="POST"
                                        class="d-inline" onsubmit="return confirm('Delete this car?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button class="btn btn-sm"
                                            style="background:#fee2e2;color:#991b1b;border:none;border-radius:20px">
                                            <i class="bi bi-trash me-1"></i>Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel Project\car_rental_system\resources\views/admin/cars/index.blade.php ENDPATH**/ ?>