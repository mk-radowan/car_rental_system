

<?php $__env->startSection('title', 'Edit User'); ?>
<?php $__env->startSection('page-title', 'Edit User'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="glass-card p-4" style="border-top:4px solid #3b82f6">
                <h5 style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:20px">
                    <i class="bi bi-pencil-square me-2" style="color:#3b82f6"></i>Edit User
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

                <form method="POST" action="<?php echo e(route('admin.users.update', $user->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $user->name)); ?>"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control"
                                value="<?php echo e(old('email', $user->email)); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" maxlength="11"
                                value="<?php echo e(old('phone', $user->phone)); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select" required>
                                <option value="customer" <?php echo e(old('role', $user->role) === 'customer' ? 'selected' : ''); ?>>
                                    Customer</option>
                                <option value="admin" <?php echo e(old('role', $user->role) === 'admin' ? 'selected' : ''); ?>>Admin
                                </option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">New Password (optional)</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="Leave blank to keep old password">
                        </div>
                    </div>

                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-2"></i>Update User
                        </button>
                        <a href="<?php echo e(route('admin.users')); ?>" class="btn btn-outline-red">
                            <i class="bi bi-arrow-left me-2"></i>Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel Project\car_rental_system\resources\views/admin/users-edit.blade.php ENDPATH**/ ?>