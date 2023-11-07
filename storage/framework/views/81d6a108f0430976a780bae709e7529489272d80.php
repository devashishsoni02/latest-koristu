
<?php if($currentWorkspace && $task): ?>
<div class="modal-body">
    <div class="p-2">
        <div class="form-control-label"><?php echo e(__('Description')); ?>:</div>

        <p class="text-muted mb-4">
            <?php echo e($task->description); ?>

        </p>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="form-control-label"><?php echo e(__('Create Date')); ?></div>
                <p class="mt-1"><?php echo e(company_date_formate($task->created_at)); ?></p>
            </div>
            <div class="col-md-3">
                <div class="form-control-label"><?php echo e(__('Due Date')); ?></div>
                <p class="mt-1"><?php echo e(company_date_formate($task->due_date)); ?></p>
            </div>
            <div class="col-md-3">
                <div class="form-control-label"><?php echo e(__('Assigned')); ?></div>
                <?php if($users = $task->users()): ?>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img alt="image" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e($user->name); ?>" <?php if($user->avatar): ?> src="<?php echo e(get_file($user->avatar)); ?>" <?php else: ?> src="<?php echo e(get_file('avatar.png')); ?>"  <?php endif; ?> class="rounded-circle " width="20px" height="20px">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
            
            <div class="col-md-3">
                <div class="form-control-label"><?php echo e(__('Milestone')); ?></div>
                <?php ($milestone = $task->milestone()); ?>
                <p class="mt-1"><?php if($milestone): ?> <?php echo e($milestone->title); ?> <?php endif; ?></p>
            </div>
        </div>
    </div>

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="border: solid #eee;border-radius: 13px;">
        <li class="nav-item">
            <a class=" nav-link active" id="comments-tab" data-bs-toggle="tab" href="#comments-data" role="tab" aria-controls="home" aria-selected="false"> <?php echo e(__('Comments')); ?> </a>
        </li>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('task file manage')): ?>
        <li class="nav-item">
            <a class=" nav-link" id="file-tab" data-bs-toggle="tab" href="#file-data" role="tab" aria-controls="profile" aria-selected="false"> <?php echo e(__('Files')); ?> </a>
        </li>
        <?php endif; ?>

        <li class="nav-item">
            <a class=" nav-link" id="sub-task-tab" data-bs-toggle="tab" href="#sub-task-data" role="tab" aria-controls="contact" aria-selected="true"> <?php echo e(__('Sub Task')); ?> </a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade active show" id="comments-data" role="tabpanel" aria-labelledby="home-tab">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('task comment create')): ?>
            <form method="post" id="form-comment" data-action="<?php echo e(route('comment.store',[$task->project_id,$task->id,$clientID])); ?>">
                <textarea class="form-control form-control-light mb-2" name="comment" placeholder="<?php echo e(__('Write message')); ?>" id="example-textarea" rows="3" required></textarea>
                <div class="text-end">
                    <div class="btn-group mb-2 ml-2 d-sm-inline-block">
                        <button type="button" class="btn btn btn-primary"><?php echo e(__('Submit')); ?></button>
                    </div>
                </div>
            </form>
            <?php endif; ?>

            <ul class="list-unstyled list-unstyled-border" id="task-comments">
                <?php $__currentLoopData = $task->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="row media border-bottom mb-3">
                        <div class="col-1">
                            <img alt="image" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e($comment->user->name); ?>" <?php if($comment->user->avatar): ?> src="<?php echo e(get_file($comment->user->avatar)); ?>" <?php else: ?> src="<?php echo e(get_file('avatar.png')); ?>"  <?php endif; ?> class="mr-3 avatar-sm rounded-circle img-thumbnail" style="max-width: 30px; max-height: 30px;">
                        </div>
                        <div class="col media-body mb-2 top-10-scroll" style="max-height: 100px">
                                <h5 class="mt-0 mb-1 form-control-label"><?php if($comment->user_type!='Client'): ?><?php echo e($comment->user->name); ?><?php else: ?> <?php echo e($comment->client->name); ?> <?php endif; ?></h5>
                                <?php echo e($comment->comment); ?>

                        </div>
                        <?php if(auth()->guard('web')->check()): ?>
                            <div class="col-auto text-end row_line_style">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('task comment delete')): ?>
                                <a href="#" class="action-btn btn-danger mt-1 btn btn-sm d-inline-flex align-items-center delete-comment"  data-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-url="<?php echo e(route('comment.destroy',[$task->project_id,$task->id,$comment->id])); ?>">
                                    <i class="ti ti-trash"></i>
                                </a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('task file manage')): ?>
        <div class="tab-pane fade" id="file-data" role="tabpanel" aria-labelledby="profile-tab">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('task file uploads')): ?>
            <div class="form-group m-0">
                <form method="post" id="form-file" enctype="multipart/form-data" data-url="<?php echo e(route('comment.store.file',[$task->project_id,$task->id,$clientID])); ?>">
                     <?php echo csrf_field(); ?>
                     <div class="choose-files mt-3">
                        <label for="file">
                            <img id="blah" width="20%" height="20%" class="mb-3"/>
                            <div class=" bg-primary "> <i class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?></div>
                            <input type="file" name="file" class="form-control mb-3" id="file" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        </label>
                    </div>
                    <div class="text-end">
                        <div class="">
                            <button type="submit" class="btn btn-primary"><?php echo e(__('Upload')); ?></button>
                        </div>
                    </div>
                </form>
            </div>
            <?php endif; ?>
            <div id="comments-file" class="mt-3">
                <?php $__currentLoopData = $task->taskFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="card pb-0 mb-1 shadow-none border">
                        <div class="card-body p-3">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="avatar-sm">
                                        <span class="avatar-title rounded text-uppercase">
                                            <img src="<?php echo e(get_file($file->file)); ?>" width="60px" height="60px" alt="">
                                        </span>
                                    </div>
                                </div>
                                <div class="col pl-0">
                                    <a href="#" class="text-muted form-control-label"><?php echo e($file->name); ?></a>
                                    <p class="mb-0"><?php echo e($file->file_size); ?></p>
                                </div>
                                <div class="col-auto">
                                    <!-- Button -->
                                    <a download href="<?php echo e(get_file($file->file)); ?>" class="action-btn btn-primary btn btn-sm d-inline-flex align-items-center" data-toggle="tooltip" title="<?php echo e(__('Download')); ?>">
                                        <i class="ti ti-download"></i>
                                    </a>
                                    <?php if(auth()->guard('web')->check()): ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('task file delete')): ?>
                                        <a href="#" class="action-btn btn-danger  btn btn-sm d-inline-flex align-items-center delete-comment-file" data-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-url="<?php echo e(route('comment.destroy.file',[$task->project_id,$task->id,$file->id])); ?>">
                                            <i class="ti ti-trash"></i>
                                        </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>
        <div class="tab-pane fade mt-3" id="sub-task-data" role="tabpanel" aria-labelledby="contact-tab">
             <p>
                <div class="text-end mb-3">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sub-task create')): ?>
                        <a class="btn btn-sm btn-primary" data-bs-toggle="collapse" href="#form-subtask" role="button" aria-expanded="false" aria-controls="form-subtask" > <i class="ti ti-plus"></i></a>
                    <?php endif; ?>
                </div>
            </p>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sub-task create')): ?>

            <form method="post" class="collapse" id="form-subtask" data-action="<?php echo e(route('subtask.store',[$task->project_id,$task->id,$clientID])); ?>">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group text-start">
                            <label class="col-form-label"><?php echo e(__('Name')); ?></label>
                            <input type="text" name="name" class="form-control" required placeholder="<?php echo e(__('Sub Task Name')); ?>">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group text-start">
                            <label class="col-form-label"><?php echo e(__('Due Date')); ?></label>
                            <input class="form-control" type="date" id="due_date" name="due_date" autocomplete="off" required="required">
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <div class="btn-group d-sm-inline-block">
                        <button type="submit" class="btn btn-primary create-subtask"><?php echo e(__('Add Subtask')); ?></button>
                    </div>
                </div>
            </form>
            <?php endif; ?>
            <ul class="list-group mt-3 " id="subtasks">
                <?php $__currentLoopData = $task->sub_tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subTask): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item row ">
                        <div class="form-check form-switch d-inline-block d-flex justify-content-between">
                            <div>
                                <input type="checkbox" class="form-check-input" name="option" id="option<?php echo e($subTask->id); ?>" <?php if($subTask->status): ?> checked <?php endif; ?> data-url="<?php echo e(route('subtask.update',[$task->project_id,$subTask->id])); ?>">
                                <label class="custom-control-label form-control-label" for="option<?php echo e($subTask->id); ?>"><?php echo e($subTask->name); ?></label>
                            </div>
                            <div>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sub-task delete')): ?>
                                <a href="#" class="action-btn btn-danger  btn btn-sm d-inline-flex align-items-center delete-subtask" data-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-url="<?php echo e(route('subtask.destroy',[$task->project_id,$subTask->id])); ?>">
                                    <i class="ti ti-trash"></i>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div>
<?php else: ?>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body p-4">
                <div class="page-error">
                    <div class="page-inner">
                        <h1><?php echo e(__('404')); ?></h1>
                        <div class="page-description">
                            <?php echo e(__('Page Not Found')); ?>

                        </div>
                        <div class="page-search">
                            <p class="text-muted mt-3"><?php echo e(__("It's looking like you may have taken a wrong turn. Don't worry... it happens to the best of us. Here's a little tip that might help you get back on track.")); ?></p>
                            <div class="mt-3">
                                <a class="btn-return-home badge-blue" href="<?php echo e(route('home')); ?>"><i class="fas fa-reply"></i> <?php echo e(__('Return Home')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
</div>
<?php /**PATH /opt/lampp/htdocs/Koristu-latest/Modules/Taskly/Resources/views/projects/taskShow.blade.php ENDPATH**/ ?>