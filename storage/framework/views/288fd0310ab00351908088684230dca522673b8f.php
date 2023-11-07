<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pos manage')): ?>
    <a href="#pos-sidenav" class="list-group-item list-group-item-action">
       <?php echo e(__('POS Settings')); ?>

       <div class="float-end"><i class="ti ti-chevron-right"></i></div>
    </a>
    <a href="#purchase-print-sidenav" class="list-group-item list-group-item-action">
        <?php echo e(__('Purchase Print Settings')); ?>

        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
     </a>
    <a href="#pos-print-sidenav" class="list-group-item list-group-item-action">
        <?php echo e(__('Pos Print Settings')); ?>

        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
    </a>
<?php endif; ?>


<?php /**PATH /opt/lampp/htdocs/Koristu-latest/Modules/Pos/Resources/views/setting/sidebar.blade.php ENDPATH**/ ?>