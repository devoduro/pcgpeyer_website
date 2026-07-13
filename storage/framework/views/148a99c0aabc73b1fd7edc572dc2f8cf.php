<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Presbyterian Church of Ghana - Rev. Friedrich Monninger Congregation, Akosombo">
    <title><?php echo $__env->yieldContent('title', 'PCG Monninger Congregation'); ?></title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/pcg_logo.png')); ?>">
    <link rel="apple-touch-icon" href="<?php echo e(asset('images/loadpcg_logoer.png')); ?>">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    
    <?php echo $__env->yieldPushContent('styles'); ?></head>
<body class="bg-gray-50">
    <div id="page-loader" class="fixed inset-0 z-[9999] bg-gradient-to-br from-pcg-blue-900 to-pcg-red-900 flex items-center justify-center transition-opacity duration-500">
        <div class="flex flex-col items-center">
            <img src="<?php echo e(asset('images/loader.png')); ?>" alt="PCG Logo" class="w-24 h-24 animate-pulse">
            <div class="mt-6 text-white text-sm tracking-widest uppercase">Rev. Friedrich Monninger Congregation</div>
        </div>
    </div>
    <?php echo $__env->make('partials.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>
    
    <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <!-- AOS Animation Library JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        if (window.AOS) {
          window.AOS.init({ duration: 800, easing: 'ease-out-quart', once: true, offset: 60 });
        }
      });
    </script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\pcgmonninger\resources\views/layouts/app.blade.php ENDPATH**/ ?>