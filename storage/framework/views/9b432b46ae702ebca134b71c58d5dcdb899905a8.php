<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('hrm manage')): ?>
    <a href="#hrm-sidenav" class="list-group-item list-group-item-action">
        <?php echo e(__('HRM Settings')); ?>

        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
    </a>
<?php endif; ?>
<?php if(module_is_active('Recruitment')): ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('letter offer manage')): ?>
        <a href="#offer-letter-settings" class="list-group-item list-group-item-action">
            <?php echo e(__('Offer Letter Settings')); ?>

            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
        </a>
    <?php endif; ?>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('letter joining manage')): ?>
    <a href="#joining-letter-settings" class="list-group-item list-group-item-action">
        <?php echo e(__('Joining Letter Settings')); ?>

        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
    </a>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('letter certificate manage')): ?>
    <a href="#experience-certificate-settings" class="list-group-item list-group-item-action">
        <?php echo e(__('Certificate of Experience Settings')); ?>

        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
    </a>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('letter noc manage')): ?>
    <a href="#noc-settings" class="list-group-item list-group-item-action">
        <?php echo e(__('No Objection Certificate Settings')); ?>

        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
    </a>
<?php endif; ?>

<?php /**PATH /opt/lampp/htdocs/Koristu-latest/Modules/Hrm/Resources/views/setting/sidebar.blade.php ENDPATH**/ ?>