<?php
    if(Auth::user()->type=='super admin')
    {
        $name = __('Customer');
    }
    else{

        $name =__('User');
    }
?>
    <?php echo e(Form::model($user,array('route' => array('users.update', $user->id), 'method' => 'PUT'))); ?>

    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo e(Form::label('name',__('Name'),['class'=>'form-label'])); ?>

                    <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter '.($name).' Name'),'required'=>'required'))); ?>

                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="invalid-name" role="alert">
                        <strong class="text-danger"><?php echo e($message); ?></strong>
                    </small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo e(Form::label('email',__('Email'),['class'=>'form-label'])); ?>

                    <?php echo e(Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter '.($name).' Email'),'required'=>'required'))); ?>

                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="invalid-email" role="alert">
                        <strong class="text-danger"><?php echo e($message); ?></strong>
                    </small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <?php if(Auth::user()->type != 'super admin'): ?>
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo e(Form::label('roles', __('Roles'),['class'=>'form-label'])); ?>

                        <?php echo e(Form::select('roles',$roles, null, ['class' => 'form-control', 'id' => 'user_id', 'data-toggle' => 'select'])); ?>

                    </div>
                </div>

            <?php echo $__env->yieldPushContent('add_users_mobile_no_filed'); ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
        <?php echo e(Form::submit(__('Update'),array('class'=>'btn  btn-primary'))); ?>

    </div>
    <?php echo e(Form::close()); ?>

<?php /**PATH /opt/lampp/htdocs/Koristu-latest/resources/views/users/edit.blade.php ENDPATH**/ ?>