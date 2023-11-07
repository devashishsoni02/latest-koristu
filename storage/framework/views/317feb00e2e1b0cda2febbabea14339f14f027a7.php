<?php $__env->startPush('scripts'); ?>
   
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Team_tasks')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
        <?php echo e(__('Team_task')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-action'); ?>


    <div>
   
    
    <a href="#" data-size="md" data-url="<?php echo e(route('team_tasks.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create New Team_task')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
    </a>
       
    </div>
    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
            <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0 pc-dt-simple" id="team_task">
                            <thead>
                            <tr>
      						<th> <?php echo e(__('Title')); ?></th>
      						<th> <?php echo e(__('Priorty')); ?></th>
                            
                            <th> <?php echo e(__('Date')); ?></th>
                            <th> <?php echo e(__('Assign To')); ?></th>

                            </tr>
                            
                            </thead>
                            <tbody> <?php $__currentLoopData = $team_tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team_task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <tr class="font-style">
                            <td><?php echo e($team_task->title); ?></td>
                            <td><?php echo e($team_task->priority); ?></td>
                            <td><?php echo e($team_task->dates); ?></td>
                            <td><?php echo e($team_task->assign_to); ?></td>
                            
                            <td class="Action">
                                        <span>
                                        <div class="action-btn bg-info ms-2">
                                        <a href="<?php echo e(route('team_tasks.show',$team_task->id)); ?>" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('View')); ?>">
                                            <i class="ti ti-eye text-white"></i>
                                        </a>
                                        </div>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('coupon edit')): ?>
                                        <div class="action-btn bg-primary ms-2">
                                                <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="<?php echo e(route('team_tasks.edit',$team_task->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Team_task')); ?>" data-bs-toggle="tooltip"  title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>">
                                                <i class="ti ti-pencil text-white"></i>
                                            </a>
                                        </div>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('coupon delete')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo e(Form::open(['route' => ['team_tasks.destroy', $team_task->id], 'class' => 'm-0'])); ?>

                                                    <?php echo method_field('DELETE'); ?>
                                                    <a href="#"
                                                        class="mx-3 btn btn-sm  align-items-center  show_confirm"
                                                        data-bs-toggle="tooltip" title=""
                                                        data-bs-original-title="Delete" aria-label="Delete"
                                                        data-confirm-yes="delete-form-<?php echo e($team_task->id); ?>"><i
                                                            class="ti ti-trash text-white text-white"></i></a>
                                                    <?php echo e(Form::close()); ?>

                                                </div>
                                            <?php endif; ?>
                                        </span>
                                    </td>
    </td>
    
  </tr> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </tbody>
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Koristu-latest/resources/views/team_tasks/index.blade.php ENDPATH**/ ?>