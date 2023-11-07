<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Task Board')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
<?php echo e(__('Project')); ?>,<?php echo e(__('Project Details')); ?>,<?php echo e(__('Task Board')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-action'); ?>
<div>
    <?php echo $__env->yieldPushContent('addButtonHook'); ?>
    <a href="<?php echo e(route('projecttask.list',[$project->id])); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"title="<?php echo e(__('List View')); ?>">
        <i class="ti ti-list text-white"></i>
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
<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/dragula.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<?php if($project && $currentWorkspace && auth()->user()->can('task manage')): ?>
<div class="row">
   <div class="col-sm-12">
      <div class="row kanban-wrapper horizontal-scroll-cards" data-toggle="dragula" data-containers='<?php echo e(json_encode($statusClass)); ?>'>
         <?php $__currentLoopData = $stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <div class="col" id="backlog">
            <div class="card card-list">
               <div class="card-header">
                  <div class="float-end">
                     <button class="btn-submit btn btn-md btn-primary btn-icon px-1  py-0">
                     <span
                        class="badge badge-secondary rounded-pill count"><?php echo e($stage->tasks->count()); ?></span>
                     </button>
                  </div>
                  <h4 class="mb-0"><?php echo e($stage->name); ?></h4>
               </div>
               <div id="<?php echo e('task-list-' . str_replace(' ', '_', $stage->id)); ?>"
                  data-status="<?php echo e($stage->id); ?>" class="card-body kanban-box">
                  <?php $__currentLoopData = $stage->tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="card" id="<?php echo e($task->id); ?>">
                     <div class="position-absolute top-0 start-0 pt-3 ps-3">
                        <?php if($task->priority == 'Low'): ?>
                        <div class="badge bg-success p-2 px-3 rounded"> <?php echo e($task->priority); ?>

                        </div>
                        <?php elseif($task->priority == 'Medium'): ?>
                        <div class="badge bg-warning p-2 px-3 rounded"> <?php echo e($task->priority); ?>

                        </div>
                        <?php elseif($task->priority == 'High'): ?>
                        <div class="badge bg-danger p-2 px-3 rounded"> <?php echo e($task->priority); ?>

                        </div>
                        <?php endif; ?>
                     </div>
                     <div class="card-header border-0 pb-0 position-relative">
                        <div style="padding: 30px 2px;">
                           <a href="#"
                              data-url="<?php echo e(route('tasks.show', [$task->project_id, $task->id])); ?>"
                              data-size="lg" data-ajax-popup="true"
                              data-title="<?php echo e(__('Task Detail')); ?>" class="h6 task-title">
                              <h5><?php echo e($task->title); ?></h5>
                           </a>
                        </div>
                        <div class="card-header-right">
                           <div class="btn-group card-option">
                              <button type="button" class="btn dropdown-toggle"
                                 data-bs-toggle="dropdown" aria-haspopup="true"
                                 aria-expanded="false">
                              <i class="feather icon-more-vertical"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end">
                                 <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('task show')): ?>
                                 <a class="dropdown-item" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('View Task')); ?>" data-url="<?php echo e(route('tasks.show', [$task->project_id, $task->id])); ?>"><i class="ti ti-eye"></i> <?php echo e(__('View')); ?></a>
                                 <?php endif; ?>
                                 <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('task edit')): ?>
                                 <a class="dropdown-item" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Edit Task')); ?>"data-url="<?php echo e(route('tasks.edit', [$task->project_id, $task->id])); ?>"><i class="ti ti-pencil"></i> <?php echo e(__('Edit')); ?></a>
                                 <?php endif; ?>
                                 <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('task delete')): ?>
                                 <form id="delete-form-<?php echo e($task->id); ?>" action="<?php echo e(route('tasks.destroy', [$task->project_id, $task->id])); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <a href="#"
                                       class="dropdown-item bs-pass-para show_confirm"
                                       data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                       data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                       data-confirm-yes="delete-form-<?php echo e($task->id); ?>"> <i
                                       class="ti ti-trash"></i>
                                    <?php echo e(__('Delete')); ?>

                                    </a>
                                 </form>
                                 <?php endif; ?>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="card-body pt-0">
                        <div class="row">
                           <div class="col">
                              <div class="action-item">
                                 <?php echo e(company_date_formate($task->start_date)); ?>

                              </div>
                           </div>
                           <div class="col text-end">
                              <div class="action-item">
                                 <?php echo e(company_date_formate($task->due_date)); ?>

                              </div>
                           </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                           <ul class="list-inline mb-0">
                              <li class="list-inline-item d-inline-flex align-items-center"><i
                                 class="f-16 text-primary ti ti-brand-telegram"></i>
                                 <?php echo e($task->taskCompleteSubTaskCount()); ?>/<?php echo e($task->taskTotalSubTaskCount()); ?>

                              </li>
                           </ul>
                           <div class="user-group">
                              <?php if($users = $task->users()): ?>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($key < 3): ?>
                                            <img alt="image" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e($user->name); ?>" <?php if($user->avatar): ?> src="<?php echo e(get_file($user->avatar)); ?>" <?php else: ?> src="<?php echo e(get_file('avatar.png')); ?>"  <?php endif; ?> class="rounded-circle " width="40px" height="40px">
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if(count($users) > 3): ?>
                                        <img alt="image" data-toggle="tooltip" data-original-title="<?php echo e(count($users) - 3); ?> <?php echo e(__('more')); ?>" avatar="+ <?php echo e(count($users) - 3); ?>">
                                <?php endif; ?>
                              <?php endif; ?>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <span class="empty-container" data-placeholder="Empty"></span>
               </div>
            </div>
         </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <!-- [ sample-page ] end -->
   </div>
