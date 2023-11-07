<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Team_task Details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <?php echo e(__('Team_task Details')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table  mb-0 pc-dt-simple" id="user-coupon">
                            <thead>
                            <tr>
                                <th> <?php echo e(__('Name')); ?></th>
                                <th> <?php echo e(__('Descreption')); ?></th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $team_tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team_task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               
                                <tr class="font-style">
                                    
                                <td><?php echo e($team_task->name); ?></td>
                                    <td><?php echo e($team_task->desc); ?></td>
                                   
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Koristu-latest/resources/views/team_tasks/view.blade.php ENDPATH**/ ?>