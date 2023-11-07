<?php $__env->startSection('title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>

<?php
$logo_path = \App\Models\Utility::get_file('/');
?>

<?php $__env->startSection('action-button'); ?>
    <?php if(Auth::user()->type == 'admin'): ?>
        <div class="bg-neutral rounded-pill d-inline-block">
            <div class="input-group input-group-sm input-group-merge input-group-flush">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-transparent"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" id="keyword" class="form-control form-control-flush" placeholder="<?php echo e(__('Search by Name or skill')); ?>">
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('theme-script'); ?>
    <?php if(Auth::user()->type != 'admin'): ?>
        <script src="<?php echo e(asset('assets/libs/dragula/dist/dragula.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/libs/apexcharts/dist/apexcharts.min.js')); ?>"></script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(Auth::user()->type == 'admin'): ?>
        <div class="row" id="dashboard_view"></div>
    <?php else: ?>
        <?php $plan = true; ?>
        <?php if(Auth::user()->plan != 1): ?>
            <?php if(Auth::user()->plan != '' && (Auth::user()->is_plan_purchased == 0 || Auth::user()->plan_expire_date < date('Y-m-d')) ): ?>
                <div class="card bg-gradient-warning">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-white mb-0 float-left">
                                    <p class="mb-0">
                                        <?php if(Auth::user()->is_trial_done && Auth::user()->is_plan_purchased == 0): ?>
                                            <?php if(Auth::user()->plan_expire_date < date('Y-m-d')): ?>
                                                <?php echo e(__('Your trial is Expired on ')); ?>

                                            <?php else: ?>
                                                <?php echo e(__('Your trial is Expires on ')); ?>

                                            <?php endif; ?>
                                            <?php $plan = false; ?>
                                        <?php elseif(Auth::user()->plan != '' && Auth::user()->plan_expire_date < date('Y-m-d')): ?>
                                            <?php echo e(__('Your Plan is Expired on ')); ?>

                                            <?php $plan = false; ?>
                                        <?php endif; ?>
                                        <?php if($plan): ?>
                                            <?php echo e(__('Your Plan is Expires on ')); ?>

                                        <?php endif; ?>
                                        <?php echo e((date('d M Y',strtotime(\Auth::user()->plan_expire_date)))); ?>

                                    </p>
                                </h5>
                                <h5 class="text-white mb-0 float-right">
                                    <a href="<?php echo e(url('/checks')); ?>" class="btn btn-xs btn-primary btn-icon rounded-pill">
                                        <span class="btn-inner--icon"><i class="fas fa-cart-plus"></i></span>
                                        <span class="btn-inner--text"><?php echo e(__('Upgrade Plan')); ?></span>
                                    </a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6 class="text-muted mb-1"><?php echo e(__('Total Projects')); ?></h6>
                                <span class="h3 font-weight-bold mb-0 "><?php echo e($home_data['total_project']['total']); ?></span> <br>
                            </div>
                            <div class="col-auto">
                                <div class="progress-circle progress-sm" data-progress="<?php echo e($home_data['total_project']['percentage']); ?>" data-text="<?php echo e($home_data['total_project']['percentage']); ?>%" data-color="primary"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6 class="text-muted mb-1"><?php echo e(__('Total Tasks')); ?></h6>
                                <span class="h3 font-weight-bold mb-0 "><?php echo e($home_data['total_task']['total']); ?></span>
                            </div>
                            <div class="col-auto">
                                <div class="progress-circle progress-sm" data-progress="<?php echo e($home_data['total_task']['percentage']); ?>" data-text="<?php echo e($home_data['total_task']['percentage']); ?>%" data-color="info"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6 class="text-muted mb-1"><?php echo e(__('Total Expense')); ?></h6>
                                <span class="h3 font-weight-bold mb-0 "><?php echo e($home_data['total_expense']['total']); ?></span>
                            </div>
                            <div class="col-auto">
                                <div class="progress-circle progress-sm" data-progress="<?php echo e($home_data['total_expense']['percentage']); ?>" data-text="<?php echo e($home_data['total_expense']['percentage']); ?>%" data-color="warning"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6 class="text-muted mb-1"><?php echo e(__('Total Users')); ?></h6>
                                <span class="h3 font-weight-bold mb-0 "><?php echo e($home_data['total_user']); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card card-fluid">
                    <div class="card-header">
                        <h6 class="mb-0"><?php echo e(__('Tasks Overview')); ?></h6>
                        <small class="text-muted"><?php echo e(__('Total Completed task in last 7 days')); ?></small>
                    </div>
                    <div class="card-body">
                        <div id="task_overview" data-color="primary" data-height="280"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-sm-12 col-md-4 col-lg-4">
                <div class="card card-fluid">
                    <div class="card-header">
                        <h6 class="mb-0"><?php echo e(__('Project Status')); ?></h6>
                    </div>
                    <div class="card-body">
                        <?php $__currentLoopData = $home_data['project_status']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="row align-items-center mb-4">
                                <div class="col-auto">
                                    <div class="progress-circle progress-sm" data-progress="<?php echo e($val['percentage']); ?>" data-color="<?php echo e(\App\Models\Project::$status_color[$status]); ?>"></div>
                                </div>
                                <div class="col">
                                    <span class="d-block h6 mb-0"><?php echo e(__(\App\Models\Project::$status[$status])); ?></span>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="d-flex my-1 text-center">
                            <?php $__currentLoopData = $home_data['project_status']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col">
                            <span class="badge badge-dot badge-lg h6">
                                <i class="bg-<?php echo e(\App\Models\Project::$status_color[$status]); ?>"></i><?php echo e($val['total']); ?>

                            </span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
            
                        
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?php echo e(__('Top Due Projects')); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper table_scroll p-3  min-h-430 mh-430">
                        <div class="table-responsive" style="position: relative;">
                        
                            <div class="list-group list-group-flush">
                                <?php if($home_data['due_project']->count() > 0): ?>
                                    <?php $__currentLoopData = $home_data['due_project']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $due_project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(route('projects.show',$due_project)); ?>" class="list-group-item list-group-item-action">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                     <?php if($due_project->image): ?>
                                                        <img src="<?php echo e($logo_path.$due_project->image); ?>" alt="<?php echo e($due_project->title); ?>"  class="avatar rounded-circle" id="blah" />
                                                        <?php else: ?>

                                                            <img <?php echo e($due_project->img_image); ?> class="avatar rounded-circle"/>
                                                        <?php endif; ?>
                                                </div>
                                                <div class="flex-fill pl-3 text-limit">
                                                    <div class="row">
                                                        <div class="col-9">
                                                            <h6 class="progress-text mb-1 text-sm d-block text-limit"><?php echo e($due_project->title); ?></h6>
                                                        </div>
                                                        <div class="col-3 text-right">
                                                            <span class="badge badge-xs badge-<?php echo e((\Auth::user()->checkProject($due_project->id) == 'Owner') ? 'success' : 'warning'); ?>"><?php echo e(__(\Auth::user()->checkProject($due_project->id))); ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="progress progress-xs mb-0">
                                                        <div class="progress-bar bg-<?php echo e($due_project->project_progress()['color']); ?>" role="progressbar" style="width: <?php echo e($due_project->project_progress()['percentage']); ?>;" aria-valuenow="<?php echo e($due_project->project_progress()['percentage']); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <div class="d-flex justify-content-between text-xs text-muted text-right mt-1">
                                                        <div>
                                                            <span class="font-weight-bold text-<?php echo e(\App\Models\Project::$status_color[$due_project->status]); ?>"><?php echo e(__(\App\Models\Project::$status[$due_project->status])); ?></span>
                                                        </div>
                                                        <div>
                                                            <?php echo e($due_project->countTask(Auth::user()->id)); ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <div class="py-5">
                                        <h6 class="text-center mb-0"><?php echo e(__('No Due Projects Found.')); ?></h6>
                                    </div>
                                <?php endif; ?>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-fluid">
                    <div class="card-header">
                        <h6 class="mb-0"><?php echo e(__('Timesheet Logged Hours')); ?></h6>
                        <small class="text-muted"><?php echo e(__('Last 7 days')); ?></small>
                    </div>
                    <div class="card-body">
                        <div id="timesheet_logged" data-color="primary" data-height="410"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8 col-md-8">
                <div class="card card-fluid">
                    <div class="card-header border-0">
                        <h6 class="mb-0"><?php echo e(__('Top Due Tasks')); ?></h6>
                    </div>
                    <div class="card-wrapper table_scroll p-3">
                        <div class="table-responsive" style="position: relative;">
                            <table class="table align-items-center">
                                <thead>
                                <tr>
                                    <th scope="col" class="sort" data-sort="name"><?php echo e(__('Tasks')); ?></th>
                                    <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Project')); ?></th>
                                    <th scope="col" class="sort" data-sort="status"><?php echo e(__('Stage')); ?></th>
                                    <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Completion')); ?></th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                <?php $__currentLoopData = $home_data['due_tasks']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $due_task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <div class="media-body ml-4">
                                                    <a href="<?php echo e(route('projects.tasks.index',$due_task->project->id)); ?>" class="name mb-0 h6 text-sm"><?php echo e($due_task->title); ?></a>
                                                </div>
                                            </div>
                                        </th>
                                        <td class="budget"><?php echo e($due_task->project->title); ?></td>
                                        <td>
                                        <span class="badge badge-dot mr-4">
                                            <i class="bg-<?php echo e(\App\Models\ProjectTask::$priority_color[$due_task->priority]); ?>"></i>
                                            <span class="status"><?php echo e(\App\Models\ProjectTask::$priority[$due_task->priority]); ?></span>
                                        </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="completion mr-2"><?php echo e($due_task->taskProgress()['percentage']); ?></span>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?php echo e(__('To do list')); ?></h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <div data-toggle="collapse" data-target="#form-todo">
                                        <a class="action-item">
                                            <i class="fas fa-plus"></i>
                                            <span class="d-none d-sm-inline-block"><?php echo e(__('Add')); ?></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                        <div class="mh-350 min-h-350">
                            <div class="card-wrapper table_scroll p-3">
                                <form method="post" id="form-todo" class="collapse pb-2" data-action="<?php echo e(route('todo.store')); ?>">
                                    <div class="card border shadow-none">
                                        <div class="px-3 py-2 row align-items-center">
                                            <div class="col-9">
                                                <input type="text" name="title" required class="form-control" placeholder="<?php echo e(__('Todo Title')); ?>"/>
                                            </div>
                                            <div class="col-2 card-meta d-inline-flex align-items-center">
                                                <button class="btn btn-primary btn-xs" type="submit" id="todo_submit">
                                                    <i class="fas fa-plus "></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div id="todolist">
                                    <?php if(\Auth::user()->todo->count() > 0): ?>
                                        <?php $__currentLoopData = \Auth::user()->todo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $todo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="card border shadow-none todo-member mb-2">
                                                <div class="px-3 py-2 row align-items-center">
                                                    <div class="col-10">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="todo-item-<?php echo e($todo->id); ?>" <?php echo e(($todo->is_complete == 1) ? 'checked' : ''); ?> data-url="<?php echo e(route('todo.update',$todo->id)); ?>">
                                                            <label class="custom-control-label h6 text-sm" for="todo-item-<?php echo e($todo->id); ?>"><?php echo e($todo->title); ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto card-meta d-inline-flex align-items-center ml-sm-auto">
                                                        <a class="action-item d-todo" role="button" data-url="<?php echo e(route('todo.destroy',$todo->id)); ?>">
                                                            <i class="fas fa-trash-alt text-danger"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <p class="h6 text-center"><?php echo e(__('No Todo List Found..!')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <?php if(Auth::user()->type == 'admin'): ?>
        <script>
            $(document).ready(function () {
                ajaxFilterUserView();
                // when searching by user name
                $(document).on('keyup', '#keyword', function () {
                    ajaxFilterUserView($(this).val());
                });
            })

            // For Filter
            function ajaxFilterUserView(keyword = '') {
                var mainEle = $('#dashboard_view');
                $.ajax({
                    url: '<?php echo e(route('dashboard.view')); ?>',
                    data: {
                        keyword: keyword,
                    },
                    success: function (data) {
                        mainEle.html(data.html);
                    }
                });
            }
        </script>
    <?php else: ?>
        <script>
            /*To-Do Module*/
            $(document).on('click', '#todo_submit', function () {
                var title = $("#form-todo input[name=title]").val();
                if (title != '') {
                    $.ajax({
                        url: $("#form-todo").data('action'),
                        data: {title: title},
                        type: 'POST',
                        success: function (data) {
                            data = JSON.parse(data);
                            show_toastr('<?php echo e(__('Success')); ?>', '<?php echo e(__("Todo Added Successfully!")); ?>', 'success');
                            var html = '<div class="card border shadow-none todo-member mb-2">' +
                                '                                <div class="px-3 py-2 row align-items-center">' +
                                '                                    <div class="col-10">' +
                                '                                        <div class="custom-control custom-checkbox">' +
                                '                                            <input type="checkbox" class="custom-control-input" id="check-item-' + data.id + '" data-url="' + data.updateUrl + '">' +
                                '                                            <label class="custom-control-label h6 text-sm" for="check-item-' + data.id + '">' + data.title + '</label>' +
                                '                                        </div>' +
                                '                                    </div>' +
                                '                                    <div class="col-auto card-meta d-inline-flex align-items-center ml-sm-auto">' +
                                '                                        <a class="action-item d-todo" role="button" data-url="' + data.deleteUrl + '">' +
                                '                                            <i class="fas fa-trash-alt text-danger"></i>' +
                                '                                        </a>' +
                                '                                    </div>' +
                                '                                </div>' +
                                '                            </div>';

                            $("#todolist").append(html);
                            $("#form-todo input[name=name]").val('');
                            $("#form-todo").collapse('toggle');
                        },
                        error: function (data) {
                            data = data.responseJSON;
                            show_toastr('<?php echo e(__('Error')); ?>', data.message, 'error');
                        }
                    });
                } else {
                    show_toastr('<?php echo e(__('Error')); ?>', '<?php echo e(__("Please write todo title!")); ?>', 'error');
                }
            });
            $(document).on("change", "#todolist input[type=checkbox]", function () {
                $.ajax({
                    url: $(this).attr('data-url'),
                    type: 'POST',
                    dataType: 'JSON',
                    success: function (data) {
                        show_toastr('<?php echo e(__('Success')); ?>', '<?php echo e(__("Todo Updated Successfully!")); ?>', 'success');
                    },
                    error: function (data) {
                        data = data.responseJSON;
                        if (data.message) {
                            show_toastr('<?php echo e(__('Error')); ?>', data.message, 'error');
                        } else {
                            show_toastr('<?php echo e(__('Error')); ?>', '<?php echo e(__("Some Thing Is Wrong!")); ?>', 'error');
                        }
                    }
                });
            });
            $(document).on('click', '.d-todo', function () {
                var btn = $(this);
                $.ajax({
                    url: $(this).attr('data-url'),
                    type: 'DELETE',
                    dataType: 'JSON',
                    success: function (data) {
                        show_toastr('<?php echo e(__('Success')); ?>', '<?php echo e(__("Todo Deleted Successfully!")); ?>', 'success');
                        btn.closest('.todo-member').remove();
                    },
                    error: function (data) {
                        data = data.responseJSON;
                        if (data.message) {
                            show_toastr('<?php echo e(__('Error')); ?>', data.message, 'error');
                        } else {
                            show_toastr('<?php echo e(__('Error')); ?>', '<?php echo e(__("Some Thing Is Wrong!")); ?>', 'error');
                        }
                    }
                });
            });

            /*Chart*/
            var e = $("#task_overview");
            var t = {
                chart: {width: "100%", zoom: {enabled: !1}, toolbar: {show: !1}, shadow: {enabled: !1}},
                stroke: {width: 7, curve: "smooth"},
                series: [{name: "<?php echo e(__('Tasks')); ?> ", data: <?php echo json_encode(array_values($home_data['task_overview'])); ?>}],
                xaxis: {labels: {style: {colors: SiteStyle.colors.gray[600], fontSize: "14px", fontFamily: SiteStyle.fonts.base, cssClass: "apexcharts-xaxis-label"}}, axisBorder: {show: !1}, axisTicks: {show: !0, borderType: "solid", color: SiteStyle.colors.gray[300], height: 6, offsetX: 0, offsetY: 0}, type: "category", categories: <?php echo json_encode(array_keys($home_data['task_overview'])); ?>},
                yaxis: {labels: {style: {color: SiteStyle.colors.gray[600], fontSize: "12px", fontFamily: SiteStyle.fonts.base}}, axisBorder: {show: !1}, axisTicks: {show: !0, borderType: "solid", color: SiteStyle.colors.gray[300], height: 6, offsetX: 0, offsetY: 0}},
                fill: {type: "solid"},
                markers: {size: 4, opacity: .7, strokeColor: "#fff", strokeWidth: 3, hover: {size: 7}},
                grid: {borderColor: SiteStyle.colors.gray[300], strokeDashArray: 5},
                dataLabels: {enabled: !1}
            }, a = (e.data().dataset, e.data().labels, e.data().color), n = e.data().height, o = e.data().type;
            t.colors = [SiteStyle.colors.theme[a]], t.markers.colors = [SiteStyle.colors.theme[a]], t.chart.height = n || 350, t.chart.type = o || "line";
            var i = new ApexCharts(e[0], t);

            var e1 = $("#timesheet_logged");
            var t1 = {
                chart: {width: "100%", type: "bar", zoom: {enabled: !1}, toolbar: {show: !1}, shadow: {enabled: !1}},
                plotOptions: {bar: {horizontal: !1, columnWidth: "30%", endingShape: "rounded"}},
                stroke: {show: !0, width: 2, colors: ["transparent"]},
                series: [{name: "<?php echo e(__('Timesheet hours')); ?> ", data: <?php echo json_encode(array_values($home_data['timesheet_logged'])); ?>}],
                xaxis: {labels: {style: {colors: SiteStyle.colors.gray[600], fontSize: "14px", fontFamily: SiteStyle.fonts.base, cssClass: "apexcharts-xaxis-label"}}, axisBorder: {show: !1}, axisTicks: {show: !0, borderType: "solid", color: SiteStyle.colors.gray[300], height: 6, offsetX: 0, offsetY: 0}, type: "category", categories: <?php echo json_encode(array_keys($home_data['timesheet_logged'])); ?>},
                yaxis: {labels: {style: {color: SiteStyle.colors.gray[600], fontSize: "12px", fontFamily: SiteStyle.fonts.base}}, axisBorder: {show: !1}, axisTicks: {show: !0, borderType: "solid", color: SiteStyle.colors.gray[300], height: 6, offsetX: 0, offsetY: 0}},
                fill: {type: "solid"},
                markers: {size: 4, opacity: .7, strokeColor: "#fff", strokeWidth: 3, hover: {size: 7}},
                grid: {borderColor: SiteStyle.colors.gray[300], strokeDashArray: 5},
                dataLabels: {enabled: !1}
            }, a1 = (e1.data().dataset, e1.data().labels, e1.data().color), n1 = e1.data().height;
            e1.data().type, t1.colors = [SiteStyle.colors.theme[a1]], t1.markers.colors = [SiteStyle.colors.theme[a1]], t1.chart.height = n1 || 350;
            var o1 = new ApexCharts(e1[0], t1);

            setTimeout(function () {
                i.render()
                o1.render()
            }, 300);
        </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/product/taskgo-saas/main_file/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>