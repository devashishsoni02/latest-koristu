<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('stripe manage')): ?>
    <a href="#stripe-sidenav" class="list-group-item list-group-item-action">
       <?php echo e(__('Stripe')); ?>

       <div class="float-end"><i class="ti ti-chevron-right"></i></div>
    </a>
<?php endif; ?>
<?php /**PATH /opt/lampp/htdocs/Koristu-latest/Modules/Stripe/Resources/views/setting/sidebar.blade.php ENDPATH**/ ?>