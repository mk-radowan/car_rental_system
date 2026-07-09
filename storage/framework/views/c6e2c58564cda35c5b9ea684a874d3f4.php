
<?php $__env->startSection('title', 'Edit Car'); ?>
<?php $__env->startSection('page-title', 'Edit Car'); ?>
<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="glass-card p-4" style="border-top:4px solid #3b82f6">
            <h5 style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:24px">
                <i class="bi bi-pencil-square me-2" style="color:#3b82f6"></i>Edit: <?php echo e($car->brand); ?> <?php echo e($car->model); ?>

            </h5>
            <form method="POST" action="<?php echo e(route('admin.cars.update', $car->id)); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <?php echo $__env->make('admin.cars._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <div class="d-flex gap-3 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-2"></i>Update Car
                    </button>
                    <a href="<?php echo e(route('admin.cars')); ?>" class="btn btn-outline-red">
                        <i class="bi bi-arrow-left me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel Project\car_rental_system\resources\views/admin/cars/edit.blade.php ENDPATH**/ ?>