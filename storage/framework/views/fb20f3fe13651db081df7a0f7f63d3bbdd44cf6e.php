<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Proposal')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Proposal')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-action'); ?>
    <div>
        <?php echo $__env->yieldPushContent('addButtonHook'); ?>
        <?php if(module_is_active('ProductService')): ?>
            <a href="<?php echo e(route('category.index')); ?>"data-size="md"  class="btn btn-sm btn-primary" data-bs-toggle="tooltip"data-title="<?php echo e(__('Setup')); ?>" title="<?php echo e(__('Setup')); ?>"><i class="ti ti-settings"></i></a>
        <?php endif; ?>
        <?php if((module_is_active('ProductService') && module_is_active('Account')) || module_is_active('Taskly')): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('proposal manage')): ?>
                <a href="<?php echo e(route('proposal.grid.view')); ?>"  data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Grid View')); ?>" class="btn btn-sm btn-primary btn-icon">
                    <i class="ti ti-layout-grid"></i>
                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('proposal create')): ?>
                <a href="<?php echo e(route('proposal.create', 0)); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                    data-bs-original-title="<?php echo e(__('Create')); ?>">
                    <i class="ti ti-plus"></i>
                </a>
            <?php endif; ?>
        <?php endif; ?>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="mt-2" id="multiCollapseExample1">
            <div class="card">
                <div class="card-body">
                    <?php echo e(Form::open(['route' => ['proposal.index'], 'method' => 'GET', 'id' => 'frm_submit'])); ?>

                        <div class="row d-flex align-items-center justify-content-end">
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mr-2">
                                <div class="btn-box">
                                    <?php echo e(Form::label('issue_date', __('Date'), ['class' => 'text-type'])); ?>

                                    <?php echo e(Form::text('issue_date', isset($_GET['issue_date']) ? $_GET['issue_date'] : null, ['class' => 'form-control flatpickr-to-input','placeholder' => 'Select Date'])); ?>

                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mr-2">
                                <?php if(\Auth::user()->type != 'Client'): ?>
                                    <div class="btn-box">
                                        <?php echo e(Form::label('customer', __('Customer'), ['class' => 'text-type'])); ?>

                                        <?php echo e(Form::select('customer', $customer, isset($_GET['customer']) ? $_GET['customer'] : '', ['class' => 'form-control', 'placeholder' => 'Select Client'])); ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mr-2">
                                <div class="btn-box">
                                    <?php echo e(Form::label('status', __('Status'), ['class' => 'text-type'])); ?>

                                    <?php echo e(Form::select('status', ['' => 'Select Status'] + $status, isset($_GET['status']) ? $_GET['status'] : '', ['class' => 'form-control'])); ?>

                                </div>
                            </div>
                            <div class="col-auto float-end ms-2 mt-4">
                                <a href="#" class="btn btn-sm btn-primary"
                                    onclick="document.getElementById('frm_submit').submit(); return false;"
                                    data-bs-toggle="tooltip" title="<?php echo e(__('Apply')); ?>"
                                    data-original-title="<?php echo e(__('apply')); ?>">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="<?php echo e(route('proposal.index')); ?>" class="btn btn-sm btn-danger "
                                    data-bs-toggle="tooltip" title="<?php echo e(__('Reset')); ?>"
                                    data-original-title="<?php echo e(__('Reset')); ?>">
                                    <span class="btn-inner--icon"><i class="ti ti-trash-off text-white-off "></i></span>
                                </a>
                            </div>
                        </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0 pc-dt-simple" id="assets">
                            <thead>
                                <tr>
                                    <th> <?php echo e(__('Proposal')); ?></th>
                                    <?php if(\Auth::user()->type != 'Client'): ?>
                                        <th> <?php echo e(__('Customer')); ?></th>
                                    <?php endif; ?>
                                    <th> <?php echo e(__('Issue Date')); ?></th>
                                    <th> <?php echo e(__('Status')); ?></th>
                                    <?php if(Gate::check('proposal edit') || Gate::check('proposal delete') || Gate::check('proposal show')): ?>
                                        <th width="10%"> <?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $proposals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proposal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="font-style">
                                        <td class="Id">
                                            <a href="<?php echo e(route('proposal.show', \Crypt::encrypt($proposal->id))); ?>"
                                                class="btn btn-outline-primary"><?php echo e(\App\Models\Proposal::proposalNumberFormat($proposal->proposal_id)); ?>

                                            </a>
                                        </td>
                                        <?php if(\Auth::user()->type != 'Client'): ?>
                                            <td> <?php echo e(!empty($proposal->customer) ? $proposal->customer->name : ''); ?> </td>
                                        <?php endif; ?>
                                        <td><?php echo e(company_date_formate($proposal->issue_date)); ?></td>
                                        <td>
                                            <?php if($proposal->status == 0): ?>
                                                <span
                                                    class="badge fix_badge bg-primary p-2 px-3 rounded"><?php echo e(__(\App\Models\Proposal::$statues[$proposal->status])); ?></span>
                                            <?php elseif($proposal->status == 1): ?>
                                                <span
                                                    class="badge fix_badge bg-info p-2 px-3 rounded"><?php echo e(__(\App\Models\Proposal::$statues[$proposal->status])); ?></span>
                                            <?php elseif($proposal->status == 2): ?>
                                                <span
                                                    class="badge fix_badge bg-secondary p-2 px-3 rounded"><?php echo e(__(\App\Models\Proposal::$statues[$proposal->status])); ?></span>
                                            <?php elseif($proposal->status == 3): ?>
                                                <span
                                                    class="badge fix_badge bg-warning p-2 px-3 rounded"><?php echo e(__(\App\Models\Proposal::$statues[$proposal->status])); ?></span>
                                            <?php elseif($proposal->status == 4): ?>
                                                <span
                                                    class="badge fix_badge bg-danger p-2 px-3 rounded"><?php echo e(__(\App\Models\Proposal::$statues[$proposal->status])); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <?php if(Gate::check('proposal edit') || Gate::check('proposal delete') || Gate::check('proposal show')): ?>
                                            <td class="Action">
                                                <span>
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="#" class="btn btn-sm  align-items-center cp_link" data-link="<?php echo e(route('pay.proposalpay',\Illuminate\Support\Facades\Crypt::encrypt($proposal->id))); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Copy')); ?>" data-original-title="<?php echo e(__('Click to copy proposal link')); ?>">
                                                            <i class="ti ti-file text-white"></i>
                                                        </a>
                                                    </div>
                                                    <?php if($proposal->is_convert == 0 && $proposal->is_convert_retainer ==0): ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('proposal convert invoice')): ?>
                                                            <div class="action-btn bg-success ms-2">
                                                                <?php echo Form::open([
                                                                    'method' => 'get',
                                                                    'route' => ['proposal.convert', $proposal->id],
                                                                    'id' => 'proposal-form-' . $proposal->id,
                                                                ]); ?>

                                                                <a href="#"
                                                                    class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm"
                                                                    data-bs-toggle="tooltip" title=""
                                                                    data-bs-original-title="<?php echo e(__('Convert to Invoice')); ?>"
                                                                    aria-label="Delete"
                                                                    data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                                    data-confirm-yes="proposal-form-<?php echo e($proposal->id); ?>">
                                                                    <i class="ti ti-exchange text-white"></i>
                                                                </a>
                                                                <?php echo e(Form::close()); ?>

                                                            </div>
                                                        <?php endif; ?>
                                                    <?php elseif($proposal->is_convert ==1): ?>

                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('invoice show')): ?>
                                                            <div class="action-btn bg-success ms-2">
                                                                <a href="<?php echo e(route('invoice.show', \Crypt::encrypt($proposal->converted_invoice_id))); ?>"
                                                                    class="mx-3 btn btn-sm  align-items-center"
                                                                    data-bs-toggle="tooltip"
                                                                    title="<?php echo e(__('Already convert to Invoice')); ?>">
                                                                    <i class="ti ti-eye text-white"></i>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php if(module_is_active('Retainer')): ?>
                                                        <?php echo $__env->make('retainer::setting.convert_retainer', ['proposal' => $proposal ,'type' =>'list'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('proposal duplicate')): ?>
                                                        <div class="action-btn bg-secondary ms-2">
                                                            <?php echo Form::open([
                                                                'method' => 'get',
                                                                'route' => ['proposal.duplicate', $proposal->id],
                                                                'id' => 'duplicate-form-' . $proposal->id,
                                                            ]); ?>

                                                            <a href="#"
                                                                class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm"
                                                                data-bs-toggle="tooltip" title=""
                                                                data-bs-original-title="<?php echo e(__('Duplicate')); ?>"
                                                                aria-label="Delete"
                                                                data-text="<?php echo e(__('You want to confirm duplicate this proposal. Press Yes to continue or Cancel to go back')); ?>"
                                                                data-confirm-yes="duplicate-form-<?php echo e($proposal->id); ?>">
                                                                <i class="ti ti-copy text-white text-white"></i>
                                                            </a>
                                                            <?php echo e(Form::close()); ?>

                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('proposal show')): ?>
                                                        <div class="action-btn bg-warning ms-2">
                                                            <a href="<?php echo e(route('proposal.show', \Crypt::encrypt($proposal->id))); ?>"
                                                                class="mx-3 btn btn-sm  align-items-center"
                                                                data-bs-toggle="tooltip" title="<?php echo e(__('Show')); ?>"
                                                                data-original-title="<?php echo e(__('Detail')); ?>">
                                                                <i class="ti ti-eye text-white text-white"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if(module_is_active('ProductService') && ( ($proposal->proposal_module == 'taskly') ? module_is_active('Taskly') :  module_is_active('Account'))): ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('proposal edit')): ?>
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="<?php echo e(route('proposal.edit', \Crypt::encrypt($proposal->id))); ?>"
                                                                    class="mx-3 btn btn-sm  align-items-center"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-original-title="<?php echo e(__('Edit')); ?>">
                                                                    <i class="ti ti-pencil text-white"></i>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('proposal delete')): ?>
                                                        <div class="action-btn bg-danger ms-2">
                                                            <?php echo e(Form::open(['route' => ['proposal.destroy', $proposal->id], 'class' => 'm-0'])); ?>

                                                            <?php echo method_field('DELETE'); ?>
                                                            <a href="#"
                                                                class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm"
                                                                data-bs-toggle="tooltip" title=""
                                                                data-bs-original-title="Delete" aria-label="Delete"
                                                                data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                                data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                                data-confirm-yes="delete-form-<?php echo e($proposal->id); ?>"><i
                                                                    class="ti ti-trash text-white text-white"></i></a>
                                                            <?php echo e(Form::close()); ?>

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
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).on("click",".cp_link",function() {
            var value = $(this).attr('data-link');
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val(value).select();
                document.execCommand("copy");
                $temp.remove();
                toastrs('success', '<?php echo e(__('Link Copy on Clipboard')); ?>', 'success')
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Koristu-latest/resources/views/proposal/index.blade.php ENDPATH**/ ?>