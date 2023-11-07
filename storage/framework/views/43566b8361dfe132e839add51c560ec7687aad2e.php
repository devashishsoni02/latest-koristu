<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('unit manage')): ?>
    <div id="unit-settings" class="">
        <div class="">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-11">
                                <h5 class="">
                                    <?php echo e(__('Unit')); ?>

                                </h5>
                            </div>
                            <div class="col-1 text-end">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('unit cerate')): ?>
                                    <div class="float-end">
                                        <a  data-url="<?php echo e(route('units.create')); ?>" data-ajax-popup="true"
                                            data-title="<?php echo e(__('Create New Unit')); ?>" data-bs-toggle="tooltip"
                                            title="<?php echo e(__('Create')); ?>" class="btn btn-sm btn-primary">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table mb-0 pc-dt-simple" id="category">
                            <thead>
                                <tr>
                                    <th> <?php echo e(__('Unit')); ?></th>
                                    <?php if(Gate::check('unit edit') || Gate::check('unit delete')): ?>
                                        <th width="10%"> <?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($unit->name); ?></td>
                                        <?php if(Gate::check('unit edit') || Gate::check('unit delete')): ?>
                                            <td class="Action">
                                                <span>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('unit edit')): ?>
                                                        <div class="action-btn bg-info ms-2">
                                                            <a  class="mx-3 btn btn-sm align-items-center"
                                                                data-url="<?php echo e(route('units.edit', $unit->id)); ?>"
                                                                data-ajax-popup="true" title="<?php echo e(__('Edit')); ?>"
                                                                data-bs-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                                <i class="ti ti-pencil text-white"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('unit delete')): ?>
                                                        <div class="action-btn bg-danger ms-2">

                                                            <?php echo Form::open([
                                                                'method' => 'DELETE',
                                                                'route' => ['units.destroy', $unit->id],
                                                                'id' => 'delete-form-' . $unit->id,
                                                            ]); ?>

                                                            <a
                                                                class="mx-3 btn btn-sm align-items-center bs-pass-para show_confirm"
                                                                data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>"
                                                                data-confirm="<?php echo e(__('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?')); ?>"
                                                                data-confirm-yes="document.getElementById('delete-form-<?php echo e($unit->id); ?>').submit();">
                                                                <i class="ti ti-trash text-white"></i>
                                                            </a>
                                                            <?php echo Form::close(); ?>

                                                        </div>
                                                    <?php endif; ?>
                                                </span>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        })
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /opt/lampp/htdocs/Koristu-latest/Modules/ProductService/Resources/views/units/sidenav_div.blade.php ENDPATH**/ ?>