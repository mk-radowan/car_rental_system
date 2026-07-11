<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Pothik Rentals'); ?> - Drive with Pothik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body>
    <nav class="navbar navbar-expand-lg glass-nav fixed-top">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
                <i class="bi bi-car-front-fill"></i>
                Pothik
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto ms-4">
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('home')); ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('cars.index')); ?>">Browse Cars</a></li>
                </ul>
                <ul class="navbar-nav align-items-center gap-1">
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->isAdmin()): ?>
                            <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.dashboard')); ?>"><i
                                        class="bi bi-speedometer2 me-1"></i>Admin Panel</a></li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo e(route('bookings.history')); ?>">My Bookings</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('profile')); ?>"><i
                                    class="bi bi-person-circle me-1"></i>Profile</a></li>
                        <li class="nav-item">
                            <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-outline-red btn-sm ms-2">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('login')); ?>">Login</a></li>
                        <li class="nav-item"><a class="btn btn-primary btn-sm ms-2" href="<?php echo e(route('register')); ?>">
                                <i class="bi bi-person-plus"></i> Register
                            </a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <main class="main-content">
        <?php if(session('success')): ?>
            <div class="container mt-4 pt-4">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i><?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="container mt-4 pt-4">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo e(session('error')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        <?php endif; ?>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="footer-glass mt-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <h5 class="mb-3">
                        <i class="bi bi-car-front-fill me-2" style="color:#e8192c"></i>Pothik Rentals
                    </h5>
                    <p class="small" style="color:rgba(255,255,255,0.6);line-height:1.7">
                        Bangladesh's premium car rental platform. Real-time availability across 8 Divisions. All
                        prices
                        in BDT ( ৳).
                    </p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="text-white opacity-75 fs-5"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white opacity-75 fs-5"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="text-white opacity-75 fs-5"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 class="mb-3" style="font-family:'Montserrat',sans-serif;font-weight:700;letter-spacing:0.5px">
                        Quick Links</h6>
                    <ul class="list-unstyled small" style="color:rgba(255,255,255,0.6)">
                        <li class="mb-2"><a href="<?php echo e(route('home')); ?>" class="text-decoration-none"
                                style="color:rgba(255,255,255,0.6)">Home</a></li>
                        <li class="mb-2"><a href="<?php echo e(route('cars.index')); ?>" class="text-decoration-none"
                                style="color:rgba(255,255,255,0.6)">Browse Cars</a></li>
                        <li class="mb-2"><a href="<?php echo e(route('login')); ?>" class="text-decoration-none"
                                style="color:rgba(255,255,255,0.6)">Login</a></li>
                        <li class="mb-2"><a href="<?php echo e(route('register')); ?>" class="text-decoration-none"
                                style="color:rgba(255,255,255,0.6)">Register</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h6 class="mb-3"
                        style="font-family:'Montserrat',sans-serif;font-weight:700;letter-spacing:0.5px">All Divisions
                        We
                        Serve</h6>
                    <p class="small" style="color:rgba(255,255,255,0.6);line-height:1.8">
                        Dhaka · Chittagong · Khulna · Rajshahi · Sylhet · Barisal · Rangpur · Mymensingh
                    </p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h6 class="mb-3"
                        style="font-family:'Montserrat',sans-serif;font-weight:700;letter-spacing:0.5px">Contact Us
                    </h6>
                    <p class="small mb-2" style="color:rgba(255,255,255,0.6)"><i class="bi bi-envelope me-2"
                            style="color:#e8192c"></i>support@Pothik.bd</p>
                    <p class="small mb-2" style="color:rgba(255,255,255,0.6)"><i class="bi bi-telephone me-2"
                            style="color:#e8192c"></i>Anywhere-Drive-BD</p>
                    <p class="small" style="color:rgba(255,255,255,0.6)"><i class="bi bi-clock me-2"
                            style="color:#e8192c"></i>24/7 Support</p>
                </div>
            </div>
            <hr style="border-color:rgba(255,255,255,0.1);margin-top:40px">
            <p class="text-center small mb-0" style="color:rgba(255,255,255,0.4)">&copy; <?php echo e(date('Y')); ?> Pothik
                Rentals. All rights reserved. All prices in BDT ( ৳).</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\Laravel Project\car_rental_system\resources\views/layouts/app.blade.php ENDPATH**/ ?>