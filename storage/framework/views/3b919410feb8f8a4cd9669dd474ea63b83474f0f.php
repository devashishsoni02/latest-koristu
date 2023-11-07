<?php if($project && $currentWorkspace): ?>
<?php echo e(Form::open(array('route' => array('projects.milestone.store', $project->id)))); ?>

    <div class="modal-body">
        <div class="text-end">
            <?php if(module_is_active('AIAssistant')): ?>
                <?php echo $__env->make('aiassistant::ai.generate_ai_btn',['template_module' => 'milestone','module'=>'Taskly'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <?php echo e(Form::label('milestone-title', __('Milestone Title'),['class'=>'form-label'])); ?>

                    <?php echo e(Form::text('title', null, array('class' => 'form-control','required'=>'required','id'=>"milestone-title",'placeholder'=> __('Enter Title')))); ?>

                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <?php echo e(Form::label('milestone-status', __('Status'),['class'=>'form-label'])); ?>

                    <?php echo e(Form::select('status', ['incomplete'=>__('Incomplete'),'complete'=>__('Complete')],null, array('class' => 'form-control','id'=>'status'))); ?>

                </div>
            </div>
        </div>


        <div class="form-group">
            <?php echo e(Form::label('budget', __('Milestone Cost'),['class'=>'form-label'])); ?>

            <div class="input-group mb-3">
                <span class="input-group-text"><?php echo e((!empty($currentWorkspace->currency)) ? $currentWorkspace->currency : '$'); ?></span>
                <?php echo e(Form::number('cost', null, array('class' => 'form-control currency_input','required'=>'required','id'=>"budget",'placeholder'=> __('Enter Cost'),"min"=>0))); ?>

            </div>
        </div>
        <div class="form-group">
            <?php echo e(Form::label('task-summary', __('Summary'),['class'=>'form-label'])); ?>

            <?php echo e(Form::textarea('summary', null, array('class' => 'form-control','required'=>'required','rows'=>3,'id'=>"milestone-title",'placeholder'=> __('Enter Title')))); ?>

        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
        <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn  btn-primary">
    </div>

<?php echo e(Form::close()); ?>



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
<?php /**PATH /opt/lampp/htdocs/Koristu-latest/Modules/Taskly/Resources/views/projects/milestone.blade.php ENDPATH**/ ?>