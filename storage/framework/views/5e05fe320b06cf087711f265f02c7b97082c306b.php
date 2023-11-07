<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Leads')); ?> <?php if($pipeline): ?> - <?php echo e($pipeline->name); ?> <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/dragula.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('page-breadcrumb'); ?>
 <?php echo e(__('Leads')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check("lead move")): ?>
        <?php if($pipeline): ?>
        <script src="<?php echo e(asset('assets/js/plugins/dragula.min.js')); ?>"></script>
            <script>
                !function (a) {
                    "use strict";
                    var t = function () {
                        this.$body = a("body")
                    };
                    t.prototype.init = function () {
                        a('[data-plugin="dragula"]').each(function () {
                            var t = a(this).data("containers"), n = [];
                            if (t) for (var i = 0; i < t.length; i++) n.push(a("#" + t[i])[0]); else n = [a(this)[0]];
                            var r = a(this).data("handleclass");
                            r ? dragula(n, {
                                moves: function (a, t, n) {
                                    return n.classList.contains(r)
                                    
                                }
                            }) : dragula(n).on('drop', function (el, target, source, sibling) {

                                var order = [];
                                $("#" + target.id + " > div").each(function () {
                                    order[$(this).index()] = $(this).attr('data-id');
                                });

                                var id = $(el).attr('data-id');

                                var old_status = $("#" + source.id).data('status');
                                var new_status = $("#" + target.id).data('status');
                                var stage_id = $(target).attr('data-id');
                                var pipeline_id = '<?php echo e($pipeline->id); ?>';

                                $("#" + source.id).parent().find('.count').text($("#" + source.id + " > div").length);
                                $("#" + target.id).parent().find('.count').text($("#" + target.id + " > div").length);
                                $.ajax({
                                    url: '<?php echo e(route('leads.order')); ?>',
                                    type: 'POST',
                                    data: {lead_id: id, stage_id: stage_id, order: order, new_status: new_status, old_status: old_status, pipeline_id: pipeline_id, _token: "<?php echo e(csrf_token()); ?>"},
                                    success: function (data) {
                                        toastrs('<?php echo e(__("Success")); ?>', 'Lead Move Successfully!', 'success');
                                    },
                                    error: function (data) {
                                        data = data.responseJSON;
                                        toastrs('Error', data.error, 'error')
                                    }
                                });
                            });
                        })
                    }, a.Dragula = new t, a.Dragula.Constructor = t
                }(window.jQuery), function (a) {
                    "use strict";

                    a.Dragula.init()

                }(window.jQuery);
            </script>
        <?php endif; ?>
    <?php endif; ?>
    <script>
        $(document).on("change", "#change-pipeline select[name=default_pipeline_id]", function () {
            $('#change-pipeline').submit();
        });
    </script>


<?php $__env->stopPush(); ?>


<?php $__env->startSection('page-action'); ?>
<?php if($pipeline): ?>
<div class="col-auto">
    <?php echo e(Form::open(array('route' => 'deals.change.pipeline','id'=>'change-pipeline'))); ?>

    <?php echo e(Form::select('default_pipeline_id', $pipelines,$pipeline->id, array('class' => 'form-select custom-form-select mx-2','id'=>'default_pipeline_id'))); ?>

    <?php echo e(Form::close()); ?>

</div>
<?php endif; ?>

<div class="col-auto pe-0 pt-2 px-1">
     <?php echo $__env->yieldPushContent('addButtonHook'); ?>
