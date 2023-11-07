<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('unit manage')): ?>
    <a href="#unit-settings" class="list-group-item list-group-item-action dash-link "><?php echo e(__('Unit')); ?> <div
            class="float-end"><i class="ti ti-chevron-right"></i></div></a>
<?php endif; ?>
<?php /**PATH /opt/lampp/htdocs/Koristu-latest/Modules/ProductService/Resources/views/units/sidenav.blade.php ENDPATH**/ ?>