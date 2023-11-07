<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('account manage')): ?>
    <a href="#account-sidenav" class="list-group-item list-group-item-action">
       <?php echo e(__('Account Settings')); ?>

       <div class="float-end"><i class="ti ti-chevron-right"></i></div>
    </a>
    <a href="#bill-print-sidenav" class="list-group-item list-group-item-action">
        <?php echo e(__('Bill Print Settings')); ?>

        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
     </a>
<?php endif; ?>


<?php /**PATH /opt/lampp/htdocs/Koristu-latest/Modules/Account/Resources/views/setting/sidebar.blade.php ENDPATH**/ ?>