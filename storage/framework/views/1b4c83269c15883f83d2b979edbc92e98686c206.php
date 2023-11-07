<?php
    if(Auth::user()->type=='super admin')
    {
        $titles =  __('Companies Log History') ;
    }
    else{

        $titles =  __('User Log History') ;
    }
?>

<?php $__env->startSection('page-title'); ?>
   <?php echo e($titles); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
   <?php echo e($titles); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('User Log History')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="mt-2 ">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::open(array('route' => array('users.userlog.history'),'method'=>'get','id'=>'user_userlog'))); ?>

                        <div class="row align-items-center justify-content-end">
                            <div class="col-xl-10">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('month',__('Month'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::month('month',isset($_GET['month'])?$_GET['month']:date('Y-m'),array('class'=>'month-btn form-control'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('users', __('User'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::select('users', $filteruser,isset($_GET['users'])?$_GET['users']:'', array('class' => 'form-control select'))); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto mt-4">
                                <div class="row">
                                    <div class="col-auto">
                                        <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('user_userlog').submit(); return false;" data-bs-toggle="tooltip" title="<?php echo e(__('Apply')); ?>" data-original-title="<?php echo e(__('apply')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                        </a>
                                        <a href="<?php echo e(route('users.userlog.history')); ?>" class="btn btn-sm btn-danger " data-bs-toggle="tooltip"  title="<?php echo e(__('Reset')); ?>" data-original-title="<?php echo e(__('Reset')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-trash-off text-white-off "></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0 pc-dt-simple" id="users_log">
                            <thead>
                                <tr>
                                    <?php if(Auth::user()->type == 'super admin' || Auth::user()->type == 'company'): ?>
                                        <th><?php echo e(__('User Name')); ?></th>
                                        <th><?php echo e(__('Role')); ?></th>
                                    <?php endif; ?>
                                    <th><?php echo e(__('Last Login')); ?></th>
                                    <th><?php echo e(__('Ip')); ?></th>
                                    <th><?php echo e(__('Country')); ?></th>
                                    <th><?php echo e(__('Device')); ?></th>
                                    <th><?php echo e(__('OS')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $userdetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $userdetail = json_decode($user->details);
                                    ?>
                                    <tr>
                                        <?php if(Auth::user()->type == 'super admin' || Auth::user()->type == 'company'): ?>
                                            <td><?php echo e($user->user_name); ?></td>
                                            <td>
                                                <span class="me-5 badge p-2 px-3 rounded bg-primary status_badge"><?php echo e($user->user_type); ?></span>
                                            </td>
                                        <?php endif; ?>
                                        <td><?php echo e(!empty($user->date) ? company_datetime_formate($user->date) : '-'); ?></td>
                                        <td><?php echo e($user->ip); ?></td>
                                        <td><?php echo e(!empty($userdetail->country)?$userdetail->country:'-'); ?></td>
                                        <td><?php echo e($userdetail->device_type); ?></td>
                                        <td><?php echo e($userdetail->os_name); ?></td>
                                        <td>
                                            <div class="action-btn bg-warning ms-2">
                                                <a href="#" class="mx-3 btn btn-sm align-items-center" data-size="lg" data-url="<?php echo e(route('users.userlog.view', [$user->id])); ?>"
                                                data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip" title="" data-title="<?php echo e(__('View User Logs')); ?>" data-bs-original-title="<?php echo e(__('View')); ?>">
                                                    <i class="ti ti-eye text-white"></i>
                                                </a>
                                            </div>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user delete')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo e(Form::open(['route' => ['users.userlog.destroy', $user->id], 'class' => 'm-0'])); ?>

                                                    <?php echo method_field('DELETE'); ?>
                                                    <a href="#"
                                                        class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm"
                                                        data-bs-toggle="tooltip" title=""
                                                        data-bs-original-title="Delete" aria-label="Delete"
                                                        data-confirm-yes="delete-form-<?php echo e($user->id); ?>"><i
                                                            class="ti ti-trash text-white text-white"></i></a>
                                                    <?php echo e(Form::close()); ?>

                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Koristu-latest/resources/views/users/userlog.blade.php ENDPATH**/ ?>