

<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>

    
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <div class="hero-badge">
                        <i class="bi bi-shield-check me-1"></i> #1 Car Rental Platform in Bangladesh
                    </div>
                    <h1 class="hero-title">
                        Easy And <span class="text-red">Fast Way</span> To<br>
                        <span class="text-red">Rent Your</span> Car
                    </h1>
                    <p class="hero-subtitle">
                        Premium car rentals across 64 Bangladeshi Districts. Real-time availability, instant booking, and
                        unbeatable BDT pricing — your ride awaits.
                    </p>
                    <div class="hero-stats">
                        <div>
                            <div class="hero-stat-num">500+</div>
                            <div class="hero-stat-label">Cars Available</div>
                        </div>
                        <div style="width:1px;background:#e2e8f0"></div>
                        <div>
                            <div class="hero-stat-num">64</div>
                            <div class="hero-stat-label">Districts</div>
                        </div>
                        <div style="width:1px;background:#e2e8f0"></div>
                        <div>
                            <div class="hero-stat-num">10k+</div>
                            <div class="hero-stat-label">Happy Customers</div>
                        </div>
                    </div>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="<?php echo e(route('cars.index')); ?>" class="btn btn-primary">
                            <i class="bi bi-search"></i> Browse Cars
                        </a>
                        <?php if(auth()->guard()->guest()): ?>
                            <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-red">
                                <i class="bi bi-person-plus"></i> Get Started
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-6 hero-image-wrap d-none d-lg-flex">
                    <img src="https://images.unsplash.com/photo-1617788138017-80ad40651399?w=700&q=80&auto=format&fit=crop"
                        alt="Premium Car" style="width:90%;border-radius:20px;">
                </div>
            </div>

            
            <form class="hero-search-bar mt-5" method="GET" action="<?php echo e(route('cars.index')); ?>">
                <div class="search-field">
                    <label><i class="bi bi-geo-alt me-1"></i> Location</label>
                    <input type="hidden" name="location" value="<?php echo e(request('location', '')); ?>" data-bd-location-value>
                    <div class="row g-2" data-bd-location-picker data-selected-location="<?php echo e(request('location', '')); ?>"
                        data-all-divisions-label="All Divisions"
                        data-all-districts-label="All Districts" data-all-upazilas-label="All Upazilas">
                        <div class="col-12 mb-2">
                            <select class="form-select" data-bd-division-select>
                                <option value="">All Divisions</option>
                            </select>
                        </div>
                        <div class="col-12 mb-2">
                            <select class="form-select" data-bd-district-select>
                                <option value="">All Districts</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <select class="form-select" data-bd-upazila-select disabled>
                                <option value="">All Upazilas</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="search-field">
                    <label><i class="bi bi-tag me-1"></i> Category</label>
                    <select class="form-select" name="category">
                        <option value="">All Categories</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat); ?>" <?php echo e(request('category') === $cat ? 'selected' : ''); ?>>
                                <?php echo e($cat); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="search-field">
                    <label><i class="bi bi-calendar me-1"></i> Duration</label>
                    <select class="form-select" name="rental_days">
                        <option value="">Any Duration</option>
                        <?php $__currentLoopData = [1, 2, 3, 5, 7, 14, 30]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($d); ?>" <?php echo e(request('rental_days') == $d ? 'selected' : ''); ?>>
                                <?php echo e($d); ?> Day<?php echo e($d > 1 ? 's' : ''); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label>&nbsp;</label>
                    <button type="submit" class="btn btn-primary d-block w-100">
                        <i class="bi bi-search"></i> Search Car
                    </button>
                </div>
            </form>
        </div>
    </section>

    
    <section class="container py-5 mt-4">
        <div class="text-center mb-5">
            <div class="hero-badge">What We Offer</div>
            <h2 class="section-title mt-2">Services We Offered</h2>
            <div class="section-divider"></div>
            <p class="section-subtitle">Choose from our wide range of vehicle categories tailored for every need</p>
        </div>
        <div class="row g-4">
            <?php
                $services = [
                    [
                        'icon' => 'bi-car-front',
                        'label' => 'Wedding Rides',
                        'desc' => 'Luxury vehicles for your special day',
                        'cat' => 'Luxury',
                    ],
                    [
                        'icon' => 'bi-briefcase',
                        'label' => 'Corporate Rides',
                        'desc' => 'Professional fleet for business travel',
                        'cat' => 'Sedan',
                    ],
                    [
                        'icon' => 'bi-airplane',
                        'label' => 'Airport Rides',
                        'desc' => 'Timely, comfortable airport transfers',
                        'cat' => 'SUV',
                    ],
                    [
                        'icon' => 'bi-stars',
                        'label' => 'Premium SUVs',
                        'desc' => 'Top-tier SUVs for road trips',
                        'cat' => 'SUV',
                    ],
                    [
                        'icon' => 'bi-lightning-charge',
                        'label' => 'Electric Cars',
                        'desc' => 'Eco-friendly EV options available',
                        'cat' => 'Electric',
                    ],
                    [
                        'icon' => 'bi-bicycle',
                        'label' => 'Economy Cars',
                        'desc' => 'Budget-friendly daily commute cars',
                        'cat' => 'Hatchback',
                    ],
                ];
            ?>
            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="<?php echo e(route('cars.index', ['category' => $s['cat']])); ?>" class="service-card h-100">
                        <div class="service-icon">
                            <i class="bi <?php echo e($s['icon']); ?>"></i>
                        </div>
                        <strong
                            style="font-family:'Montserrat',sans-serif;font-size:0.88rem;color:#1a1a2e"><?php echo e($s['label']); ?></strong>
                        <p style="font-size:0.75rem;color:#6c757d;margin-top:6px;margin-bottom:0"><?php echo e($s['desc']); ?></p>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>

    
    <section class="py-5" style="background:#f8f9fa">
        <div class="container">
            <div class="text-center mb-5">
                <div class="hero-badge">Process</div>
                <h2 class="section-title mt-2">How It Works</h2>
                <div class="section-divider"></div>
            </div>
            <div class="row g-4">
                <?php
                    $steps = [
                        [
                            'icon' => 'bi-person-plus-fill',
                            'num' => '1',
                            'title' => 'Register',
                            'desc' => 'Create your account with Bangladeshi phone validation in minutes',
                        ],
                        [
                            'icon' => 'bi-search-heart',
                            'num' => '2',
                            'title' => 'Browse & Filter',
                            'desc' => 'Search by city, category, and price in  ৳ to find your perfect car',
                        ],
                        [
                            'icon' => 'bi-calendar-check-fill',
                            'num' => '3',
                            'title' => 'Book Instantly',
                            'desc' => 'Submit booking request — pending admin approval, fast & easy',
                        ],
                        [
                            'icon' => 'bi-car-front-fill',
                            'num' => '4',
                            'title' => 'Drive & Enjoy',
                            'desc' => 'Pick up your approved rental and explore Bangladesh in style',
                        ],
                    ];
                ?>
                <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6 col-lg-3">
                        <div class="glass-card step-card text-center h-100">
                            <div class="step-number"><?php echo e($step['num']); ?></div>
                            <i class="bi <?php echo e($step['icon']); ?> step-icon"></i>
                            <h5
                                style="font-family:'Montserrat',sans-serif;font-weight:700;color:#1a1a2e;margin-bottom:10px">
                                <?php echo e($step['title']); ?></h5>
                            <p style="color:#6c757d;font-size:0.875rem;margin:0"><?php echo e($step['desc']); ?></p>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    
    <section class="container py-5">
        <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
            <div>
                <div class="hero-badge">Top Picks</div>
                <h2 class="section-title mt-2">Our Super Cars</h2>
                <div class="section-divider-left"></div>
            </div>
            <a href="<?php echo e(route('cars.index')); ?>" class="btn btn-outline-red">
                View All Cars <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <div class="row">
            <?php $__empty_1 = true; $__currentLoopData = $featuredCars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php echo $__env->make('partials.car-card', ['car' => $car, 'filters' => []], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center py-5">
                    <i class="bi bi-car-front display-1" style="color:#e8192c;opacity:0.3"></i>
                    <p class="mt-3" style="color:#6c757d">No cars available. Run <code>php artisan db:seed</code></p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    
    <section class="feature-strip">
        <div class="container">
            <div class="row g-4">
                <?php
                    $features = [
                        [
                            'icon' => 'bi-headset',
                            'title' => 'Customer Satisfaction',
                            'desc' => '24/7 dedicated support for every booking',
                        ],
                        [
                            'icon' => 'bi-calendar2-check',
                            'title' => 'Faster Bookings',
                            'desc' => 'Instant booking request processing',
                        ],
                        [
                            'icon' => 'bi-shield-check',
                            'title' => 'Money-Back Promise',
                            'desc' => 'Full refund guarantee on cancellations',
                        ],
                        ['icon' => 'bi-award', 'title' => 'Premium Fleet', 'desc' => 'All cars inspected and insured'],
                    ];
                ?>
                <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-6 col-lg-3">
                        <div class="feature-item">
                            <i class="bi <?php echo e($f['icon']); ?> d-block mb-2"></i>
                            <h6><?php echo e($f['title']); ?></h6>
                            <p><?php echo e($f['desc']); ?></p>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    
    <section class="container py-5">
        <div class="text-center mb-5">
            <div class="hero-badge">Reviews</div>
            <h2 class="section-title mt-2">What Our Customers Say</h2>
            <div class="section-divider"></div>
        </div>
        <div class="row g-4">
            <?php
                $testimonials = [
                    [
                        'stars' => 5,
                        'quote' =>
                            'Booked a Hyundai Creta in Bangalore. Smooth process and great  ৳ pricing! Will definitely use again.',
                        'name' => 'Priya M.',
                        'city' => 'Bangalore',
                    ],
                    [
                        'stars' => 5,
                        'quote' =>
                            'Tata Nexon EV for my Delhi trip. Admin approval was quick and the car was in pristine condition.',
                        'name' => 'Amit K.',
                        'city' => 'Delhi',
                    ],
                    [
                        'stars' => 5,
                        'quote' =>
                            'Luxury BMW X1 in Mumbai at  ৳8000/day — worth every rupee for business travel. Top-notch service!',
                        'name' => 'Sneha R.',
                        'city' => 'Mumbai',
                    ],
                ];
            ?>
            <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                    <div class="testimonial-card h-100">
                        <div class="rating-stars mb-3">
                            <?php for($i = 0; $i < $t['stars']; $i++): ?>
                                <i class="bi bi-star-fill"></i>
                            <?php endfor; ?>
                        </div>
                        <p style="color:#374151;line-height:1.7;font-size:0.95rem;font-style:italic">"<?php echo e($t['quote']); ?>"
                        </p>
                        <div class="d-flex align-items-center gap-3 mt-3">
                            <div
                                style="width:42px;height:42px;background:#e8192c;border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-family:'Montserrat',sans-serif">
                                <?php echo e(substr($t['name'], 0, 1)); ?>

                            </div>
                            <div>
                                <strong style="color:#1a1a2e;font-size:0.9rem"><?php echo e($t['name']); ?></strong>
                                <div style="font-size:0.78rem;color:#6c757d"><?php echo e($t['city']); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>

    
    <section class="py-5" style="background:#f8f9fa">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-5">
                    <div class="hero-badge">FAQ</div>
                    <h2 class="section-title mt-2">Frequently Asked Questions</h2>
                    <div class="section-divider-left"></div>
                    <p style="color:#6c757d;line-height:1.7">Got questions about renting with us? Find your answers here,
                        or reach our 24/7 support team.</p>
                    <a href="<?php echo e(route('cars.index')); ?>" class="btn btn-primary mt-3">
                        <i class="bi bi-car-front"></i> Browse Cars Now
                    </a>
                </div>
                <div class="col-lg-7">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq1">
                                    <i class="bi bi-currency-rupee me-2 text-red"></i> What currency do you use?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">All prices are in Bangladeshi Taka ( ৳) only. Examples:
                                    ৳1200/day, ৳2500/day, ৳8000/day for luxury.</div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq2">
                                    <i class="bi bi-calendar-check me-2 text-red"></i> How does booking approval work?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">Your booking stays pending until an admin approves it. You'll
                                    see a confirmation message and can track status in your dashboard.</div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq3">
                                    <i class="bi bi-geo-alt me-2 text-red"></i> Which cities are covered?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">Dhaka, Chittagong, Khulna, Rajshahi, Sylhet, Barisal, Rangpur,
                                    Mymensingh, Comilla, Jessore, Bogura, and Narayanganj.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq4">
                                    <i class="bi bi-shield-check me-2 text-red"></i> Is insurance included?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">Yes, all our vehicles come with basic insurance coverage.
                                    Premium insurance can be added at an additional cost during booking.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="bg-red-section py-5">
        <div class="container text-center" style="position:relative;z-index:1">
            <h2 style="font-family:'Montserrat',sans-serif;font-weight:800;color:white;font-size:2rem;margin-bottom:16px">
                Ready to Hit the Road?
            </h2>
            <p style="color:rgba(255,255,255,0.85);margin-bottom:30px;font-size:1rem">
                Find your perfect rental car across 64 Bangladeshi districts at unbeatable prices.
            </p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="<?php echo e(route('cars.index')); ?>" class="btn"
                    style="background:white;color:#e8192c;font-family:'Montserrat',sans-serif;font-weight:700;padding:12px 32px;border-radius:50px;font-size:0.9rem">
                    <i class="bi bi-search me-2"></i> Browse Cars
                </a>
                <?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-light">
                        <i class="bi bi-person-plus me-2"></i> Register Free
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel Project\car_rental_system\resources\views/home.blade.php ENDPATH**/ ?>