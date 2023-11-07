<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Project Detail')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/dropzone.css')); ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo e(asset('Modules/Taskly/Resources/assets/css/custom.css')); ?>" type="text/css" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Project Detail')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-action'); ?>
    <?php echo $__env->yieldPushContent('addButtonHook'); ?>
    <div class="col-md-auto col-sm-4 pb-3">
        <a href="#" class="btn btn-xs btn-primary btn-icon-only col-12 cp_link"
            data-link="<?php echo e(route('project.shared.link', [\Illuminate\Support\Facades\Crypt::encrypt($project->id)])); ?>"
            data-toggle="tooltip" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Copy')); ?>">
            <span class="btn-inner--text text-white">
                <i class="ti ti-copy"></i></span>
        </a>
    </div>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('project setting')): ?>
        <div class="col-sm-auto">
            <a href="#" class="btn btn-xs btn-primary btn-icon-only col-12"
                data-title="<?php echo e(__('Shared Project Settings')); ?>" data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip"
                data-bs-original-title="<?php echo e(__('Shared Project Setting')); ?>"
                data-url="<?php echo e(route('project.setting', [$project->id])); ?>">
                <i class="ti ti-settings"></i>
            </a>
        </div>
    <?php endif; ?>
    <div class="col-sm-auto">
        <a href="<?php echo e(route('projects.gantt', [$project->id])); ?>"
            class="btn btn-xs btn-primary btn-icon-only width-auto "><?php echo e(__('Gantt Chart')); ?></a>
    </div>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('task manage')): ?>
        <div class="col-sm-auto">
            <a href="<?php echo e(route('projects.task.board', [$project->id])); ?>"
                class="btn btn-xs btn-primary btn-icon-only width-auto "><?php echo e(__('Task Board')); ?></a>
        </div>
    <?php endif; ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bug manage')): ?>
        <div class="col-sm-auto">
            <a href="<?php echo e(route('projects.bug.report', [$project->id])); ?>"
                class="btn btn-xs btn-primary btn-icon-only width-auto"><?php echo e(__('Bug Report')); ?></a>
        </div>
    <?php endif; ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('project tracker manage')): ?>
        <?php if(module_is_active('TimeTracker')): ?>
            <div class="col-sm-auto">
                <a href="<?php echo e(route('projecttime.tracker', [$project->id])); ?>"
                    class="btn btn-xs btn-primary btn-icon-only width-auto "><?php echo e(__('Tracker')); ?></a>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(Module::asset('Taskly:Resources/assets/css/dropzone.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="row">
                        <div class="col-xxl-8">
                            <div class="card bg-primary">
                                <div class="card-body">
                                    <div class="d-block d-sm-flex align-items-center justify-content-between">
                                        <h4 class="text-white"> <?php echo e($project->name); ?></h4>
                                        <div class="d-flex  align-items-center">
                                            <div class="px-3">
                                                <span class="text-white text-sm"><?php echo e(__('Start Date')); ?>:</span>
                                                <h5 class="text-white text-nowrap"><?php echo e(company_date_formate($project->start_date)); ?>

                                                </h5>
                                            </div>
                                            <div class="px-3">
                                                <span class="text-white text-sm"><?php echo e(__('Due Date')); ?>:</span>
                                                <h5 class="text-white text-nowrap"><?php echo e(company_date_formate($project->end_date)); ?>

                                                </h5>
                                            </div>
                                            <div class="px-3">
                                                <span class="text-white text-sm"><?php echo e(__('Total Members')); ?>:</span>
                                                <h5 class="text-white text-nowrap">
                                                    <?php echo e((int) $project->users->count() + (int) $project->clients->count()); ?></h5>
                                            </div>
                                            <div class="px-3">
        
                                                <?php if($project->status == 'Finished'): ?>
                                                    <div class="badge  bg-success p-2 px-3 rounded"> <?php echo e(__('Finished')); ?>

                                                    </div>
                                                <?php elseif($project->status == 'Ongoing'): ?>
                                                    <div class="badge  bg-secondary p-2 px-3 rounded"><?php echo e(__('Ongoing')); ?></div>
                                                <?php else: ?>
                                                    <div class="badge bg-warning p-2 px-3 rounded"><?php echo e(__('OnHold')); ?></div>
                                                <?php endif; ?>
        
                                            </div>
                                        </div>
        
                                        <?php if(!$project->is_active): ?>
                                            <button class="btn btn-light d">
                                                <a href="#" class="" title="<?php echo e(__('Locked')); ?>">
                                                    <i class="ti ti-lock"> </i></a>
                                            </button>
                                        <?php else: ?>
                                            <div class="d-flex align-items-center ">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('project edit')): ?>
                                                    <div class="btn btn-light d-flex align-items-between me-3">
                                                        <a href="#" class="" data-size="lg"
                                                            data-url="<?php echo e(route('projects.edit', [$project->id])); ?>" data-=""
                                                            data-ajax-popup="true" data-title="<?php echo e(__('Edit Project')); ?>"
                                                            data-toggle="tooltip" title="<?php echo e(__('Edit')); ?>">
                                                            <i class="ti ti-pencil"> </i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('project delete')): ?>
                                                    <?php echo Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['projects.destroy', $project->id],
                                                        'id' => 'delete-form-' . $project->id,
                                                    ]); ?>

                                                    <button class="btn btn-light d" type="button"><a href="#"
                                                            data-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"
                                                            class="bs-pass-para show_confirm"><i class="ti ti-trash"> </i></a></button>
                                                    <?php echo Form::close(); ?>

                                                <?php endif; ?>
        
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="theme-avtar bg-primary">
                                                    <i class="fas fas fa-calendar-day"></i>
                                                </div>
                                                <div class="col text-end">
                                                    <h6 class="text-muted"><?php echo e(__('Days left')); ?></h6>
                                                    <span class="h6 font-weight-bold mb-0 "><?php echo e($daysleft); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="theme-avtar bg-info">
                                                    <i class="fas fa-money-bill-alt"></i>
                                                </div>
                                                <div class="col text-end">
                                                    <h6 class="text-muted"><?php echo e(__('Budget')); ?></h6>
                                                    <span
                                                        class="h6 font-weight-bold mb-0 "><?php echo e(company_setting('defult_currancy')); ?>

                                                        <?php echo e(number_format($project->budget)); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="theme-avtar bg-danger">
                                                    <i class="fas fa-check-double"></i>
                                                </div>
                                                <div class="col text-end">
                                                    <h6 class="text-muted"><?php echo e(__('Total Task')); ?></h6>
                                                    <span class="h6 font-weight-bold mb-0 "><?php echo e($project->countTask()); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="theme-avtar bg-success">
                                                    <i class="fas fa-comments"></i>
                                                </div>
                                                <div class="col text-end">
                                                    <h6 class="text-muted"><?php echo e(__('Comment')); ?></h6>
                                                    <span
                                                        class="h6 font-weight-bold mb-0 "><?php echo e($project->countTaskComments()); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                            </div>
                        </div>
                        <div class="col-xxl-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card" style="height: 239px">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h5 class="mb-0"><?php echo e(__('Progress')); ?><span class="text-end">
                                                            (<?php echo e(__('Last Week Tasks')); ?>) </span></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body p-2">
                                            <div id="task-chart"></div>
                                        </div>
        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-12">
                    <div class="row">
                        <div class="col-4">
                            <div class="card deta-card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="mb-0"><?php echo e(__('Team Members')); ?> (<?php echo e(count($project->users)); ?>)
                                            </h5>
                                        </div>
                                        <div class="float-end">
                                            <p class="text-muted d-sm-flex align-items-center mb-0">

                                                <a href="#" class="btn btn-sm btn-primary" data-ajax-popup="true"
                                                    data-title="<?php echo e(__('Invite')); ?>" data-bs-toggle="tooltip"
                                                    data-bs-title="<?php echo e(__('Invite')); ?>"
                                                    data-url="<?php echo e(route('projects.invite.popup', [$project->id])); ?>"><i
                                                        class="ti ti-brand-telegram"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body top-10-scroll">
                                    <?php $__currentLoopData = $project->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <ul class="list-group list-group-flush" style="width: 100%;">
                                            <li class="list-group-item px-0">
                                                <div class="row align-items-center justify-content-between">
                                                    <div class="col-sm-auto mb-3 mb-sm-0">
                                                        <div class="d-flex align-items-center px-2">
                                                            <a href="#" class=" text-start">
                                                                <img alt="image" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top" title="<?php echo e($user->name); ?>"
                                                                    <?php if($user->avatar): ?> src="<?php echo e(get_file($user->avatar)); ?>" <?php else: ?> src="<?php echo e(get_file('avatar.png')); ?>" <?php endif; ?>
                                                                    class="rounded-circle " width="40px"
                                                                    height="40px">
                                                            </a>
                                                            <div class="px-2">
                                                                <h5 class="m-0"><?php echo e($user->name); ?></h5>
                                                                <small class="text-muted"><?php echo e($user->email); ?><span
                                                                        class="text-primary "> -
                                                                        <?php echo e((int) count($project->user_done_tasks($user->id))); ?>/<?php echo e((int) count($project->user_tasks($user->id))); ?></span></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-auto text-sm-end d-flex align-items-center">
                                                        <?php if(auth()->guard('web')->check()): ?>
                                                            <?php if($user->id != Auth::id()): ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('team member remove')): ?>
                                                                    <form id="delete-user-<?php echo e($user->id); ?>"
                                                                        action="<?php echo e(route('projects.user.delete', [$project->id, $user->id])); ?>"
                                                                        method="POST" style="display: none;"
                                                                        class="d-inline-flex">
                                                                        <a href="#"
                                                                            class="action-btn btn-danger mx-1  btn btn-sm d-inline-flex align-items-center bs-pass-para show_confirm"
                                                                            data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                                            data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                                            data-confirm-yes="delete-user-<?php echo e($user->id); ?>"
                                                                            data-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i
                                                                                class="ti ti-trash"></i></a>

                                                                        <?php echo csrf_field(); ?>
                                                                        <?php echo method_field('DELETE'); ?>
                                                                    </form>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card deta-card">
                                <div class="card-header ">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="mb-0"><?php echo e(__('Clients')); ?> (<?php echo e(count($project->clients)); ?>)</h5>
                                        </div>
                                        <div class="float-end">
                                            <p class="text-muted d-none d-sm-flex align-items-center mb-0">
                                                <a href="#" class="btn btn-sm btn-primary" data-ajax-popup="true"
                                                    data-title="<?php echo e(__('Share to Client')); ?>" data-toggle="tooltip"
                                                    title="<?php echo e(__('Share to Client')); ?>"
                                                    data-url="<?php echo e(route('projects.share.popup', [$project->id])); ?>"><i
                                                        class="ti ti-share"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body top-10-scroll">
                                    <?php $__currentLoopData = $project->clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <ul class="list-group list-group-flush" style="width: 100%;">
                                            <li class="list-group-item px-0">
                                                <div class="row align-items-center justify-content-between">
                                                    <div class="col-sm-auto mb-3 mb-sm-0">
                                                        <div class="d-flex align-items-center px-2">
                                                            <a href="#" class=" text-start">
                                                                <img alt="image" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top" title="<?php echo e($client->name); ?>"
                                                                    <?php if($client->avatar): ?> src="<?php echo e(get_file($client->avatar)); ?>" <?php else: ?> src="<?php echo e(get_file('avatar.png')); ?>" <?php endif; ?>
                                                                    class="rounded-circle " width="40px"
                                                                    height="40px">
                                                            </a>
                                                            <div class="px-2">
                                                                <h5 class="m-0"><?php echo e($client->name); ?></h5>
                                                                <small class="text-muted"><?php echo e($client->email); ?></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-auto text-sm-end d-flex align-items-center">
                                                        <?php if(\Auth::user()->hasRole('company')): ?>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('team client remove')): ?>
                                                                <form id="delete-client-<?php echo e($client->id); ?>"
                                                                    action="<?php echo e(route('projects.client.delete', [$project->id, $client->id])); ?>"
                                                                    method="POST" style="display: none;"
                                                                    class="d-inline-flex">
                                                                    <a href="#"
                                                                        class="action-btn btn-danger mx-1  btn btn-sm d-inline-flex align-items-center bs-pass-para show_confirm"
                                                                        data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                                        data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                                        data-confirm-yes="delete-client-<?php echo e($client->id); ?>"
                                                                        data-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i
                                                                            class="ti ti-trash"></i></a>
                                                                    <?php echo csrf_field(); ?>
                                                                    <?php echo method_field('DELETE'); ?>

                                                                </form>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                        <?php if(module_is_active('Account',$project->created_by)): ?>
                            <div class="col-4">
                                <div class="card deta-card">
                                    <div class="card-header ">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h5 class="mb-0"><?php echo e(__('Vendors')); ?> (<?php echo e(count($project->venders)); ?>)</h5>
                                            </div>
                                            <div class="float-end">
                                                <p class="text-muted d-none d-sm-flex align-items-center mb-0">
                                                    <a href="#" class="btn btn-sm btn-primary" data-ajax-popup="true"
                                                        data-title="<?php echo e(__('Share to vendor')); ?>" data-toggle="tooltip"
                                                        title="<?php echo e(__('Share to vendor')); ?>"
                                                        data-url="<?php echo e(route('projects.share.vender.popup', [$project->id])); ?>"><i
                                                            class="ti ti-share"></i></a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body top-10-scroll">
                                        <?php $__currentLoopData = $project->venders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <ul class="list-group list-group-flush" style="width: 100%;">
                                                <li class="list-group-item px-0">
                                                    <div class="row align-items-center justify-content-between">
                                                        <div class="col-sm-auto mb-3 mb-sm-0">
                                                            <div class="d-flex align-items-center px-2">
                                                                <a href="#" class=" text-start">
                                                                    <img alt="image" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top" title="<?php echo e($client->name); ?>"
                                                                        <?php if($client->avatar): ?> src="<?php echo e(get_file($client->avatar)); ?>" <?php else: ?> src="<?php echo e(get_file('avatar.png')); ?>" <?php endif; ?>
                                                                        class="rounded-circle " width="40px"
                                                                        height="40px">
                                                                </a>
                                                                <div class="px-2">
                                                                    <h5 class="m-0"><?php echo e($client->name); ?></h5>
                                                                    <small class="text-muted"><?php echo e($client->email); ?></small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-auto text-sm-end d-flex align-items-center">
                                                            <?php if(\Auth::user()->hasRole('company')): ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('team client remove')): ?>
                                                                    <form id="delete-client-<?php echo e($client->id); ?>"
                                                                        action="<?php echo e(route('projects.vendor.delete', [$project->id, $client->id])); ?>"
                                                                        method="POST" style="display: none;"
                                                                        class="d-inline-flex">
                                                                        <a href="#"
                                                                            class="action-btn btn-danger mx-1  btn btn-sm d-inline-flex align-items-center bs-pass-para show_confirm"
                                                                            data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                                            data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                                            data-confirm-yes="delete-client-<?php echo e($client->id); ?>"
                                                                            data-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i
                                                                                class="ti ti-trash"></i></a>
                                                                        <?php echo csrf_field(); ?>
                                                                        <?php echo method_field('DELETE'); ?>

                                                                    </form>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>       
                            <div class="col-4">
                                <div class="card deta-card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h5 class="mb-0"><?php echo e(__('Activity')); ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="timeline timeline-one-side top-10-scroll" data-timeline-content="axis"
                                            data-timeline-axis-style="dashed" style="max-height: 300px;">
                                            <?php $__currentLoopData = $project->activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="timeline-block px-2 pt-3">
                                                    <?php if($activity->log_type == 'Upload File'): ?>
                                                        <span class="timeline-step timeline-step-sm border border-primary text-white">
                                                            <i class="fas fa-file text-dark"></i></span>
                                                    <?php elseif($activity->log_type == 'Create Milestone'): ?>
                                                        <span class="timeline-step timeline-step-sm border border-info text-white"> <i
                                                                class="fas fa-cubes text-dark"></i></span>
                                                    <?php elseif($activity->log_type == 'Create Task'): ?>
                                                        <span class="timeline-step timeline-step-sm border border-success text-white">
                                                            <i class="fas fa-tasks text-dark"></i></span>
                                                    <?php elseif($activity->log_type == 'Create Bug'): ?>
                                                        <span class="timeline-step timeline-step-sm border border-warning text-white">
                                                            <i class="fas fa-bug text-dark"></i></span>
                                                    <?php elseif($activity->log_type == 'Move' || $activity->log_type == 'Move Bug'): ?>
                                                        <span
                                                            class="timeline-step timeline-step-sm border round border-danger text-white">
                                                            <i class="fas fa-align-justify text-dark"></i></span>
                                                    <?php elseif($activity->log_type == 'Create Invoice'): ?>
                                                        <span class="timeline-step timeline-step-sm border border-bg-dark text-white">
                                                            <i class="fas fa-file-invoice text-dark"></i></span>
                                                    <?php elseif($activity->log_type == 'Invite User'): ?>
                                                        <span class="timeline-step timeline-step-sm border border-success"> <i
                                                                class="fas fa-plus text-dark"></i></span>
                                                    <?php elseif($activity->log_type == 'Share with Client'): ?>
                                                        <span class="timeline-step timeline-step-sm border border-info text-white"> <i
                                                                class="fas fa-share text-dark"></i></span>
                                                    <?php elseif($activity->log_type == 'Create Timesheet'): ?>
                                                        <span class="timeline-step timeline-step-sm border border-success text-white">
                                                            <i class="fas fa-clock-o text-dark"></i></span>
                                                    <?php endif; ?>
                                                    <div class="last_notification_text">
                                                        <span class="m-0 h6 text-sm"> <span><?php echo e($activity->log_type); ?> </span> </span>
                                                        <br>
                                                        <span class="text-start text-sm h6"> <?php echo $activity->getRemark(); ?> </span>
                                                        <div class="text-end notification_time_main">
                                                            <p class="text-muted"><?php echo e($activity->created_at->diffForHumans()); ?></p>
                                                        </div>
                                                    </div>
                
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-xxl-8">
                            <div class="card milestone-card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="mb-0"><?php echo e(__('Milestones')); ?> (<?php echo e(count($project->milestones)); ?>)</h5>
                                        </div>
                                        <div class="float-end">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('milestone create')): ?>
                                                <p class="text-muted d-sm-flex align-items-center mb-0">
                                                    <a class="btn btn-sm btn-primary" data-size="lg" data-ajax-popup="true"
                                                        data-title="<?php echo e(__('Create Milestone')); ?>"
                                                        data-url="<?php echo e(route('projects.milestone', [$project->id])); ?>"
                                                        data-toggle="tooltip" title="<?php echo e(__('Create Milestone')); ?>"><i
                                                            class="ti ti-plus"></i></a>
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body top-10-scroll">
        
                                    <div class="table-responsive">
                                        <table id="" class="table table-bordered px-2">
                                            <thead>
                                                <tr>
                                                    <th><?php echo e(__('Name')); ?></th>
                                                    <th><?php echo e(__('Status')); ?></th>
                                                    <th><?php echo e(__('Start Date')); ?></th>
                                                    <th><?php echo e(__('End Date')); ?></th>
                                                    <th><?php echo e(__('Cost')); ?></th>
                                                    <th><?php echo e(__('Progress')); ?></th>
                                                    <th><?php echo e(__('Action')); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $project->milestones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $milestone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td>
                                                            <a href="#" class="d-block font-weight-500 mb-0"
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('milestone delete')): ?> data-ajax-popup="true" data-title="<?php echo e(__('Milestone Details')); ?>"  data-url="<?php echo e(route('projects.milestone.show', [$milestone->id])); ?>" <?php endif; ?>>
                                                                <h5 class="m-0"> <?php echo e($milestone->title); ?> </h5>
                                                            </a>
                                                        </td>
                                                        <td>
        
                                                            <?php if($milestone->status == 'complete'): ?>
                                                                <label
                                                                    class="badge bg-success p-2 px-3 rounded"><?php echo e(__('Complete')); ?></label>
                                                            <?php else: ?>
                                                                <label
                                                                    class="badge bg-warning p-2 px-3 rounded"><?php echo e(__('Incomplete')); ?></label>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?php echo e($milestone->start_date); ?></td>
                                                        <td><?php echo e($milestone->end_date); ?></td>
                                                        <td><?php echo e(company_setting('defult_currancy')); ?><?php echo e($milestone->cost); ?></td>
                                                        <td>
                                                            <div class="progress_wrapper">
                                                                <div class="progress">
                                                                    <div class="progress-bar" role="progressbar"
                                                                        style="width: <?php echo e($milestone->progress); ?>px;"
                                                                        aria-valuenow="55" aria-valuemin="0" aria-valuemax="100">
                                                                    </div>
                                                                </div>
                                                                <div class="progress_labels">
                                                                    <div class="total_progress">
        
                                                                        <strong> <?php echo e($milestone->progress); ?>%</strong>
                                                                    </div>
        
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="col-auto">
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('milestone edit')): ?>
                                                                <div class="action-btn btn-primary ms-2">
                                                                    <a class="action-btn btn-info mx-1  btn btn-sm d-inline-flex align-items-center"
                                                                        data-ajax-popup="true" data-size="lg"
                                                                        data-title="<?php echo e(__('Edit Milestone')); ?>"
                                                                        data-url="<?php echo e(route('projects.milestone.edit', [$milestone->id])); ?>"
                                                                        data-toggle="tooltip" title="<?php echo e(__('Edit')); ?>"><i
                                                                            class="ti ti-pencil text-white"></i></a>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('milestone delete')): ?>
                                                                <form id="delete-form1-<?php echo e($milestone->id); ?>"
                                                                    action="<?php echo e(route('projects.milestone.destroy', [$milestone->id])); ?>"
                                                                    method="POST" style="display: none;" class="d-inline-flex">
                                                                    <a href="#"
                                                                        class="action-btn btn-danger mx-1  btn btn-sm d-inline-flex align-items-center bs-pass-para show_confirm"
                                                                        data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                                        data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                                        data-confirm-yes="delete-form1-<?php echo e($milestone->id); ?>"
                                                                        data-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i
                                                                            class="ti ti-trash"></i></a>
                                                                    <?php echo csrf_field(); ?>
                                                                    <?php echo method_field('DELETE'); ?>
        
                                                                </form>
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
                        <div class="col-xxl-4">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="mb-0"><?php echo e(__('Files')); ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4">
    
                                    <div class="author-box-name form-control-label mb-4">
    
                                    </div>
                                    <div class="col-md-12 dropzone browse-file" id="dropzonewidget">
                                        <div class="dz-message" data-dz-message>
                                            <span><?php echo e(__('Drop files here to upload')); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(module_is_active('Account',$project->created_by)): ?>
                    <div class="col-md-12">
                        <div class="card deta-card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-0"><?php echo e(__('Activity')); ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <div class="timeline timeline-one-side top-10-scroll" data-timeline-content="axis"
                                    data-timeline-axis-style="dashed" style="max-height: 300px;">
                                    <?php $__currentLoopData = $project->activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="timeline-block px-2 pt-3">
                                            <?php if($activity->log_type == 'Upload File'): ?>
                                                <span class="timeline-step timeline-step-sm border border-primary text-white">
                                                    <i class="fas fa-file text-dark"></i></span>
                                            <?php elseif($activity->log_type == 'Create Milestone'): ?>
                                                <span class="timeline-step timeline-step-sm border border-info text-white"> <i
                                                        class="fas fa-cubes text-dark"></i></span>
                                            <?php elseif($activity->log_type == 'Create Task'): ?>
                                                <span class="timeline-step timeline-step-sm border border-success text-white">
                                                    <i class="fas fa-tasks text-dark"></i></span>
                                            <?php elseif($activity->log_type == 'Create Bug'): ?>
                                                <span class="timeline-step timeline-step-sm border border-warning text-white">
                                                    <i class="fas fa-bug text-dark"></i></span>
                                            <?php elseif($activity->log_type == 'Move' || $activity->log_type == 'Move Bug'): ?>
                                                <span
                                                    class="timeline-step timeline-step-sm border round border-danger text-white">
                                                    <i class="fas fa-align-justify text-dark"></i></span>
                                            <?php elseif($activity->log_type == 'Create Invoice'): ?>
                                                <span class="timeline-step timeline-step-sm border border-bg-dark text-white">
                                                    <i class="fas fa-file-invoice text-dark"></i></span>
                                            <?php elseif($activity->log_type == 'Invite User'): ?>
                                                <span class="timeline-step timeline-step-sm border border-success"> <i
                                                        class="fas fa-plus text-dark"></i></span>
                                            <?php elseif($activity->log_type == 'Share with Client'): ?>
                                                <span class="timeline-step timeline-step-sm border border-info text-white"> <i
                                                        class="fas fa-share text-dark"></i></span>
                                            <?php elseif($activity->log_type == 'Create Timesheet'): ?>
                                                <span class="timeline-step timeline-step-sm border border-success text-white">
                                                    <i class="fas fa-clock-o text-dark"></i></span>
                                            <?php endif; ?>
                                            <div class=" row last_notification_text">
                                                <span class="col-1 m-0 h6 text-sm"> <span><?php echo e($activity->log_type); ?> </span> </span>
                                                <br>
                                                <span class="col text-start text-sm h6"> <?php echo $activity->getRemark(); ?> </span>
                                                <div class="col-auto text-end notification_time_main">
                                                    <p class="text-muted"><?php echo e($activity->created_at->diffForHumans()); ?></p>
                                                </div>
                                            </div>
        
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/apexcharts.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/letter.avatar.js')); ?>"></script>
    <script src="<?php echo e(Module::asset('Taskly:Resources/assets/js/dropzone.min.js')); ?>"></script>
    <script>
        Dropzone.autoDiscover = false;
        myDropzone = new Dropzone("#dropzonewidget", {
            maxFiles: 20,
            maxFilesize: 20,
            parallelUploads: 1,
            acceptedFiles: ".jpeg,.jpg,.png,.pdf,.doc,.txt",
            url: "<?php echo e(route('projects.file.upload', [$project->id])); ?>",
            success: function(file, response) {
                if (response.is_success) {
                    dropzoneBtn(file, response);
                    toastrs('<?php echo e(__('Success')); ?>', 'File Successfully Uploaded', 'success');
                } else {
                    myDropzone.removeFile(response.error);
                    toastrs('Error', response.error, 'error');
                }
            },
            error: function(file, response) {
                myDropzone.removeFile(file);
                if (response.error) {
                    toastrs('Error', response.error, 'error');
                } else {
                    toastrs('Error', response, 'error');
                }
            }
        });
        myDropzone.on("sending", function(file, xhr, formData) {
            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
            formData.append("project_id", <?php echo e($project->id); ?>);
        });

        <?php if(isset($permisions) && in_array('show uploading', $permisions)): ?>
            $(".dz-hidden-input").prop("disabled", true);
            myDropzone.removeEventListeners();
        <?php endif; ?>

        function dropzoneBtn(file, response) {

            var html = document.createElement('div');
            var download = document.createElement('a');
            download.setAttribute('href', response.download);
            download.setAttribute('class', "action-btn btn-primary mx-1  btn btn-sm d-inline-flex align-items-center");
            download.setAttribute('data-toggle', "tooltip");
            download.setAttribute('download', file.name);
            download.setAttribute('title', "<?php echo e(__('Download')); ?>");
            download.innerHTML = "<i class='ti ti-download'> </i>";
            html.appendChild(download);

            <?php if(isset($permisions) && in_array('show uploading', $permisions)): ?>
            <?php else: ?>
                var del = document.createElement('a');
                del.setAttribute('href', response.delete);
                del.setAttribute('class', "action-btn btn-danger mx-1  btn btn-sm d-inline-flex align-items-center");
                del.setAttribute('data-toggle', "popover");
                del.setAttribute('title', "<?php echo e(__('Delete')); ?>");
                del.innerHTML = "<i class='ti ti-trash '></i>";

                del.addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (confirm("Are you sure ?")) {
                        var btn = $(this);
                        $.ajax({
                            url: btn.attr('href'),
                            type: 'DELETE',
                            success: function(response) {
                                if (response.is_success) {
                                    btn.closest('.dz-image-preview').remove();
                                    toastrs('<?php echo e(__('Success')); ?>', 'File Successfully Deleted',
                                        'success');
                                } else {
                                    toastrs('<?php echo e(__('Error')); ?>', 'Something Wents Wrong.', 'error');
                                }
                            },
                            error: function(response) {
                                response = response.responseJSON;
                                if (response.is_success) {
                                    toastrs('<?php echo e(__('Error')); ?>', 'Something Wents Wrong.', 'error');
                                } else {
                                    toastrs('<?php echo e(__('Error')); ?>', 'Something Wents Wrong.', 'error');
                                }
                            }
                        })
                    }
                });

                html.appendChild(del);
            <?php endif; ?>

            file.previewTemplate.appendChild(html);
        }

        <?php ($files = $project->files); ?>
        <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php ($storage_file = get_base_file($file->file_path)); ?>
            // Create the mock file:
            var mockFile = {
                name: "<?php echo e($file->file_name); ?>",
                size: "<?php echo e(get_size(get_file($file->file_path))); ?>"
            };
            // Call the default addedfile event handler
            myDropzone.emit("addedfile", mockFile);
            // And optionally show the thumbnail of the file:
            myDropzone.emit("thumbnail", mockFile, "<?php echo e(get_file($file->file_path)); ?>");
            myDropzone.emit("complete", mockFile);

            dropzoneBtn(mockFile, {
                download: "<?php echo e(get_file($file->file_path)); ?>",
                delete: "<?php echo e(route('projects.file.delete', [$project->id, $file->id])); ?>"
            });
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>
    <script>
        (function() {
            var options = {
                chart: {
                    height: 135,
                    type: 'line',
                    toolbar: {
                        show: false,
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                series: [
                    <?php $__currentLoopData = $chartData['stages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        {
                            name: "<?php echo e(__($name)); ?>",
                            // data:
                            data: <?php echo json_encode($chartData[$id]); ?>,
                        },
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ],
                xaxis: {
                    categories: <?php echo json_encode($chartData['label']); ?>,
                },
                colors: <?php echo json_encode($chartData['color']); ?>,

                grid: {
                    strokeDashArray: 4,
                },
                legend: {
                    show: false,
                },

                yaxis: {
                    tickAmount: 5,
                    min: 1,
                    max: 40,
                },
            };
            var chart = new ApexCharts(document.querySelector("#task-chart"), options);
            chart.render();
        })();

        $('.cp_link').on('click', function() {
            var value = $(this).attr('data-link');
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(value).select();
            document.execCommand("copy");
            $temp.remove();
            toastrs('success', '<?php echo e(__('Link Copy on Clipboard')); ?>', 'success')
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Koristu-latest/Modules/Taskly/Resources/views/projects/show.blade.php ENDPATH**/ ?>