</div>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('lead import')): ?>
    <div class="col-auto pe-0 pt-2 px-1">
        <a href="#"  class="btn btn-sm btn-primary" data-ajax-popup="true" data-title="<?php echo e(__('Lead Import')); ?>" data-url="<?php echo e(route('lead.file.import')); ?>"  data-toggle="tooltip" title="<?php echo e(__('Import')); ?>"><i class="ti ti-file-import"></i>
        </a>
    </div>
    <?php endif; ?>

    <div class="col-auto pe-0 pt-2 px-1">
            <a href="<?php echo e(route('leads.list')); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('List View')); ?>" class="btn btn-sm btn-primary btn-icon "><i class="ti ti-list"></i> </a>
    </div>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('lead create')): ?>
        <div class="col-auto ps-1 pt-2">
            <a class="btn btn-sm btn-primary btn-icon " data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Create Lead')); ?>" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Create Lead')); ?>" data-url="<?php echo e(route('leads.create')); ?>"><i class="ti ti-plus text-white"></i></a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if($pipeline): ?>
        <div class="row">
            <?php
                $lead_stages = $pipeline->leadStages;
                $json = [];
                foreach ($lead_stages as $lead_stage){
                    $json[] = 'task-list-'.$lead_stage->id;
                }
            ?>

            <div class="col-12">
                <div class="row kanban-wrapper horizontal-scroll-cards" data-plugin="dragula" data-containers='<?php echo json_encode($json); ?>' >
                    <?php $__currentLoopData = $lead_stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead_stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php ($leads = $lead_stage->lead()); ?>
                        <div class="col" id="progress">
                            <div class="card">
                                <div class="card-header">
                                    <div class="float-end">
                                        <button class="btn btn-sm btn-primary btn-icon count" >
                                            <?php echo e(count($leads)); ?>

                                        </button>
                                    </div>
                                    <h4 class="mb-0"><?php echo e($lead_stage->name); ?></h4>
                                </div>
                                <div id="task-list-<?php echo e($lead_stage->id); ?>" data-id="<?php echo e($lead_stage->id); ?>" class="card-body kanban-box">
                                    <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="card" data-id="<?php echo e($lead->id); ?>">
                                                <?php ($labels = $lead->labels()); ?>
                                                <div class="pt-3 ps-3">
                                                    <?php if($labels): ?>
                                                        <?php $__currentLoopData = $labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="badge bg-<?php echo e($label->color); ?> p-2 px-3 rounded"> <?php echo e($label->name); ?></div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="card-header border-0 pb-0 position-relative">
                                                    <h5><a href="<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('lead show')): ?><?php if($lead->is_active): ?><?php echo e(route('leads.show',$lead->id)); ?><?php else: ?>#<?php endif; ?> <?php else: ?>#<?php endif; ?>" class="text-primary"><?php echo e($lead->name); ?></a></h5>
                                                    <?php if(\Auth::user()->type != 'staff'): ?>
                                                    <div class="card-header-right">
                                                        <div class="btn-group card-option">
                                                            <?php if(!$lead->is_active): ?>
                                                                <div class="btn dropdown-toggle">
                                                                    <a href="#" class="action-item" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-lock"></i></a>
                                                                </div>

                                                            <?php else: ?>
                                                                <button type="button" class="btn dropdown-toggle"
                                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="ti ti-dots-vertical"></i>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('lead edit')): ?>
                                                                        <a data-url="<?php echo e(URL::to('leads/'.$lead->id.'/labels')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Labels')); ?>" class="dropdown-item"><?php echo e(__('Labels')); ?></a>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('lead edit')): ?>
                                                                        <a  data-url="<?php echo e(URL::to('leads/'.$lead->id.'/edit')); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Edit Lead')); ?>" class="dropdown-item"><?php echo e(__('Edit')); ?></a>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('lead delete')): ?>
                                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['leads.destroy', $lead->id],'id'=>'delete-form-'.$lead->id]); ?>

                                                                            <a class="dropdown-item show_confirm" >
                                                                            <?php echo e(__('Delete')); ?>

                                                                                </a>
                                                                        <?php echo Form::close(); ?>

                                                                    <?php endif; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <ul class="list-inline mb-0">
                                                            <li class="list-inline-item d-inline-flex align-items-center" data-bs-toggle="tooltip" data-bs-original-title="Product"><i class="f-16 text-primary ti ti-shopping-cart"></i><?php echo e(count($lead->products())); ?>

                                                            </li>
                                                            <li class="list-inline-item d-inline-flex align-items-center" data-bs-toggle="tooltip" data-bs-original-title="Source"><i class="f-16 text-primary ti ti-social"></i><?php echo e(count($lead->sources())); ?>

                                                            </li>
                                                        </ul>
                                                        <div class="user-group">
                                                            <?php $__currentLoopData = $lead->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <img alt="image" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e($user->name); ?>" <?php if($user->avatar): ?> src="<?php echo e(get_file($user->avatar)); ?>" <?php else: ?> src="<?php echo e(get_file('avatar.png')); ?>"  <?php endif; ?> class="rounded-circle " width="25" height="25">
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Koristu-latest/Modules/Lead/Resources/views/leads/index.blade.php ENDPATH**/ ?>