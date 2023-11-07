<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Task Board')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Task Board')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
<?php echo e(__('Project')); ?>,<?php echo e(__('Project Details')); ?>,<?php echo e(__('Task Board')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-action'); ?>
<div>
    <a href="<?php echo e(route('projects.task.board',[$project->id])); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"title="<?php echo e(__('Grid View')); ?>">
        <i class="ti ti-layout-grid text-white"></i>
    </a>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('task create')): ?>
        <a class="btn btn-sm btn-primary" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Create New Task')); ?>" data-url="<?php echo e(route('tasks.create', [$project->id])); ?>" data-toggle="tooltip" title="<?php echo e(__('Add Task')); ?>"><i class="ti ti-plus"></i></a>
    <?php endif; ?>
    <a href="<?php echo e(route('projects.show', [$project->id])); ?>"  class="btn-submit btn btn-sm btn-primary"
       data-toggle="tooltip" title="<?php echo e(__('Back')); ?>">
        <i class=" ti ti-arrow-back-up"></i>
    </a>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive overflow_hidden">
                        <table class="table mb-0 pc-dt-simple" id="assets">
                            <thead class="thead-light">
                                <tr>
                                    <th><?php echo e(__('Title')); ?></th>
                                    <th><?php echo e(__('Milestone')); ?></th>
                                    <th><?php echo e(__('Priority')); ?></th>
                                    <th><?php echo e(__('Stage')); ?></th>
                                    <th><?php echo e(__('Assigned User')); ?></th>
                                    <?php if(Gate::check('task show') || Gate::check('task edit') || Gate::check('task delete')): ?>
                                        <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $stage->tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <a href="#" data-url="<?php echo e(route('tasks.show', [$task->project_id, $task->id])); ?>"
                                                 class="" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('View')); ?>"><?php echo e($task->title); ?></a>
                                        </td>
                                        <td><span class="budget"><?php echo e(!empty($task->milestones->title)? $task->milestones->title:'-'); ?></span>
                                        </td>
                                        <td>
                                            <span class="budget"><?php echo e($task->priority); ?></span>
                                        </td>
                                        <td>
                                            <span class="budget"><?php echo e($stage->name); ?></span>
                                        </td>
                                        <td>
                                            <?php if($users = $task->users()): ?>
                                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($key < 3): ?>
                                                            <img alt="image" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e($user->name); ?>" <?php if($user->avatar): ?> src="<?php echo e(get_file($user->avatar)); ?>" <?php else: ?> src="<?php echo e(get_file('avatar.png')); ?>"  <?php endif; ?> class="rounded-circle " width="20px" height="20px">
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(count($users) > 3): ?>
                                                        <img alt="image" data-toggle="tooltip" data-original-title="<?php echo e(count($users) - 3); ?> <?php echo e(__('more')); ?>" avatar="+ <?php echo e(count($users) - 3); ?>">
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                         <?php if(Gate::check('task show') || Gate::check('task edit') || Gate::check('task delete')): ?>
                                            <td class="text-end">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('task show')): ?>
                                                <div class="action-btn bg-warning ms-2">
                                                    <a data-size="lg" data-url="<?php echo e(route('tasks.show', [$task->project_id, $task->id])); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('View')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('View')); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                        <i class="ti ti-eye"></i>
                                                    </a>
                                                </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('task edit')): ?>
                                                <div class="action-btn bg-info ms-2">
                                                    <a data-ajax-popup="true" data-size="lg" data-url="<?php echo e(route('tasks.edit', [$task->project_id, $task->id])); ?>" class="btn btn-sm d-inline-flex align-items-center text-white " data-bs-toggle="tooltip" data-title="<?php echo e(__('Task Edit')); ?>" title="<?php echo e(__('Edit')); ?>"><i class="ti ti-pencil"></i></a>

                                                </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('task delete')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['tasks.destroy', $task->project_id, $task->id]]); ?>

                                                    <a href="#!" class="btn btn-sm   align-items-center text-white show_confirm" data-bs-toggle="tooltip" title='Delete'>
                                                        <i class="ti ti-trash"></i>
                                                    </a>
                                                    <?php echo Form::close(); ?>

                                                </div>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
