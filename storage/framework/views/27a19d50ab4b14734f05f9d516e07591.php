
<?php $__env->startSection('title', 'Manage Users'); ?>
<?php $__env->startSection('page-title', 'Manage Users'); ?>
<?php $__env->startSection('content'); ?>
    <div class="glass-card" style="overflow:hidden">
        <div style="padding:20px 24px;border-bottom:1px solid #f3f4f6"
            class="d-flex justify-content-between align-items-center gap-2 flex-wrap">
            <h5 style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e;margin:0">
                <i class="bi bi-people me-2" style="color:#e8192c"></i>All Users
            </h5>
            <a href="<?php echo e(route('admin.users.create')); ?>" class="btn btn-primary btn-sm">
                <i class="bi bi-person-plus me-1"></i>Create User
            </a>
        </div>
        <div class="table-responsive admin-table">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Registered</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div
                                        style="width:34px;height:34px;background:<?php echo e($user->role === 'admin' ? '#e8192c' : '#3b82f6'); ?>;border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:0.8rem;flex-shrink:0">
                                        <?php echo e(substr($user->name, 0, 1)); ?>

                                    </div>
                                    <strong style="color:#1a1a2e"><?php echo e($user->name); ?></strong>
                                </div>
                            </td>
                            <td style="color:#374151"><?php echo e($user->email); ?></td>
                            <td style="color:#374151"><?php echo e($user->phone); ?></td>
                            <td>
                                <span
                                    style="background:<?php echo e($user->role === 'admin' ? '#fee2e2' : '#eff6ff'); ?>;color:<?php echo e($user->role === 'admin' ? '#991b1b' : '#1d4ed8'); ?>;padding:3px 12px;border-radius:20px;font-size:0.78rem;font-weight:700">
                                    <?php echo e(ucfirst($user->role)); ?>

                                </span>
                            </td>
                            <td>
                                <span
                                    style="background:<?php echo e($user->is_active ? '#d1fae5' : '#fee2e2'); ?>;color:<?php echo e($user->is_active ? '#065f46' : '#991b1b'); ?>;padding:3px 12px;border-radius:20px;font-size:0.78rem;font-weight:700">
                                    <?php echo e($user->is_active ? 'Enabled' : 'Disabled'); ?>

                                </span>
                            </td>
                            <td style="color:#6c757d;font-size:0.85rem"><?php echo e($user->created_at?->format('d/m/Y')); ?></td>
                            <td>
                                <div class="d-flex gap-1 flex-wrap">
                                    <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>" class="btn btn-sm"
                                        style="background:#eff6ff;color:#1d4ed8;border:none;border-radius:20px">Edit</a>

                                    <form action="<?php echo e(route('admin.users.toggle', $user->id)); ?>" method="POST"
                                        class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-sm"
                                            style="background:<?php echo e($user->is_active ? '#fff7ed' : '#ecfdf5'); ?>;color:<?php echo e($user->is_active ? '#c2410c' : '#065f46'); ?>;border:none;border-radius:20px"
                                            <?php echo e(auth()->id() === $user->id ? 'disabled' : ''); ?>>
                                            <?php echo e($user->is_active ? 'Disable' : 'Enable'); ?>

                                        </button>
                                    </form>

                                    <form action="<?php echo e(route('admin.users.destroy', $user->id)); ?>" method="POST"
                                        class="d-inline" onsubmit="return confirm('Delete this user?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm"
                                            style="background:#fee2e2;color:#991b1b;border:none;border-radius:20px"
                                            <?php echo e(auth()->id() === $user->id ? 'disabled' : ''); ?>>
                                            Delete
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

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel Project\car_rental_system\resources\views/admin/users.blade.php ENDPATH**/ ?>