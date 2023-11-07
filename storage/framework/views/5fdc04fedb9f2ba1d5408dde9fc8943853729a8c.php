<form class="" method="post" action="<?php echo e(route('projects.share',[$project->id])); ?>">
    <?php echo csrf_field(); ?>
    <div class="modal-body">
        <div class="form-group col-md-12 mb-0">
            <label for="users_list" class="col-form-label"><?php echo e(__('Clients')); ?></label>
            <select class="multi-select choices" id="clients" data-toggle="select2" required name="clients[]" multiple="multiple" data-placeholder="<?php echo e(__('Select Clients ...')); ?>">
                <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($client->id); ?>"><?php echo e($client->name); ?> - <?php echo e($client->email); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <p class="text-danger d-none" id="clients_validation"><?php echo e(__('Clients filed is required.')); ?></p>
        </div>
    </div>
    <div class="modal-footer">
           <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
             <input type="submit" value="<?php echo e(__('Share to Client')); ?>" id="submit" class="btn  btn-primary">
        </div>
</form>

<script>
    $(function(){
        $("#submit").click(function() {
            var client =  $("#clients option:selected").length;
            if(client == 0){
            $('#clients_validation').removeClass('d-none')
                return false;
            }else{
            $('#clients_validation').addClass('d-none')
            }
        });
    });
</script>
<?php /**PATH /opt/lampp/htdocs/Koristu-latest/Modules/Taskly/Resources/views/projects/share.blade.php ENDPATH**/ ?>