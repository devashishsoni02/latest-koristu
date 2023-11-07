<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Email Templates')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection("page-breadcrumb"); ?>
    <?php echo e(__('Email Templates')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-action'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card table-card">
            <div class="card-header card-body table-border-style">
                <h5></h5>
                <div class="">
                    <table class="table mb-0 pc-dt-simple" id="d">
                        <thead>
                            <tr>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Module')); ?></th>
                                <th class="text-end"><?php echo e(__('Action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $__currentLoopData = $email_templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $email_template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($email_template->name); ?></td>
                                <td class="text-capitalize"><?php echo e(Module_Alias_Name($email_template->module_name)); ?></td>
                                <td class="text-end">
                                    <div class="action-btn bg-warning ms-2">
                                        <a href="<?php echo e(route('manage.email.language',[$email_template->id,getActiveLanguage()])); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('View')); ?>">
                                            <i class="ti ti-eye text-white"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- [ basic-table ] end -->
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Koristu-latest/resources/views/email_templates/index.blade.php ENDPATH**/ ?>