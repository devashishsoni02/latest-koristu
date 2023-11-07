<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Subscription Setting')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Subscription Setting')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/subscription.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center px-0">
        <?php if(admin_setting('custome_package') == 'on' && admin_setting('plan_package') == 'on'): ?>
            <div class=" col-12">
                <div class="">
                    <div class="card-body package-card-inner  d-flex align-items-center justify-content-center mb-4">
                        <div class="tab-main-div">
                            <div class="nav-pills">
                                <a class="nav-link active p-2" href="<?php echo e(route('active.plans')); ?>" role="tab"
                                    aria-controls="pills-home"
                                    aria-selected="true"><?php echo e(__('Pre-Packaged Subscription')); ?></a>
                            </div>
                            <div class="nav-pills">
                                <a class="nav-link  p-2" href="<?php echo e(route('plans.index', ['type' => 'subscription'])); ?>"
                                    role="tab" aria-controls="pills-home"
                                    aria-selected="true"><?php echo e(__('Usage Subscription')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if(admin_setting('plan_package') == 'on'): ?>
            <div class="plan-package pb-5 px-3">
                <div class="plan-package-title pb-5">
                    <div class="row align-items-end">
                        <div class="col-md-6">
                            <h3><?php echo e(__('Clear and')); ?> <span><?php echo e(__('simple Pricing')); ?></span></h3>
                            <p><?php echo e(__('Flexible plans for developers, businesses and enterprises alike. We grow as you grow.')); ?>

                            </p>
                        </div>
                        <div class="col-md-6 text-end">
                            <label class="switch ">
                                <span class="lbl time-monthly text-primary"><?php echo e(__('Monthly')); ?></span>
                                <input type="checkbox"
                                    <?php echo e(isset($session) && !empty($session) && $session['time_period'] == 'Year' ? 'checked' : ''); ?>

                                    name="time-period" class="plan-period-switch">
                                <span class="slider round"></span>
                                <span class="lbl time-yearly"><?php echo e(__('Yearly')); ?></span>
                            </label>
                        </div>
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
                                            <h4><?php echo e(!empty($single_plan->name) ? $single_plan->name : __('Basic')); ?></h4>
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
                                            <li class="plan-btn">
                                                <div class="d-flex flex-column gap-2">
                                                    <?php if(\Auth::user()->active_plan == $single_plan->id): ?>
                                                        <?php if(\Auth::user()->plan_expire_date || \Auth::user()->trial_expire_date): ?>
                                                            <?php if(\Auth::user()->plan_expire_date > \Auth::user()->trial_expire_date): ?>
                                                                <span><?php echo e(__('Plan Expired : ')); ?>

                                                                    <?php echo e(!empty(\Auth::user()->plan_expire_date) ? company_date_formate(\Auth::user()->plan_expire_date) : date('Y-m-d')); ?></span>
                                                            <?php else: ?>
                                                                <span> <?php echo e(__('Trial Expires on : ')); ?>

                                                                    <?php echo e(!empty(\Auth::user()->trial_expire_date) ? company_date_formate(\Auth::user()->trial_expire_date) : date('Y-m-d')); ?></span>
                                                                <a href="<?php echo e(route('plan.buy', \Illuminate\Support\Facades\Crypt::encrypt($single_plan->id))); ?>"
                                                                    class="btn btn-primary"><?php echo e(__('Subscription')); ?></a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <a href="<?php echo e(route('plan.buy', \Illuminate\Support\Facades\Crypt::encrypt($single_plan->id))); ?>"
                                                            class="btn btn-primary"><?php echo e(__('Subscription')); ?></a>

                                                        <?php if($single_plan->trial == 1 && $single_plan->is_free_plan != 1 && empty(\Auth::user()->trial_expire_date)): ?>
                                                            <a href="<?php echo e(route('plan.trial', \Illuminate\Support\Facades\Crypt::encrypt($single_plan->id))); ?>"
                                                                class="btn btn-outline-dark"><?php echo e(__('Start Free Trial')); ?></a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>

                                            </li>
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
<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).on("click", ".plan-period-switch", function() {
            if ($('.plan-period-switch').prop('checked') == true) {
                $(".per_year_price").removeClass("d-none");
                $(".per_month_price").addClass("d-none");
            } else {
                $(".per_month_price").removeClass("d-none");
                $(".per_year_price").addClass("d-none");
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Koristu-latest/resources/views/plans/activeplans.blade.php ENDPATH**/ ?>