</div>

<?php $__env->stopSection(); ?>


<?php if($project && $currentWorkspace): ?>
<?php $__env->startPush('scripts'); ?>
<!-- third party js -->
<script src="<?php echo e(asset('js/letter.avatar.js')); ?>"></script>

<!-- third party js ends -->
<script>
   $(document).on('click', '#form-comment button', function(e) {
       var comment = $.trim($("#form-comment textarea[name='comment']").val());
       if (comment != '') {
           $.ajax({
               url: $("#form-comment").data('action'),
               data: {
                   comment: comment,
                   _token: "<?php echo e(csrf_token()); ?>"
               },
               type: 'POST',
               success: function(data) {
                   data = JSON.parse(data);

                   if (data.user_type == 'Client') {
                       var avatar = "avatar='" + data.client.name + "'";
                       var html = "<li class='media border-bottom mb-3'>" +
                           "                    <img class='mr-3 avatar-sm rounded-circle img-thumbnail hight_img' width='60' " +
                           avatar + " alt='" + data.client.name + "'>" +
                           "                    <div class='media-body mb-2'>" +
                           "                    <div class='float-left'>" +
                           "                        <h5 class='mt-0 mb-1 form-control-label'>" +
                           data.client.name + "</h5>" +
                           "                        " + data.comment +
                           "                    </div>" +
                           "                    </div>" +
                           "                </li>";
                   } else {
                       var avatar = (data.user.avatar) ?
                           "src='<?php echo e(asset('')); ?>" + data.user.avatar + "'" :
                           "avatar='" + data.user.name + "'";
                       var html = "<li class='media border-bottom mb-3'>" +
                           "                    <div class='col-1'>" +
                           "                        <img class='mr-3 avatar-sm rounded-circle img-thumbnail hight_img ' width='60' " +
                           avatar + " alt='" + data.user.name + "'>" +
                           "                    </div>"+
                           "                    <div class='col media-body mb-2'>" +
                           "                        <h5 class='mt-0 mb-1 form-control-label'>" +
                           data.user.name + "</h5>" +
                           "                        " + data.comment +
                           "                    </div>" +
                           "                    <div class='col text-end'>" +
                           "                           <a href='#' class='delete-icon action-btn btn-danger mt-1 btn btn-sm d-inline-flex align-items-center delete-comment' data-url='" +
                           data.deleteUrl + "'>" +
                           "                               <i class='ti ti-trash'></i>" +
                           "                           </a>" +
                           "                     </div>" +
                           "                </li>";
                   }

                   $("#task-comments").prepend(html);
                   LetterAvatar.transform();
                   $("#form-comment textarea[name='comment']").val('');
                   toastrs('<?php echo e(__('Success')); ?>', '<?php echo e(__('Comment Added Successfully!')); ?>',
                       'success');
               },
               error: function(data) {
                   toastrs('<?php echo e(__('Error')); ?>', '<?php echo e(__('Some Thing Is Wrong!')); ?>', 'error');
               }
           });
       } else {
           toastrs('<?php echo e(__('Error')); ?>', '<?php echo e(__('Please write comment!')); ?>', 'error');
       }
   });
   $(document).on("click", ".delete-comment", function() {
       if (confirm('<?php echo e(__('Are you sure ?')); ?>')) {
           var btn = $(this);
           $.ajax({
               url: $(this).attr('data-url'),
               type: 'DELETE',
               dataType: 'JSON',
               success: function(data) {
                   toastrs('<?php echo e(__('Success')); ?>', '<?php echo e(__('Comment Deleted Successfully!')); ?>',
                       'success');
                   btn.closest('.media').remove();
               },
               error: function(data) {
                   data = data.responseJSON;
                   if (data.message) {
                       toastrs('<?php echo e(__('Error')); ?>', data.message, 'error');
                   } else {
                       toastrs('<?php echo e(__('Error')); ?>', '<?php echo e(__('Some Thing Is Wrong!')); ?>',
                           'error');
                   }
               }
           });
       }
   });
   $(document).on('click', '#form-subtask button', function(e) {
       e.preventDefault();

       var name = $.trim($("#form-subtask input[name=name]").val());
       var due_date = $.trim($("#form-subtask input[name=due_date]").val());
       if (name == '' || due_date == '') {
           toastrs('<?php echo e(__('Error')); ?>', '<?php echo e(__('Please enter fields!')); ?>', 'error');
           return false;
       }

       $.ajax({
           url: $("#form-subtask").data('action'),
           type: 'POST',
           data: {
               name: name,
               due_date: due_date,
           },
           dataType: 'JSON',
           success: function(data) {
               toastrs('<?php echo e(__('Success')); ?>', '<?php echo e(__('Sub Task Added Successfully!')); ?>',
                   'success');

               var html = '<li class="list-group-item py-3">' +
                   '    <div class="form-check form-switch d-inline-block">' +
                   '        <input type="checkbox" class="form-check-input" name="option" id="option' +
                   data.id + '" value="' + data.id + '" data-url="' + data.updateUrl + '">' +
                   '        <label class="custom-control-label form-control-label" for="option' +
                   data.id + '">' + data.name + '</label>' +
                   '    </div>' +
                   '    <div class="float-end">' +
                   '        <a href="#" class=" action-btn btn-danger  btn btn-sm d-inline-flex align-items-center delete-comment delete-icon delete-subtask" data-url="' +
                   data.deleteUrl + '">' +
                   '            <i class="ti ti-trash"></i>' +
                   '        </a>' +
                   '    </div>' +
                   '</li>';

               $("#subtasks").prepend(html);
               $("#form-subtask input[name=name]").val('');
               $("#form-subtask input[name=due_date]").val('');
               $("#form-subtask").collapse('toggle');
           },
           error: function(data) {
               data = data.responseJSON;
               if (data.message) {
                   toastrs('<?php echo e(__('Error')); ?>', data.message, 'error');
                   $('#file-error').text(data.errors.file[0]).show();
               } else {
                   toastrs('<?php echo e(__('Error')); ?>', '<?php echo e(__('Some Thing Is Wrong!')); ?>', 'error');
               }
           }
       });
   });
   $(document).on("change", "#subtasks input[type=checkbox]", function() {
       $.ajax({
           url: $(this).attr('data-url'),
           type: 'POST',
           data: {
               _token: "<?php echo e(csrf_token()); ?>"
           },
           dataType: 'JSON',
           success: function(data) {
               toastrs('<?php echo e(__('Success')); ?>', '<?php echo e(__('Subtask Updated Successfully!')); ?>',
                   'success');
           },
           error: function(data) {
               data = data.responseJSON;
               if (data.message) {
                   toastrs('<?php echo e(__('Error')); ?>', data.message, 'error');
               } else {
                   toastrs('<?php echo e(__('Error')); ?>', '<?php echo e(__('Some Thing Is Wrong!')); ?>', 'error');
               }
           }
       });
   });
   $(document).on("click", ".delete-subtask", function() {
       if (confirm('<?php echo e(__('Are you sure ?')); ?>')) {
           var btn = $(this);
           $.ajax({
               url: $(this).attr('data-url'),
               type: 'DELETE',
               dataType: 'JSON',
               success: function(data) {
                   toastrs('<?php echo e(__('Success')); ?>', '<?php echo e(__('Subtask Deleted Successfully!')); ?>',
                       'success');
                   btn.closest('.list-group-item').remove();
               },
               error: function(data) {
                   data = data.responseJSON;
                   if (data.message) {
                       toastrs('<?php echo e(__('Error')); ?>', data.message, 'error');
                   } else {
                       toastrs('<?php echo e(__('Error')); ?>', '<?php echo e(__('Some Thing Is Wrong!')); ?>',
                           'error');
                   }
               }
           });
       }
   });
   // $("#form-file").submit(function(e){
   $(document).on('submit', '#form-file', function(e) {
       e.preventDefault();

       $.ajax({
           url: $("#form-file").data('url'),
           type: 'POST',
           data: new FormData(this),
           dataType: 'JSON',
           contentType: false,
           cache: false,
           processData: false,
           success: function(data) {
               toastrs('Success', '<?php echo e(__('File Upload Successfully!')); ?>', 'success');

               var delLink = '';

               if (data.deleteUrl.length > 0) {
                   delLink =
                       "<a href='#' class=' action-btn btn-danger  btn btn-sm d-inline-flex align-items-center delete-comment delete-icon delete-comment-file'  data-url='" +
                       data.deleteUrl + "'>" +
                       "                                        <i class='ti ti-trash'></i>" +
                       "                                    </a>";
               }

               var html = "<div class='card mb-1 shadow-none border'>" +
                   "                        <div class='card-body p-3'>" +
                   "                            <div class='row align-items-center'>" +
                   "                                <div class='col-auto'>" +
                   "                                    <div class='avatar-sm'>" +
                   "                                        <span class='avatar-title rounded text-uppercase'>" +
                    "  <img src='<?php echo e(asset('uploads/tasks/')); ?>/"+
                   data.file +
                   "' width='60px' height='60px' >"+
                   "                                        </span>" +
                   "                                    </div>" +
                   "                                </div>" +
                   "                                <div class='col pl-0'>" +
                   "                                    <a href='#' class='text-muted form-control-label'>" +
                   data.name + "</a>" +
                   "                                    <p class='mb-0'>" + data.file_size +
                   "</p>" +
                   "                                </div>" +
                   "                                <div class='col-auto'>" +
                   "                                    <a download href='<?php echo e(asset('/uploads/tasks/')); ?>/" +
                   data.file +
                   "' class='edit-icon action-btn btn-primary  btn btn-sm d-inline-flex align-items-center mx-1'>" +
                   "                                        <i class='ti ti-download'></i>" +
                   "                                    </a>" +
                   delLink +
                   "                                </div>" +
                   "                            </div>" +
                   "                        </div>" +
                   "                    </div>";
               $("#comments-file").prepend(html);
           },
           error: function(data) {
               data = data.responseJSON;
               if (data.message) {
                   toastrs('<?php echo e(__('Error')); ?>', data.message, 'error');
                   $('#file-error').text(data.errors.file[0]).show();
               } else {
                   toastrs('<?php echo e(__('Error')); ?>', '<?php echo e(__('Some Thing Is Wrong!')); ?>', 'error');
               }
           }
       });
   });
   $(document).on("click", ".delete-comment-file", function() {
       if (confirm('<?php echo e(__('Are you sure ?')); ?>')) {
           var btn = $(this);
           $.ajax({
               url: $(this).attr('data-url'),
               type: 'DELETE',
               data: {
                   _token: "<?php echo e(csrf_token()); ?>"
               },
               dataType: 'JSON',
               success: function(data) {
                   toastrs('<?php echo e(__('Success')); ?>', '<?php echo e(__('File Deleted Successfully!')); ?>',
                       'success');
                   btn.closest('.border').remove();
               },
               error: function(data) {
                   data = data.responseJSON;
                   if (data.message) {
                       toastrs('<?php echo e(__('Error')); ?>', data.message, 'error');
                   } else {
                       toastrs('<?php echo e(__('Error')); ?>', '<?php echo e(__('Some Thing Is Wrong!')); ?>',
                           'error');
                   }
               }
           });
       }
   });
</script>
<?php $__env->stopPush(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Koristu-latest/Modules/Taskly/Resources/views/projects/tasklist.blade.php ENDPATH**/ ?>