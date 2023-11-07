<form class="" method="post" action="<?php echo e(route('projects.share.vender',[$project->id])); ?>">
    <?php echo csrf_field(); ?>
    <div class="modal-body">
        <div class="form-group col-md-12 mb-0">
            <label for="users_list" class="col-form-label"><?php echo e(__('vendors')); ?></label>
            <select class="multi-select choices" id="venders" data-toggle="select2" required name="vendors[]" multiple="multiple" data-placeholder="<?php echo e(__('Select vendors ...')); ?>">
                <?php $__currentLoopData = $venders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($client->id); ?>"><?php echo e($client->name); ?> - <?php echo e($client->email); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <p class="text-danger d-none" id="venders_validation"><?php echo e(__('vendors filed is required.')); ?></p>
        </div>
    </div>
    <div class="modal-footer">
           <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
             <input type="submit" value="<?php echo e(__('Share to Vendor')); ?>" id="submit" class="btn  btn-primary">
        </div>
</form>

<script>
    $(function(){
        $("#submit").click(function() {
            var client =  $("#venders option:selected").length;
            if(client == 0){
            $('#venders_validation').removeClass('d-none')
                return false;
            }else{
            $('#venders_validation').addClass('d-none')
            }
        });
    });
</script>
<?php /**PATH /opt/lampp/htdocs/Koristu-latest/Modules/Taskly/Resources/views/projects/share_vender.blade.php ENDPATH**/ ?>