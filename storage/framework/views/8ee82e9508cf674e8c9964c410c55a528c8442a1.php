<?php echo e(Form::open(array('url' => 'team_tasks','method' =>'post'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-8">
            <?php echo e(Form::label('title',__('Title'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('title',null,array('class'=>'form-control font-style','required'=>'required'))); ?>

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
            <?php echo e(Form::label('description',__('Description'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('description',null,array('class'=>'form-control font-style','required'=>'required'))); ?>

        </div>

        <div class="form-group col-md-12">
            <label class="col-form-label"><?php echo e(__('Select Days')); ?></label>

            <select class=" multi-select choices" id="days" name="days[]" multiple="multiple"
                data-placeholder="<?php echo e(__('Select Days ...')); ?>" required>
                <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $days): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($days->id); ?>"><?php echo e($days->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <p class="text-danger d-none" id="user_validation"><?php echo e(__('Assign To filed is required.')); ?></p>
        </div>


        <div class="form-group col-md-12">
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

        <div class="col-md-12">
            <label class="col-form-label"><?php echo e(__('Duration')); ?></label>
            <div class='input-group form-group'>
                <input type='text' class=" form-control form-control-light" id="duration" name="duration"
                    required autocomplete="off" placeholder="Select date range" />
                <input type="hidden" name="start_date">
                <input type="hidden" name="due_date">
                <span class="input-group-text"><i class="feather icon-calendar"></i></span>
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
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>



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

</script>
<?php /**PATH /opt/lampp/htdocs/Koristu-latest/resources/views/team_tasks/create.blade.php ENDPATH**/ ?>