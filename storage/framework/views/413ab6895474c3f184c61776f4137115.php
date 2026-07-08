

<?php $__env->startSection('title', 'Register'); ?>

<?php $__env->startSection('content'); ?>
    <div style="background:linear-gradient(135deg,#f8f9fa 0%,#fef2f3 100%);min-height:100vh;padding-top:80px">
        <div class="container py-5">
            <div class="row align-items-center g-5 justify-content-center">

                
                <div class="col-lg-4 d-none d-lg-block">
                    <div class="hero-badge mb-3">Join Pothik</div>
                    <h2
                        style="font-family:'Montserrat',sans-serif;font-weight:800;color:#1a1a2e;font-size:1.9rem;margin-bottom:16px">
                        Start Your Journey<br><span style="color:#e8192c">Today — Free!</span>
                    </h2>
                    <p style="color:#6c757d;margin-bottom:28px;line-height:1.7">Create an account and gain instant access to
                        500+ premium cars across 12 Indian cities.</p>
                    <?php
                        $perks = [
                            'No hidden fees — all prices in ৳',
                            'Instant booking requests',
                            'Real-time availability',
                            '24/7 customer support',
                        ];
                    ?>
                    <?php $__currentLoopData = $perks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div
                                style="width:32px;height:32px;background:#e8192c;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                                <i class="bi bi-check text-white" style="font-size:1rem"></i>
                            </div>
                            <span style="color:#374151;font-size:0.9rem"><?php echo e($perk); ?></span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                
                <div class="col-lg-6 col-md-9">
                    <div class="auth-card">
                        <div class="text-center mb-4">
                            <div
                                style="width:64px;height:64px;background:#fef2f3;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;border:2px solid rgba(232,25,44,0.2)">
                                <i class="bi bi-person-plus-fill" style="font-size:1.8rem;color:#e8192c"></i>
                            </div>
                            <h2 style="font-family:'Montserrat',sans-serif;font-weight:800;color:#1a1a2e">Create Account
                            </h2>
                            <p style="color:#6c757d;font-size:0.9rem">Join thousands of happy Pothik customers</p>
                        </div>

                        <form method="POST" action="<?php echo e(route('register')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Full Name *</label>
                                    <div class="input-group">
                                        <span class="input-group-text"
                                            style="background:white;border:1.5px solid #e2e8f0;border-right:none;border-radius:8px 0 0 8px">
                                            <i class="bi bi-person" style="color:#e8192c"></i>
                                        </span>
                                        <input type="text" name="name"
                                            class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            style="border-left:none;border-radius:0 8px 8px 0" value="<?php echo e(old('name')); ?>"
                                            placeholder="Rahul Sharma" required>
                                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email Address *</label>
                                    <div class="input-group">
                                        <span class="input-group-text"
                                            style="background:white;border:1.5px solid #e2e8f0;border-right:none;border-radius:8px 0 0 8px">
                                            <i class="bi bi-envelope" style="color:#e8192c"></i>
                                        </span>
                                        <input type="email" name="email"
                                            class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            style="border-left:none;border-radius:0 8px 8px 0" value="<?php echo e(old('email')); ?>"
                                            placeholder="rahul@email.com" required>
                                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone (10-digit) *</label>
                                    <div class="input-group">
                                        <span class="input-group-text"
                                            style="background:white;border:1.5px solid #e2e8f0;border-right:none;border-radius:8px 0 0 8px">
                                            <i class="bi bi-telephone" style="color:#e8192c"></i>
                                        </span>
                                        <input type="text" name="phone"
                                            class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            style="border-left:none;border-radius:0 8px 8px 0" value="<?php echo e(old('phone')); ?>"
                                            placeholder="9876543210" required>
                                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Account Role *</label>
                                    <div class="input-group">
                                        <span class="input-group-text"
                                            style="background:white;border:1.5px solid #e2e8f0;border-right:none;border-radius:8px 0 0 8px">
                                            <i class="bi bi-shield-person" style="color:#e8192c"></i>
                                        </span>
                                        <select name="role" class="form-select <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            style="border-left:none;border-radius:0 8px 8px 0" required>
                                            <option value="customer" <?php echo e(old('role') === 'customer' ? 'selected' : ''); ?>>Customer
                                            </option>
                                            <option value="admin" <?php echo e(old('role') === 'admin' ? 'selected' : ''); ?>>Admin</option>
                                        </select>
                                        <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Password * (min 6 chars)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"
                                            style="background:white;border:1.5px solid #e2e8f0;border-right:none;border-radius:8px 0 0 8px">
                                            <i class="bi bi-lock" style="color:#e8192c"></i>
                                        </span>
                                        <input type="password" name="password"
                                            class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            style="border-left:none;border-radius:0 8px 8px 0" placeholder="••••••••"
                                            required>
                                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Confirm Password *</label>
                                    <div class="input-group">
                                        <span class="input-group-text"
                                            style="background:white;border:1.5px solid #e2e8f0;border-right:none;border-radius:8px 0 0 8px">
                                            <i class="bi bi-lock-fill" style="color:#e8192c"></i>
                                        </span>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            style="border-left:none;border-radius:0 8px 8px 0" placeholder="••••••••"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mt-4" style="padding:14px">
                                <i class="bi bi-person-plus me-2"></i> Create My Account
                            </button>
                        </form>

                        <hr style="margin:24px 0;border-color:#f0f2f5">
                        <p class="text-center mb-0" style="color:#6c757d;font-size:0.9rem">
                            Already registered? <a href="<?php echo e(route('login')); ?>">Sign in here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel Project\car_rental_system\resources\views/auth/register.blade.php ENDPATH**/ ?>