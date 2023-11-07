<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tax manage')): ?>
    <div id="tax-settings" class="">
        <div class="">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-11">
                                <h5 class="">
                                    <?php echo e(__('Tax')); ?>

                                </h5>
                            </div>
                            <div class="col-1 text-end">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tax create')): ?>
                                    <div class="float-end">
                                        <a  data-url="<?php echo e(route('tax.create')); ?>" data-ajax-popup="true"
                                            data-title="<?php echo e(__('Create Tax Rate')); ?>" data-bs-toggle="tooltip"
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
                                <tr>
                                    <th> <?php echo e(__('Tax Name')); ?></th>
                                    <th> <?php echo e(__('Rate %')); ?></th>
                                    <?php if(Gate::check('tax edit') || Gate::check('tax delete')): ?>
                                        <th width="10%"> <?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="font-style">
                                        <td><?php echo e($taxe->name); ?></td>
                                        <td><?php echo e($taxe->rate); ?></td>
                                        <?php if(Gate::check('tax edit') || Gate::check('tax delete')): ?>
                                            <td class="Action">
                                                <span>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tax edit')): ?>
                                                        <div class="action-btn bg-info ms-2">
                                                            <a  class="mx-3 btn btn-sm align-items-center"
                                                                data-url="<?php echo e(route('tax.edit', $taxe->id)); ?>"
                                                                data-ajax-popup="true" data-title="<?php echo e(__('Edit Tax Rate')); ?>"
                                                                data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>"
                                                                data-original-title="<?php echo e(__('Edit')); ?>">
                                                                <i class="ti ti-pencil text-white"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tax delete')): ?>
                                                        <div class="action-btn bg-danger ms-2">
                                                            <?php echo Form::open([
                                                                'method' => 'DELETE',
                                                                'route' => ['tax.destroy', $taxe->id],
                                                                'id' => 'delete-form-' . $taxe->id,
                                                            ]); ?>

                                                            <a
                                                                class="mx-3 btn btn-sm align-items-center bs-pass-para show_confirm"
                                                                data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"
                                                                data-original-title="<?php echo e(__('Delete')); ?>"
                                                                data-confirm="<?php echo e(__('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?')); ?>"
                                                                data-confirm-yes="document.getElementById('delete-form-<?php echo e($taxe->id); ?>').submit();">
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
<?php /**PATH /opt/lampp/htdocs/Koristu-latest/Modules/ProductService/Resources/views/taxes/sidenav_div.blade.php ENDPATH**/ ?>