<?php $__env->startSection('template_title'); ?>
     <?php echo e(__('Add On Install Editor')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
   <?php echo e(__('Add On Install Editor')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('container'); ?>
<div style="text-align: center;" class="inner-div">
	 <img src="<?php echo e(get_module_img($module_detail->getName())); ?>" alt="<?php echo e($module_detail->getName()); ?>" class="img-user" style="    width: 60px;height: 60px;border-radius: 7px;">
    <h5 class="text-capitalize" style="margin: auto; text-transform:capitalize;"> <?php echo e(Module_Alias_Name($module_detail->getName())); ?></h5>
</div>

<div class="buttons-container">
    <a class="button float-right" id="active_module"  href="<?php echo e(route('LaravelInstaller::default_module_active')); ?>">
        <?php echo e(__('Continue')); ?>

        <i class="fa fa-angle-double-right fa-fw" aria-hidden="true"></i>
    </a>
</div>
<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
<script type="text/javascript">
	$('body').on('click','#active_module',function(){

   		$("#active_module").empty();
        var html = '<?php echo e(__("Processing")); ?>';
        $("#active_module").append(html);
        $('#active_module').css('pointer-events', 'none');

	})
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('vendor.installer.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devashish/Public/Kaiten Software/Laravel/codecanyon-xgITI8ZQ-workdo-dash-saas-open-source-erp-with-multiworkspace/Dashboard/resources/views/vendor/installer/module-process.blade.php ENDPATH**/ ?>