<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Add-on Manager')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
<?php echo e(__('Add-on Manager')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-action'); ?>
<div>
    <a href="<?php echo e(route('module.add')); ?>" class="btn btn-sm btn-primary"  data-bs-toggle="tooltip" title="" data-bs-original-title="<?php echo e(__('ModuleSetup')); ?>">
          <i class="ti ti-plus"></i>
    </a>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row justify-content-center px-0">
    <div class=" col-12">
        <div class="card">
            <div class="card-body package-card-inner  d-flex align-items-center">
                <div class="package-itm theme-avtar">
                    <a href="https://workdo.io/product-category/dash-saas-addon/?utm_source=dash-main-file&utm_medium=superadmin&utm_campaign=plan-btn-all" target="new">
                        <img src="https://workdo.io/wp-content/uploads/2023/03/favicon.jpg" alt="">
                    </a>
                </div>
                <div class="package-content flex-grow-1  px-3">
                    <h4><?php echo e(__('Buy More Add-on')); ?></h4>
                    <div class="text-muted"><?php echo e(__('+'.count($modules).' Premium Add-on')); ?></div>
                </div>
                <div class="price text-end">
                  <a class="btn btn-primary" href="https://workdo.io/product-category/dash-saas-addon/?utm_source=dash-main-file&utm_medium=superadmin&utm_campaign=plan-btn-all" target="new">
                    <?php echo e(__('Buy More Add-on')); ?>

                  </a>
                </div>
            </div>
        </div>
    </div>
    <!-- [ sample-page ] start -->
    <div class="event-cards row px-0">
        <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $id = strtolower(preg_replace('/\s+/', '_', $module->getName()));
                $path =$module->getPath().'/module.json';
                $json = json_decode(file_get_contents($path), true);
            ?>
            <?php if(!isset($json['display']) || $json['display'] == true): ?>
            <div class="col-lg-2 col-md-4 col-sm-6 product-card ">
                <div class="card <?php echo e(($module->isEnabled()) ? 'enable_module' : 'disable_module'); ?>">
                    <div class="product-img">
                        <div class="theme-avtar">
                            <img src="<?php echo e(get_module_img($module->getName())); ?>"
                                alt="<?php echo e($module->getName()); ?>" class="img-user"
                                style="max-width: 100%">
                            </div>
                            <small class="text-muted">
                                <?php if($module->isEnabled()): ?>
                                <span class="badge bg-success"><?php echo e(__('Enable')); ?></span>
                                <?php else: ?>
                                <span class="badge bg-danger"><?php echo e(__('Disable')); ?></span>
                                <?php endif; ?>
                            </small>
                        <div class="checkbox-custom">
                            <div class="btn-group card-option">
                                <button type="button" class="btn" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" style="">
                                    <?php if($module->isEnabled()): ?>
                                    <a href="#!" class="dropdown-item module_change" data-id="<?php echo e($id); ?>">
                                        <span><?php echo e(__('Disable')); ?></span>
                                    </a>
                                    <?php else: ?>
                                    <a href="#!" class="dropdown-item module_change" data-id="<?php echo e($id); ?>">
                                        <span><?php echo e(__('Enable')); ?></span>
                                    </a>
                                    <?php endif; ?>
                                    <form action="<?php echo e(route('module.enable')); ?>" method="POST" id="form_<?php echo e($id); ?>">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="name" value="<?php echo e($module->getName()); ?>">
                                    </form>
                                    <form action="<?php echo e(route('module.remove', $module->getName())); ?>" method="POST" id="form_<?php echo e($id); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button type="button" class="dropdown-item show_confirm" data-confirm="<?php echo e(__('Are You Sure?')); ?>" data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"  data-confirm-yes="delete-form-<?php echo e($id); ?>">
                                            <span class="text-danger"><?php echo e(__("Remove")); ?></span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-content">
                        <h4 class="text-capitalize"> <?php echo e(Module_Alias_Name($module->getName())); ?></h4>
                        <p class="text-muted text-sm mb-0">
                            <?php echo e(isset($json['description']) ? $json['description'] : ''); ?>

                        </p>
                        <a href="<?php echo e(route('software.details',Module_Alias_Name($module->getName()))); ?>" target="_new" class="btn  btn-outline-secondary w-100 mt-2"><?php echo e(__('View Details')); ?></a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <!-- [ sample-page ] end -->

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
$(document).on('click','.module_change',function(){
    var id = $(this).attr('data-id');
    $('#form_'+id).submit();
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Koristu-latest/resources/views/module/index.blade.php ENDPATH**/ ?>