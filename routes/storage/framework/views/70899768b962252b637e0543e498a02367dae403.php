<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>"
    dir=<?php echo e(\App\Models\Utility::getValByName('enable_rtl') == 'on' ? 'rtl' : 'ltr'); ?>>
<?php
$logo = \App\Models\Utility::get_file('logo/');
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?> &dash; <?php echo e(config('app.name', 'TaskGo SaaS')); ?></title>
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
    
    <link rel="icon" href="<?php echo e($logo.'favicon.png'); ?>" type="image/png">
    
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('assets/libs/@fortawesome/fontawesome-free/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/site-light.css')); ?>" id="stylesheet">
    <?php if(\App\Models\Utility::getValByName('enable_rtl') == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap-rtl.css')); ?>">
    <?php endif; ?>


</head>

<body class="application application-offset">
    <?php echo $__env->make('layouts.lightthemecolor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div id="app">
        <div class="container-fluid container-application">
            <div class="main-content position-relative">
                <div class="page-content">
                    <div class="min-vh-100 py-5 d-flex align-items-center">
                        <div class="w-100">
                            <div class="row justify-content-center">
                                <?php echo $__env->yieldContent('language-bar'); ?>
                                <?php echo $__env->yieldContent('content'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

<script src="<?php echo e(asset('assets/js/purpose.core.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/purpose.js')); ?>"></script>
<?php echo $__env->yieldPushContent('custom-scripts'); ?>

</html>
<?php /**PATH /var/www/html/product/taskgo-saas/main_file/resources/views/layouts/auth.blade.php ENDPATH**/ ?>