<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Subscription Setting')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Subscription Setting')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/subscription.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-action'); ?>
    <div>
        <div class="button-tab-wrapper">
            <div class="create-packge-tab">
                <label for="plan_package">
                    <h5><?php echo e(__('Create Package')); ?></h5>
                </label>
                <div class="form-check form-switch custom-switch-v1 float-end">
                    <input type="checkbox" name="plan_package" class="form-check-input input-primary pointer" id="plan_package"
                        <?php echo e(admin_setting('plan_package') == 'on' ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="plan_package"></label>
                </div>
            </div>
            <div class="custome-design-tab">
                <label for="custome_package">
                    <h5><?php echo e(__('Custom Design Package')); ?></h5>
                </label>
                <div class="form-check form-switch custom-switch-v1 float-end">
                    <input type="checkbox" name="custome_package" class="form-check-input input-primary pointer"
                        id="custome_package" <?php echo e(admin_setting('custome_package') == 'on' ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="custome_package"></label>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center px-0">
        <?php if(admin_setting('custome_package') == 'on' && admin_setting('plan_package') == 'on'): ?>
            <div class=" col-12">
                <div class="">
                    <div class="card-body package-card-inner  d-flex align-items-center justify-content-center my-3">
                        <div class="tab-main-div">
                            <div class="nav-pills">
                                <a class="nav-link active p-2" href="<?php echo e(route('plan.list')); ?>" role="tab"
                                    aria-controls="pills-home"
                                    aria-selected="true"><?php echo e(__('Pre-Packaged Subscription')); ?></a>
                            </div>
                            <div class="nav-pills">
                                <a class="nav-link  p-2" href="<?php echo e(route('plans.index')); ?>" role="tab"
                                    aria-controls="pills-home" aria-selected="true"><?php echo e(__('Usage Subscription')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if(admin_setting('plan_package') == 'on'): ?>
            <div class="row">
                <div class="col">
                    <div class="float-end">
                        <a href="#" data-size="lg" data-url="<?php echo e(route('plans.create')); ?>" data-ajax-popup="true"
                            data-bs-toggle="tooltip" title="" data-title="Create New Plan"
                            class="btn btn-sm btn-primary" data-bs-original-title="Create">
                            <i class="ti ti-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="plan-package-table">
                    <div id="table-scroll" class="table-scroll">
                        <div class="table-wrap">
                            <!-- basic-plan-card-wrap-scrollbar this class use for scrollbar -->
                            <div
                                class="basic-plan-card-wrap <?php echo e($plan->count() > 3 ? 'basic-plan-card-wrap-scrollbar' : ''); ?> d-flex">
                                <div class="compare-plans">
                                    <div class="compare-plan-title">
                                        <h4><?php echo e(__('Compare our plans')); ?></h4>
                                    </div>
                                    <ul class="compare-plan-opction p-0">
                                        <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $id = strtolower(preg_replace('/\s+/', '_', $module->getName()));
                                                $path = $module->getPath() . '/module.json';
                                                $json = json_decode(file_get_contents($path), true);
                                            ?>
                                            <?php if(!isset($json['display']) || $json['display'] == true): ?>
                                                <li>
                                                    <a target="_new"
                                                        href="<?php echo e(route('software.details', Module_Alias_Name($module->getName()))); ?>"><?php echo e(Module_Alias_Name($module->getName())); ?></a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                <?php $__currentLoopData = $plan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single_plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $plan_modules = !empty($single_plan->modules) ? explode(',', $single_plan->modules) : [];
                                    ?>
                                    <div class="basic-plan-card">
                                        <div class="basic-plan text-center mb-4">
                                            <div class="d-flex justify-content-center">
                                                <h4 class="px-5"><?php echo e(!empty($single_plan->name) ? $single_plan->name : __('Basic')); ?></h4>
                                                <a href="#" class="btn btn-sm btn-primary"
                                                    data-url="<?php echo e(route('plans.edit', $single_plan->id)); ?>"
                                                    data-ajax-popup="true" data-title="Edit Plan" data-toggle="tooltip"
                                                    data-size="lg" title="" data-bs-original-title="Edit">
                                                    <span class=""><i class="ti ti-pencil text-white"></i></span>
                                                </a>
                                            </div>
                                            <div class="price">
                                                <ins class="per_month_price"><?php echo e(currency_format_with_sym($single_plan->package_price_monthly)); ?><span
                                                        class="off-type"><?php echo e(__('/Per Month')); ?></span></ins>
                                                <ins class="per_year_price d-none"><?php echo e(currency_format_with_sym($single_plan->package_price_yearly)); ?><span
                                                        class="off-type"><?php echo e(__('/Per Year')); ?></span></ins>
                                            </div>
                                            <ul class="plan-info">
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="9" height="8"
                                                        viewBox="0 0 9 8" fill="none">
                                                        <path
                                                            d="M8.34762 1.03752C8.18221 0.872095 7.91403 0.872095 7.74858 1.03752L2.67378 6.11237L0.723112 4.1617C0.557699 3.99627 0.289518 3.99629 0.124072 4.1617C-0.0413573 4.32712 -0.0413573 4.5953 0.124072 4.76073L2.37426 7.01088C2.53962 7.1763 2.808 7.17618 2.9733 7.01088L8.34762 1.63656C8.51305 1.47115 8.51303 1.20295 8.34762 1.03752Z"
                                                            fill="#0CAF60" />
                                                    </svg>
                                                    <span><?php echo e(__('Max User :')); ?>

                                                        <b><?php echo e($single_plan->number_of_user == -1 ? 'Unlimited': (!empty($single_plan->number_of_user) ? $single_plan->number_of_user : 'Unlimited')); ?></b></span>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="9" height="8"
                                                        viewBox="0 0 9 8" fill="none">
                                                        <path
                                                            d="M8.34762 1.03752C8.18221 0.872095 7.91403 0.872095 7.74858 1.03752L2.67378 6.11237L0.723112 4.1617C0.557699 3.99627 0.289518 3.99629 0.124072 4.1617C-0.0413573 4.32712 -0.0413573 4.5953 0.124072 4.76073L2.37426 7.01088C2.53962 7.1763 2.808 7.17618 2.9733 7.01088L8.34762 1.63656C8.51305 1.47115 8.51303 1.20295 8.34762 1.03752Z"
                                                            fill="#0CAF60" />
                                                    </svg>
                                                    <span><?php echo e(__('Max Workspace :')); ?>

                                                        <b><?php echo e($single_plan->number_of_workspace == -1 ? 'Unlimited': (!empty($single_plan->number_of_workspace) ? $single_plan->number_of_workspace : 'Unlimited')); ?></b></span>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="9" height="8"
                                                        viewBox="0 0 9 8" fill="none">
                                                        <path
                                                            d="M8.34762 1.03752C8.18221 0.872095 7.91403 0.872095 7.74858 1.03752L2.67378 6.11237L0.723112 4.1617C0.557699 3.99627 0.289518 3.99629 0.124072 4.1617C-0.0413573 4.32712 -0.0413573 4.5953 0.124072 4.76073L2.37426 7.01088C2.53962 7.1763 2.808 7.17618 2.9733 7.01088L8.34762 1.63656C8.51305 1.47115 8.51303 1.20295 8.34762 1.03752Z"
                                                            fill="#0CAF60" />
                                                    </svg>
                                                    <span><?php echo e(__('Free Trail Days :')); ?>

                                                        <b><?php echo e(!empty($single_plan->trial_days) ? $single_plan->trial_days : 0); ?></b></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <ul class="basic-plan-ul compare-plan-opction p-0">
                                            <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $id = strtolower(preg_replace('/\s+/', '_', $module->getName()));
                                                    $path = $module->getPath() . '/module.json';
                                                    $json = json_decode(file_get_contents($path), true);
                                                ?>
                                                <?php if(!isset($json['display']) || $json['display'] == true): ?>
                                                    <?php if(in_array($module->getName(), $plan_modules)): ?>
                                                        <li>
                                                            <a href="#">
                                                                <img src="<?php echo e(asset('images/right.svg')); ?>">
                                                            </a>
                                                        </li>
                                                    <?php else: ?>
                                                        <li>
                                                            <a href="#">
                                                                <img src="<?php echo e(asset('images/wrong.svg')); ?>">
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plans.plan_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Koristu-latest/resources/views/plans/planslist.blade.php ENDPATH**/ ?>