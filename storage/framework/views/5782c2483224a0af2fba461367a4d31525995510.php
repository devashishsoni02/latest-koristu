
<?php echo e(Form::model($project, array('route' => array('projects.update', $project->id), 'method' => 'PUT','enctype'=>'multipart/form-data'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('projectname', __('Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('name', null, array('class' => 'form-control','required'=>'required','id'=>"projectname",'placeholder'=> __('Project Name')))); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('description', __('Description'),['class'=>'form-label'])); ?>

            <?php echo e(Form::textarea('description', null, array('class' => 'form-control','rows'=>3,'required'=>'required','id'=>"description",'placeholder'=> __('Add Description')))); ?>

        </div>
        <div class="form-group col-md-6">

            <?php echo e(Form::label('status', __('Status'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('status', ['Ongoing'=>__('Ongoing'),'Finished'=>__('Finished'),'OnHold'=>__('OnHold')],null, array('class' => 'form-control','id'=>'status'))); ?>

        </div>

        <div class="form-group col-md-6">
            <?php echo e(Form::label('budget', __('Budget'),['class'=>'form-label'])); ?>

            <div class="input-group mb-3">
                <span class="input-group-text"><?php echo e(company_setting('defult_currancy')); ?></span>
                <?php echo e(Form::number('budget', null, array('class' => 'form-control currency_input','required'=>'required','id'=>"budget",'placeholder'=> __('Project Budget')))); ?>

            </div>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('start_date', __('Start Date'),['class'=>'form-label'])); ?>

            <div class="input-group date ">
                <?php echo e(Form::date('start_date', null, array('class' => 'form-control','required'=>'required','id'=>"start_date"))); ?>

            </div>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('end_date', __('End Date'),['class'=>'form-label'])); ?>

            <div class="input-group date ">
                <?php echo e(Form::date('end_date', null, array('class' => 'form-control','required'=>'required','id'=>"end_date"))); ?>

            </div>
        </div>
        <?php if(module_is_active('CustomField') && !$customFields->isEmpty()): ?>
            <div class="col-md-12">
                <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                    <?php echo $__env->make('customfield::formBuilder',['fildedata' => $project->customField], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>              
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
    <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>




<?php /**PATH /opt/lampp/htdocs/Koristu-latest/Modules/Taskly/Resources/views/projects/edit.blade.php ENDPATH**/ ?>