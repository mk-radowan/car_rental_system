<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Admin'); ?> - Pothik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/admin.css')); ?>" rel="stylesheet">
</head>

<body class="admin-body">
    <div class="admin-wrapper">
        <aside class="admin-sidebar">
            <div class="sidebar-brand">
                <h5><i class="bi bi-car-front-fill me-2"></i>Pothik</h5>
                <p style="color:rgba(255,255,255,0.4);font-size:0.72rem;margin:4px 0 0;letter-spacing:0.5px">ADMIN PANEL
                </p>
            </div>
            <nav class="nav flex-column p-3">
                <a class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.dashboard')); ?>">
                    <i class="bi bi-grid-3x3-gap"></i> Dashboard
                </a>
                <a class="nav-link <?php echo e(request()->routeIs('admin.cars*') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.cars')); ?>">
                    <i class="bi bi-car-front"></i> Manage Cars
                </a>
                <a class="nav-link <?php echo e(request()->routeIs('admin.bookings*') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.bookings')); ?>">
                    <i class="bi bi-calendar-check"></i> Booking Requests
                </a>
                <a class="nav-link <?php echo e(request()->routeIs('admin.users') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.users')); ?>">
                    <i class="bi bi-people"></i> Manage Users
                </a>
                <a class="nav-link <?php echo e(request()->routeIs('admin.analytics') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.analytics')); ?>">
                    <i class="bi bi-bar-chart-line"></i> Analytics
                </a>
                <hr style="border-color:rgba(255,255,255,0.08);margin:12px 0">
                <a class="nav-link" href="<?php echo e(route('home')); ?>">
                    <i class="bi bi-house"></i> View Site
                </a>
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="nav-link btn btn-link text-start w-100 border-0"
                        style="color:#ef4444 !important;padding:11px 16px">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </button>
                </form>
            </nav>
        </aside>

        <main class="admin-main">
            <div class="admin-topbar glass-panel mb-4 p-3 d-flex align-items-center justify-content-between">
                <h4 class="mb-0"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h4>
                <div class="d-flex align-items-center gap-3">
                    <span style="font-size:0.82rem;color:#6c757d">
                        <i class="bi bi-person-circle me-1" style="color:#e8192c"></i><?php echo e(auth()->user()->name); ?>

                    </span>
                    <span
                        style="background:#fef2f3;color:#e8192c;font-size:0.75rem;font-weight:700;padding:4px 10px;border-radius:20px;font-family:'Montserrat',sans-serif">
                        ADMIN
                    </span>
                </div>
            </div>

            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show mb-4">
                    <i class="bi bi-check-circle me-2"></i><?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show mb-4">
                    <i class="bi bi-exclamation-triangle me-2"></i><?php echo e(session('error')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\Laravel Project\car_rental_system\resources\views/layouts/admin.blade.php ENDPATH**/ ?>