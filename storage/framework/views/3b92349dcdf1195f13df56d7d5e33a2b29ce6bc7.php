<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Order')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Order')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable pc-dt-simple" id="test">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Order Id')); ?></th>
                                <th><?php echo e(__('Date')); ?></th>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Plan Name')); ?></th>
                                <th><?php echo e(__('Price')); ?></th>
                                <th><?php echo e(__('Payment Type')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('Coupon')); ?></th>
                                <th class="text-center"><?php echo e(__('Invoice')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($order->order_id); ?></td>
                                    <td><?php echo e(company_datetime_formate($order->created_at)); ?></td>
                                    <td><?php echo e($order->user_name); ?></td>
                                    <td><?php echo e($order->plan_name); ?></td>
                                    <td><?php echo e($order->price.' '.$order->price_currency); ?></td>
                                    <td><?php echo e($order->payment_type); ?></td>
                                    <td>
                                        <?php if($order->payment_status == 'succeeded'): ?>
                                            <span class="bg-success p-1 px-3 rounded text-white"><?php echo e(ucfirst($order->payment_status)); ?></span>
                                        <?php else: ?>
                                            <span class="bg-danger p-2 px-3 rounded text-white"><?php echo e(ucfirst($order->payment_status)); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <?php if(module_is_active('Coupons')): ?>
                                        <td><?php echo e(!empty($order->total_coupon_used)? !empty($order->total_coupon_used->coupon_detail)?$order->total_coupon_used->coupon_detail->code:'-':'-'); ?></td>
                                    <?php else: ?>
                                    <td>-</td>
                                    <?php endif; ?>

                                    <td class="text-center">
                                        <?php if($order->receipt != 'free coupon' && $order->payment_type == 'STRIPE'): ?>
                                            <a href="<?php echo e($order->receipt); ?>" data-bs-toggle="tooltip"  data-bs-original-title="<?php echo e(__('Invoice')); ?>" target="_blank" class="">
                                                <i class="ti ti-file-invoice"></i>
                                            </a>
                                        <?php elseif($order->payment_type == 'Bank Transfer'): ?>
                                            <a href="<?php echo e(!empty($order->receipt) ? (check_file($order->receipt)) ? get_file($order->receipt) : '#!' : '#!'); ?>" data-bs-toggle="tooltip"  data-bs-original-title="<?php echo e(__('Invoice')); ?>" target="_blank" class="">
                                                <i class="ti ti-file-invoice"></i>
                                            </a>
                                        <?php elseif($order->receipt == 'free coupon'): ?>
                                            <p><?php echo e(__('Used 100 % discount coupon code.')); ?></p>
                                        <?php elseif($order->payment_type == 'Manually'): ?>
                                            <p><?php echo e(__('Manually plan upgraded by super admin')); ?></p>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
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

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Koristu-latest/resources/views/plan_order/index.blade.php ENDPATH**/ ?>