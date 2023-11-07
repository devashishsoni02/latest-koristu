<?php echo e(Form::open(array('route' => 'projects.store','enctype'=>'multipart/form-data'))); ?>

<div class="modal-body">
    <div class="text-end">
        <?php if(module_is_active('AIAssistant')): ?>
            <?php echo $__env->make('aiassistant::ai.generate_ai_btn',['template_module' => 'project','module'=>'Taskly'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('projectname', __('Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('name', '', array('class' => 'form-control','required'=>'required','id'=>"projectname",'placeholder'=> __('Project Name')))); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('projectname', __('Description'),['class'=>'form-label'])); ?>

            <?php echo e(Form::textarea('description', '', array('class' => 'form-control','rows'=>3,'required'=>'required','id'=>"description",'placeholder'=> __('Add Description')))); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('users_list', __('Users'),['class'=>'form-label'])); ?>

            <select class=" multi-select choices" id="users_list" name="users_list[]"  multiple="multiple" data-placeholder="<?php echo e(__('Select Users ...')); ?>">
                <?php $__currentLoopData = $workspace_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->email); ?>"><?php echo e($user->name); ?> - <?php echo e($user->email); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <p class="text-danger d-none" id="user_validation"><?php echo e(__('Users filed is required.')); ?></p>
        </div>
        <?php if(module_is_active('CustomField') && !$customFields->isEmpty()): ?>
            <div class="col-md-12">
                <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                    <?php echo $__env->make('customfield::formBuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary" id="submit">
</div>
<?php echo e(Form::close()); ?>


<script>
    $(function(){
        $("#submit").click(function() {
            var user =  $("#users_list option:selected").length;
            if(user == 0){
            $('#user_validation').removeClass('d-none')
                return false;
            }else{
            $('#user_validation').addClass('d-none')
            }
        });
    });
</script>
<?php /**PATH /opt/lampp/htdocs/Koristu-latest/Modules/Taskly/Resources/views/projects/create.blade.php ENDPATH**/ ?>