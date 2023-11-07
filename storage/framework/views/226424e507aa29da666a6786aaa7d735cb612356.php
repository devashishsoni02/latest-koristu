<?php echo e(Form::open(['url' => 'leads', 'enctype' => 'multipart/form-data'])); ?>

<div class="modal-body">
    <div class="text-end">
        <?php if(module_is_active('AIAssistant')): ?>
            <?php echo $__env->make('aiassistant::ai.generate_ai_btn', ['template_module' => 'lead', 'module' => 'Lead'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>
    <?php if(module_is_active('CustomField') && !$customFields->isEmpty()): ?>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#tab-1" role="tab"
                    aria-controls="pills-home" aria-selected="true"><?php echo e(__('Lead Detail')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#tab-2" role="tab"
                    aria-controls="pills-profile" aria-selected="false"><?php echo e(__('Custom Fields')); ?></a>
            </li>
        </ul>
    <?php endif; ?>
    <div class="tab-content tab-bordered">
        <div class="tab-pane fade show active" id="tab-1" role="tabpanel">
            <div class="row">
                <div class="col-6 form-group">
                    <?php echo e(Form::label('subject', __('Subject'), ['class' => 'col-form-label'])); ?>

                    <?php echo e(Form::text('subject', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                </div>

                <div class="col-6 form-group">
                    <?php echo e(Form::label('user_id', __('User'), ['class' => 'col-form-label'])); ?>

                    <?php echo e(Form::select('user_id', $users, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

                    <?php if(count($users) == 1): ?>
                        <div class="text-muted text-xs">
                            <?php echo e(__('Please create new users')); ?> <a href="<?php echo e(route('users')); ?>"><?php echo e(__('here')); ?></a>.
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-6 form-group">
                    <?php echo e(Form::label('name', __('Name'), ['class' => 'col-form-label'])); ?>

                    <?php echo e(Form::text('name', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                </div>
                <div class="col-6 form-group">
                    <?php echo e(Form::label('email', __('Email'), ['class' => 'col-form-label'])); ?>

                    <?php echo e(Form::text('email', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                </div>
                <div class="col-6 form-group">
                    <?php echo e(Form::label('phone', __('Phone No'), ['class' => 'col-form-label'])); ?>

                    <?php echo e(Form::text('phone', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                </div>

                <!-- CODE FOR COUNTRY DROPDOWNS ADDED BY HEMANT -->

                <div class="col-6 form-group">
                    <?php echo e(Form::label('countries', __('Country'), ['class' => 'col-form-label'])); ?>

                    <?php echo e(Form::select('countries', $countries, null, ['class' => 'form-control countries', 'required' => 'required'])); ?>

                </div>
                <div class="col-6 form-group">
                    <?php echo e(Form::label('source', __('Source'), ['class' => 'col-form-label'])); ?>

                    <?php echo e(Form::select('source', $source, null, ['class' => 'form-control ', 'required' => 'required'])); ?>

                </div>

            </div>
        </div>
        <?php if(module_is_active('CustomField') && !$customFields->isEmpty()): ?>
            <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                <div class="col-md-6">
                    <?php echo $__env->make('customfield::formBuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
    <button type="submit" class="btn  btn-primary"><?php echo e(__('Create')); ?></button>
</div>

<?php echo e(Form::close()); ?>

<?php /**PATH /opt/lampp/htdocs/Koristu-latest/Modules/Lead/Resources/views/leads/create.blade.php ENDPATH**/ ?>