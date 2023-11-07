<?php
    $temp_lang = \App::getLocale('lang');
    if($temp_lang == 'ar' || $temp_lang == 'he'){
        $rtl = 'on';
    }
    else {
        $rtl = admin_setting('site_rtl');
    }
?>
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" dir="<?php echo e($rtl == 'on'?'rtl':''); ?>">

<head>
    
    <title><?php echo $__env->yieldContent('page-title'); ?> | <?php echo e(!empty(admin_setting('title_text')) ? admin_setting('title_text') : config('app.name', 'WorkDo')); ?></title>

    <meta name="title" content="<?php echo e(!empty(admin_setting('meta_title')) ? admin_setting('meta_title') : 'WOrkdo Dash'); ?>">
    <meta name="keywords" content="<?php echo e(!empty(admin_setting('meta_keywords')) ? admin_setting('meta_keywords') : 'WorkDo Dash,SaaS solution,Multi-workspace'); ?>">
    <meta name="description" content="<?php echo e(!empty(admin_setting('meta_description')) ? admin_setting('meta_description') : 'Discover the efficiency of Dash, a user-friendly web application by Rajodiya Apps.'); ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="og:title" content="<?php echo e(!empty(admin_setting('meta_title')) ? admin_setting('meta_title') : 'WOrkdo Dash'); ?>">
    <meta property="og:description" content="<?php echo e(!empty(admin_setting('meta_description')) ? admin_setting('meta_description') : 'Discover the efficiency of Dash, a user-friendly web application by Rajodiya Apps.'); ?> ">
    <meta property="og:image" content="<?php echo e(get_file( (!empty(admin_setting('meta_image'))) ? (check_file(admin_setting('meta_image'))) ?  admin_setting('meta_image') : 'uploads/meta/meta_image.png' : 'uploads/meta/meta_image.png'  )); ?><?php echo e('?'.time()); ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="twitter:title" content="<?php echo e(!empty(admin_setting('meta_title')) ? admin_setting('meta_title') : 'WOrkdo Dash'); ?>">
    <meta property="twitter:description" content="<?php echo e(!empty(admin_setting('meta_description')) ? admin_setting('meta_description') : 'Discover the efficiency of Dash, a user-friendly web application by Rajodiya Apps.'); ?> ">
    <meta property="twitter:image" content="<?php echo e(get_file( (!empty(admin_setting('meta_image'))) ? (check_file(admin_setting('meta_image'))) ?  admin_setting('meta_image') : 'uploads/meta/meta_image.png' : 'uploads/meta/meta_image.png'  )); ?><?php echo e('?'.time()); ?>">

    <meta name="author" content="Workdo.io">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="<?php echo e((!empty(admin_setting('favicon')) && check_file(admin_setting('favicon'))) ? get_file(admin_setting('favicon')) : get_file('uploads/logo/favicon.png')); ?><?php echo e('?'.time()); ?>" type="image/x-icon" />
     <!-- CSS Libraries -->
     <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/fontawesome.css')); ?>">

      <!-- font css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/tabler-icons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/feather.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/material.css')); ?>">
    <!-- vendor css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/customizer.css')); ?>">
    <!-- custom css -->
    <link rel="stylesheet" href="<?php echo e(asset('css/custome.css')); ?>">

    <?php if( $rtl == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-rtl.css')); ?>">
    <?php endif; ?>

    <?php if(admin_setting('cust_darklayout') == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-dark.css')); ?>" id="main-style-link">
    <?php endif; ?>

    <?php if( $rtl != 'on' && admin_setting('cust_darklayout') != 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>" id="main-style-link">
    <?php endif; ?>

    <style>
        .navbar-brand .auth-navbar-brand
        {
            max-height: 38px !important;
        }
    </style>
</head>
<body class="<?php echo e(!empty(admin_setting('color'))?admin_setting('color'):'theme-1'); ?>">
    <div class="auth-wrapper auth-v3">
        <div class="bg-auth-side bg-primary"></div>
        <div class="auth-content">
            <nav class="navbar navbar-expand-md navbar-light default">
                <div class="container-fluid">
                    <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                        <img src="<?php echo e(get_file(sidebar_logo())); ?><?php echo e('?'.time()); ?>" alt="<?php echo e(config('app.name', 'WorkDo')); ?>" class="navbar-brand-img auth-navbar-brand">
                    </a>
                    <div class="lang-dropdown-only-mobile ">
                        <?php echo $__env->yieldContent('language-bar'); ?>
                    </div>
                    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo01" style="flex-grow: 0;">
                        <ul class="navbar-nav align-items-center ms-auto mb-2 mb-lg-0">
                            <?php if(module_is_active('LandingPage')): ?>
                                <?php echo $__env->make('landingpage::layouts.buttons', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>
                            <div class="lang-dropdown-only-desk">
                                <?php echo $__env->yieldContent('language-bar'); ?>
                            </div>
                        </ul>
                    </div>
                </div>
            </nav>
            <?php echo $__env->yieldContent('content'); ?>
            <div class="auth-footer">
                <div class="container-fluid">
                    <p class=""><?php if(!empty(admin_setting('footer_text'))): ?> <?php echo e(admin_setting('footer_text')); ?> <?php else: ?><?php echo e(__('Copyright')); ?> &copy; <?php echo e(config('app.name', 'WorkGo')); ?><?php endif; ?><?php echo e(date('Y')); ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php if(admin_setting('enable_cookie') == 'on'): ?>
        <?php echo $__env->make('layouts.cookie_consent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php echo $__env->yieldPushContent('custom-scripts'); ?>
<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/custom.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/bootstrap.min.js')); ?>"></script>
<?php echo $__env->yieldPushContent('script'); ?>
<?php if(admin_setting('cust_darklayout') == 'on'): ?>
<script>
       document.addEventListener('DOMContentLoaded', (event) => {
       const recaptcha = document.querySelector('.g-recaptcha');
       recaptcha.setAttribute("data-theme", "dark");
       });
</script>
<?php endif; ?>
</body>
</html>
<?php /**PATH /opt/lampp/htdocs/Koristu-latest/resources/views/layouts/auth.blade.php ENDPATH**/ ?>