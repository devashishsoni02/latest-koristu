<form class="" method="post" action="<?php echo e(route('projects.invite.update',[$project->id])); ?>">
    <?php echo csrf_field(); ?>
    <div class="modal-body">
        <div class="form-group col-md-12 ">
            <label for="users_list" class="form-label"><?php echo e(__('Users')); ?></label>
            <select class=" multi-select choices" required id="users_list" name="users_list[]"  multiple="multiple" data-placeholder="<?php echo e(__('Select Users ...')); ?>">
                <?php $__currentLoopData = $workspace_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->email); ?>"><?php echo e($user->name); ?> - <?php echo e($user->email); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <p class="text-danger d-none" id="user_validation"><?php echo e(__('Users filed is required.')); ?></p>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
        <input type="submit" value="<?php echo e(__('Invite')); ?>" id="submit" class="btn  btn-primary">
    </div>
</form>

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
<?php /**PATH /opt/lampp/htdocs/Koristu-latest/Modules/Taskly/Resources/views/projects/invite.blade.php ENDPATH**/ ?>