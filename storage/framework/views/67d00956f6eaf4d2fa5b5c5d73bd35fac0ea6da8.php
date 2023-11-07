<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Verify Email')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('language-bar'); ?>
    <li class="dropdown dash-h-item drp-language nav-item">
        <a class="dash-head-link dropdown-toggle btn btn-primary text-white" data-bs-toggle="dropdown" href="#">
            <span class="drp-text hide-mob text-white"><?php echo e(Str::upper($lang)); ?></span>
        </a>
        <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
            <?php $__currentLoopData = languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('verification.notice',$key)); ?>" class="dropdown-item <?php if($lang == $key): ?> text-primary  <?php endif; ?>">
                    <span><?php echo e(Str::ucfirst($language)); ?></span>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="row align-items-center text-start">
        <div class="col-xl-6">
            <div class="card-body">
                <div class="">
                    <h2 class="mb-3 f-w-600"><?php echo e(__('Verify Email')); ?></h2>
                    <h6><?php echo e(__('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.')); ?></h6>
                </div>
                <?php if(session('status') == 'verification-link-sent'): ?>
                    <div class="mb-4 font-medium text-sm text-success">
                        <?php echo e(__('A new verification link has been sent to the email address you provided during registration.')); ?>

                    </div>
                <?php elseif(session('status') == 'verification-link-not-sent'): ?>
                    <div class="mb-4 font-medium text-sm text-danger">
                        <?php echo e(__("Oops! We encountered an issue while attempting to send the email. It seems there's a problem with the mail server's SMTP (Simple Mail Transfer Protocol). Please review the SMTP settings and configuration to resolve the problem.")); ?>

                    </div>
                <?php endif; ?>
                <form method="POST" action="<?php echo e(route('verification.send')); ?>">
                    <?php echo csrf_field(); ?>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-block mt-2" tabindex="4"><?php echo e(__('Resend Verification Email')); ?></button>
                        </div>
                </form>
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-danger btn-block mt-2">
                            <?php echo e(__('LogOut')); ?>

                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-xl-6 img-card-side">
            <div class="auth-img-content">
                <img src="<?php echo e(asset('assets/images/auth/img-auth-3.svg')); ?>" alt="" class="img-fluid">
                <h3 class="text-white mb-4 mt-5"> <?php echo e(__('“Attention is the new currency”')); ?></h3>
                <p class="text-white"> <?php echo e(__('The more effortless the writing looks, the more effort the writer
                    actually put into the process.')); ?></p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-scripts'); ?>

<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Koristu-latest/resources/views/auth/verify-email.blade.php ENDPATH**/ ?>