</div>
<?php else: ?>
<div class="container mt-5">
   <div class="card">
      <div class="card-body p-4">
         <div class="page-error">
            <div class="page-inner">
               <h1>404</h1>
               <div class="page-description">
                  <?php echo e(__('Page Not Found')); ?>

               </div>
               <div class="page-search">
                  <p class="text-muted mt-3">
                     <?php echo e(__("It's looking like you may have taken a wrong turn. Don't worry... it happens to the best of us. Here's a little tip that might help you get back on track.")); ?>

                  </p>
                  <div class="mt-3">
                     <a class="btn-return-home badge-blue" href="<?php echo e(route('home')); ?>"><i
                        class="fas fa-reply"></i> <?php echo e(__('Return Home')); ?></a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php if($project && $currentWorkspace): ?>
<?php $__env->startPush('scripts'); ?>
<!-- third party js -->
<script src="<?php echo e(asset('assets/js/plugins/dragula.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/letter.avatar.js')); ?>"></script>
<script>
   ! function(a) {
       "use strict";
       var t = function() {
           this.$body = a("body")
       };
       t.prototype.init = function() {
           a('[data-toggle="dragula"]').each(function() {
               var t = a(this).data("containers"),
                   n = [];
               if (t)
                   for (var i = 0; i < t.length; i++) n.push(a("#" + t[i])[0]);
               else n = [a(this)[0]];
               var r = a(this).data("handleclass");
               r ? dragula(n, {
                   moves: function(a, t, n) {
                       return n.classList.contains(r)
                   }
               }) : dragula(n).on('drop', function(el, target, source, sibling) {
                   var sort = [];
                   $("#" + target.id + " > div").each(function(key) {
                       sort[key] = $(this).attr('id');
                   });
                   var id = el.id;
                   var old_status = $("#" + source.id).data('status');
                   var new_status = $("#" + target.id).data('status');
                   var project_id = '<?php echo e($project->id); ?>';

                   $("#" + source.id).parents('.card-list').find('.count').text($("#" + source.id +
                       " > div").length);
                   $("#" + target.id).parents('.card-list').find('.count').text($("#" + target.id +
                       " > div").length);
                   $.ajax({
                       url: '<?php echo e(route('tasks.update.order', [$project->id])); ?>',
                       type: 'POST',
                       data: {
                           id: id,
                           sort: sort,
                           new_status: new_status,
                           old_status: old_status,
                           project_id: project_id,
                           _token: "<?php echo e(csrf_token()); ?>"
                       },
                       success: function(data) {
                       }
                   });
               });
           })
       }, a.Dragula = new t, a.Dragula.Constructor = t
   }(window.jQuery),
   function(a) {
       "use strict";
       <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('task move')): ?>
       a.Dragula.init();
       <?php endif; ?>
   }(window.jQuery);
