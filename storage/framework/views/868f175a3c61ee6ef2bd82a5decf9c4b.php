<img src="<?php echo e($car->image_url); ?>"
     alt="<?php echo e($car->brand); ?> <?php echo e($car->model); ?>"
     class="<?php echo e($class ?? 'card-img-top'); ?>"
     loading="lazy"
     onerror="this.onerror=null;this.src='<?php echo e($car->fallback_image_url); ?>';">
<?php /**PATH C:\xampp\htdocs\Laravel Project\car_rental_system\resources\views/partials/car-image.blade.php ENDPATH**/ ?>