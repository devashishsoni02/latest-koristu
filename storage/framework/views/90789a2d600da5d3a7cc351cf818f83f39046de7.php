<?php echo e(Form::model($team_task, ['route' => ['team_tasks.update', $team_task->id], 'method' => 'PUT'])); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('title', __('Title'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('title', null, ['class' => 'form-control font-style', 'required' => 'required'])); ?>

        </div>

        <div class="form-group col-md-6">
            <?php echo e(Form::label('description', __('Descreption'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('description', null, ['class' => 'form-control font-style'])); ?>

        </div>

        <div class="form-group col-md-12">
            <label class="col-form-label"><?php echo e(__('Assign To')); ?></label>
            <select class="multi-select" multiple="multiple" id="assign_to" name="assign_to[]" required>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option <?php if(in_array($u->id, $team_task->assign_to)): ?> selected <?php endif; ?> value="<?php echo e($u->id); ?>">
                        <?php echo e($u->name); ?> - <?php echo e($u->email); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <p class="text-danger d-none" id="user_validation"><?php echo e(__('Assign To filed is required.')); ?></p>
        </div>

        <div class="form-group col-md-12">
            <label class="col-form-label"><?php echo e(__('Day')); ?></label>
            <select class="multi-select" multiple="multiple" id="days" name="days" required>
                <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php if(in_array($u->id,$team_task->days)): ?> selected <?php endif; ?> value="<?php echo e($u->id); ?>"><?php echo e($u->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <p class="text-danger d-none" id="user_validation"><?php echo e(__('Assign To filed is required.')); ?></p>
        </div>

        <div class="form-group col-md-12">
            <label class="col-form-label"><?php echo e(__('Months')); ?></label>
            <select class="multi-select" multiple="multiple" id="months" name="months" required>
                <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php if(in_array($u->id,$team_task->months)): ?> selected <?php endif; ?> value="<?php echo e($u->id); ?>"><?php echo e($u->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <p class="text-danger d-none" id="user_validation"><?php echo e(__('Assign To filed is required.')); ?></p>
        </div>

        <div class="form-group col-md-12">
            <label class="col-form-label"><?php echo e(__('Date')); ?></label>
            <select class="multi-select" multiple="multiple" id="dates" name="dates" required>
                <?php $__currentLoopData = $dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php if(in_array($u->id,$team_task->dates)): ?> selected <?php endif; ?> value="<?php echo e($u->id); ?>"><?php echo e($u->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <p class="text-danger d-none" id="user_validation"><?php echo e(__('Assign To filed is required.')); ?></p>
        </div>
        
    </div>
</div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /opt/lampp/htdocs/Koristu-latest/resources/views/team_tasks/edit.blade.php ENDPATH**/ ?>