</script>
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
                       var html = "<li class='row media border-bottom mb-3'>" +
                           "                    <div class='col-1'>" +
                           "                        <img class='mr-3 avatar-sm rounded-circle img-thumbnail hight_img ' style='max-width: 30px; max-height: 30px;' " +
                           avatar + " alt='" + data.user.name + "'>" +
                           "                    </div>"+
                           "                    <div class='col media-body mb-2 top-10-scroll' style='max-height:100px;'>" +
                           "                        <h5 class='mt-0 mb-1 form-control-label'>" +
                           data.user.name + "</h5>" +
                           "                        " + data.comment +
                           "                    </div>" +
                           "                    <div class='col-auto text-end row_line_style'>" +
                           "                           <a href='#' class='delete-icon action-btn btn-danger mt-1 btn btn-sm d-inline-flex align-items-center delete-comment' data-toggle='tooltip' title='<?php echo e(__('Delete')); ?>' data-url='" +
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
   $(document).on("click", ".delete-comment", function () {
                if (confirm('<?php echo e(__('Are you sure ?')); ?>')) {
                    var btn = $(this);
                    $.ajax({
                        url: $(this).attr('data-url'),
                        type: 'DELETE',
                        dataType: 'JSON',
                        success: function (data) {
                            toastrs('<?php echo e(__('Success')); ?>', '<?php echo e(__("Comment Deleted Successfully!")); ?>', 'success');
                            btn.closest('.media').remove();
                        },
                        error: function (data) {
                            data = data.responseJSON;
                            if (data.message) {
                                toastrs('<?php echo e(__('Error')); ?>', data.message, 'error');
                            } else {
                                toastrs('<?php echo e(__('Error')); ?>', '<?php echo e(__("Some Thing Is Wrong!")); ?>', 'error');
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
           toastrs('<?php echo e(__('Error')); ?>', '<?php echo e(__("Please enter fields!")); ?>', 'error');
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
               toastrs('<?php echo e(__('Success')); ?>', '<?php echo e(__("Sub Task Added Successfully!")); ?>',
                   'success');

               var html = '<li class="list-group-item row">' +
                   '    <div class="form-check form-switch d-inline-block d-flex justify-content-between">' +
                   '       <div> <input type="checkbox" class="form-check-input" name="option" id="option' +
                   data.id + '" value="' + data.id + '" data-url="' + data.updateUrl + '">' +
                   '        <label class="custom-control-label form-control-label" for="option' +
                   data.id + '">' + data.name + '</label>' +
                   '    </div>' +
                   '    <div>' +
                   '        <a href="#" class=" action-btn btn-danger  btn btn-sm d-inline-flex align-items-center delete-icon delete-subtask" data-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"  data-url="' +
                   data.deleteUrl + '">' +
                   '            <i class="ti ti-trash"></i>' +
                   '        </a>' +
                        '</div>'+
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
                       "<a href='#' class=' action-btn btn-danger  btn btn-sm d-inline-flex align-items-center delete-icon delete-comment-file' data-toggle='tooltip' title='<?php echo e(__('Delete')); ?>'  data-url='" +
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
                    " <img src='<?php echo e(asset('')); ?>"+
                   data.file +
                   "' width='60px' height='60px' >"+
                   "                                        </span>" +
                   "                                    </div>" +
                   "                                </div>" +
                   "                                <div class='col pl-0'>" +
                   "                                    <a href='#' class='text-muted form-control-label'>" + data.name + "</a>" +
                            "                                    <p class='mb-0'></p>" +
                   "                                </div>" +
                   "                                <div class='col-auto'>" +
                   "                                    <a download href='<?php echo e(asset('')); ?>/" +
                   data.file +
                   "' class='edit-icon action-btn btn-primary  btn btn-sm d-inline-flex align-items-center mx-1' data-toggle='tooltip' title='<?php echo e(__('Download')); ?>'>" +
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
                    toastrs('<?php echo e(__('Error')); ?>', data.error, 'error');
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

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Koristu-latest/Modules/Taskly/Resources/views/projects/taskboard.blade.php ENDPATH**/ ?>