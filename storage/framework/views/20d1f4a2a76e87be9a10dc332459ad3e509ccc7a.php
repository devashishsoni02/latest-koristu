<?php if($project && $currentWorkspace): ?>
    <form class="" method="post" action="<?php echo e(route('tasks.store', [$project->id])); ?>">
        <?php echo csrf_field(); ?>
        <div class="modal-body">
            <div class="text-end">
                <?php if(module_is_active('AIAssistant')): ?>
                    <?php echo $__env->make('aiassistant::ai.generate_ai_btn', [
                        'template_module' => 'project task',
                        'module' => 'Taskly',
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="form-group col-md-8">
                    <label class="col-form-label"><?php echo e(__('Project')); ?></label>
                    <select class="form-control form-control-light select2" name="project_id" required>

                        <option value="<?php echo e($project->id); ?>"><?php echo e($project->name); ?></option>

                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label class="col-form-label"><?php echo e(__('Milestone')); ?></label>
                    <select class="form-control form-control-light select2" name="milestone_id" id="task-milestone">
                        <option value=""><?php echo e(__('Select Milestone')); ?></option>
                        <?php $__currentLoopData = $project->milestones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $milestone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($milestone->id); ?>"><?php echo e($milestone->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="form-group col-md-8">
                    <label class="col-form-label"><?php echo e(__('Title')); ?></label>
                    <input type="text" class="form-control form-control-light" id="task-title"
                        placeholder="<?php echo e(__('Enter Title')); ?>" name="title" required>
                </div>
                <div class="form-group col-md-4">
                    <label class="col-form-label"><?php echo e(__('Priority')); ?></label>
                    <select class="form-control form-control-light" name="priority" id="task-priority" required>
                        <option value="Low"><?php echo e(__('Low')); ?></option>
                        <option value="Medium"><?php echo e(__('Medium')); ?></option>
                        <option value="High"><?php echo e(__('High')); ?></option>
                    </select>
                </div>





                <div class="form-group col-md-12">
                    <label class="col-form-label"><?php echo e(__('Assign To')); ?></label>

                    <select class=" multi-select choices" id="assign_to" name="assign_to[]" multiple="multiple"
                        data-placeholder="<?php echo e(__('Select Users ...')); ?>" required>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($u->id); ?>"><?php echo e($u->name); ?> - <?php echo e($u->email); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </select>
                    <p class="text-danger d-none" id="user_validation"><?php echo e(__('Assign To filed is required.')); ?></p>
                </div>




                <div class="form-group col-md-6">
                    <label class="col-form-label"><?php echo e(__('Select Days')); ?></label>

                    <select class=" multi-select choices" id="days" name="days[]" multiple="multiple"
                        data-placeholder="<?php echo e(__('Select Days ...')); ?>" required>
                        <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $days): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($days->id); ?>"><?php echo e($days->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <p class="text-danger d-none" id="user_validation"><?php echo e(__('Assign To filed is required.')); ?></p>
                </div>


                <div class="form-group col-md-6">
                    <label class="col-form-label"><?php echo e(__('Select Months')); ?></label>

                    <select class=" multi-select choices" id="months" name="months[]" multiple="multiple"
                        data-placeholder="<?php echo e(__('Select Month ...')); ?>" required>
                        <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $months): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($months->id); ?>"><?php echo e($months->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <p class="text-danger d-none" id="user_validation"><?php echo e(__('Assign To filed is required.')); ?></p>
                </div>
                <div class="form-group col-md-12">
                    <label class="col-form-label"><?php echo e(__('Select Dates')); ?></label>

                    <select class=" multi-select choices" id="dates" name="dates[]" multiple="multiple"
                        data-placeholder="<?php echo e(__('Select Dates ...')); ?>" required>
                        <?php $__currentLoopData = $dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($d->id); ?>"><?php echo e($d->date); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <p class="text-danger d-none" id="user_validation"><?php echo e(__('Assign To filed is required.')); ?></p>
                </div>

                
                
                
             

                <div class="col-md-6">

                    <label class="col-form-label"><?php echo e(__('Duration')); ?></label>
                    <div class='input-group form-group'>
                        <input type='text' class=" form-control form-control-light" id="duration" name="duration"
                            required autocomplete="off" placeholder="Select date range" />
                        <input type="hidden" name="start_date">
                        <input type="hidden" name="due_date">
                        <span class="input-group-text"><i class="feather icon-calendar"></i></span>
                    </div>
                </div>


                
                <div class="form-group col-md-12">
                    <label class="col-form-label"><?php echo e(__('Description')); ?></label>
                    <textarea class="form-control form-control-light" id="task-description" rows="3" name="description" required></textarea>
                </div>
            </div>
            <?php if(module_is_active('CustomField') && !$customFields->isEmpty()): ?>
                <div class="col-md-12">
                    <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                        <?php echo $__env->make('customfield::formBuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(module_is_active('Calender') && company_setting('google_calendar_enable') == 'on'): ?>
                <?php echo $__env->make('calender::setting.synchronize', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
            <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn  btn-primary" id="submit">
        </div>

    </form>
    <link rel="stylesheet"
        href="<?php echo e(Module::asset('Taskly:Resources/assets/libs/bootstrap-daterangepicker/daterangepicker.css')); ?> ">

    <script src="<?php echo e(Module::asset('Taskly:Resources/assets/libs/moment/min/moment.min.js')); ?>"></script>
    <script src="<?php echo e(Module::asset('Taskly:Resources/assets/libs/bootstrap-daterangepicker/daterangepicker.js')); ?>">
    </script>

    <script>
        $(function() {
            var start = moment('<?php echo e(date('Y-m-d')); ?>', 'YYYY-MM-DD HH:mm:ss');
            var end = moment('<?php echo e(date('Y-m-d')); ?>', 'YYYY-MM-DD HH:mm:ss');

            function cb(start, end) {
                $("form #duration").val(start.format('MMM D, YY hh:mm A') + ' - ' + end.format(
                'MMM D, YY hh:mm A'));
                $('form input[name="start_date"]').val(start.format('YYYY-MM-DD HH:mm:ss'));
                $('form input[name="due_date"]').val(end.format('YYYY-MM-DD HH:mm:ss'));
            }

            $('form #duration').daterangepicker({
                autoApply: true,
                timePicker: true,
                autoUpdateInput: false,
                startDate: start,
                endDate: end,
                locale: {
                    format: 'MMMM D, YYYY hh:mm A',
                    applyLabel: "<?php echo e(__('Apply')); ?>",
                    cancelLabel: "<?php echo e(__('Cancel')); ?>",
                    fromLabel: "<?php echo e(__('From')); ?>",
                    toLabel: "<?php echo e(__('To')); ?>",
                    daysOfWeek: [
                        "<?php echo e(__('Sun')); ?>",
                        "<?php echo e(__('Mon')); ?>",
                        "<?php echo e(__('Tue')); ?>",
                        "<?php echo e(__('Wed')); ?>",
                        "<?php echo e(__('Thu')); ?>",
                        "<?php echo e(__('Fri')); ?>",
                        "<?php echo e(__('Sat')); ?>"
                    ],
                    monthNames: [
                        "<?php echo e(__('January')); ?>",
                        "<?php echo e(__('February')); ?>",
                        "<?php echo e(__('March')); ?>",
                        "<?php echo e(__('April')); ?>",
                        "<?php echo e(__('May')); ?>",
                        "<?php echo e(__('June')); ?>",
                        "<?php echo e(__('July')); ?>",
                        "<?php echo e(__('August')); ?>",
                        "<?php echo e(__('September')); ?>",
                        "<?php echo e(__('October')); ?>",
                        "<?php echo e(__('November')); ?>",
                        "<?php echo e(__('December')); ?>"
                    ],
                }
            }, cb);

            cb(start, end);
        });
        $(document).on('change', "select[name=project_id]", function() {
            $.get('<?php if(auth()->guard('web')->check()): ?><?php echo e(route('home')); ?><?php elseif(auth()->guard()->check()): ?><?php echo e(route('client.home')); ?><?php endif; ?>' +
                '/userProjectJson/' + $(this).val(),
                function(data) {
                    $('select[name=assign_to]').html('');
                    data = JSON.parse(data);
                    $(data).each(function(i, d) {
                        $('select[name=assign_to]').append('<option value="' + d.id + '">' + d.name +
                            ' - ' + d.email + '</option>');
                    });
                });
            $.get('<?php if(auth()->guard('web')->check()): ?><?php echo e(route('home')); ?><?php elseif(auth()->guard()->check()): ?><?php echo e(route('client.home')); ?><?php endif; ?>' +
                '/projectMilestoneJson/' + $(this).val(),
                function(data) {
                    $('select[name=milestone_id]').html(
                        '<option value=""><?php echo e(__('Select Milestone')); ?></option>');
                    data = JSON.parse(data);
                    $(data).each(function(i, d) {
                        $('select[name=milestone_id]').append('<option value="' + d.id + '">' + d
                            .title + '</option>');
                    });
                })
        })
    </script>
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


<script>
    $(function() {
        $("#submit").click(function() {
            var user = $("#assign_to option:selected").length;
            if (user == 0) {
                $('#user_validation').removeClass('d-none')
                return false;
            } else {
                $('#user_validation').addClass('d-none')
            }
        });
    });
</script>
<?php /**PATH /opt/lampp/htdocs/Koristu-latest/Modules/Taskly/Resources/views/projects/taskCreate.blade.php ENDPATH**/ ?>