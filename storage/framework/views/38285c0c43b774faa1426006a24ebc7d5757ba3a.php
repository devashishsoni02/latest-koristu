<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/apexcharts.min.js')); ?>"></script>
    <script>
        (function () {
            var chartBarOptions = {
                series: [
                    {
                        name: '<?php echo e(__("Order")); ?>',
                        data:  <?php echo json_encode ($chartData['data']); ?>,

                    },
                ],

                chart: {
                    height: 300,
                    type: 'area',
                    dropShadow: {
                        enabled: true,
                        color: '#000',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.2
                    },
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                title: {
                    text: '',
                    align: 'left'
                },
                xaxis: {
                    categories: <?php echo json_encode($chartData['label']); ?>,
                    title: {
                        text: '<?php echo e(__("Months")); ?>'
                    }
                },
                colors: ['#6fd944', '#6fd944'],

                grid: {
                    strokeDashArray: 4,
                },
                legend: {
                    show: false,
                },
                yaxis: {
                    title: {
                        text: '<?php echo e(__("Order")); ?>'
                    },

                }

            };
            var arChart = new ApexCharts(document.querySelector("#chart-sales"), chartBarOptions);
            arChart.render();
        })();
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
    <div class="col-lg-4 col-12">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center mb-2 mt-2">
                            <div class="theme-avtar bg-primary">
                                <i class="ti ti-users"></i>
                            </div>
                            <div class="ms-3 mb-3 mt-3">
                                <h6 class="ml-4"><?php echo e(__('Total Users')); ?></h6>
                            </div>
                        </div>

                        <div class="number-icon ms-3 mb-3 mt-3"><h3><?php echo e($user->total_user); ?></h3></div>
                            <div class="ms-3 mb-3 mt-3">
                                <h6><?php echo e(__('Paid Users')); ?> : <?php echo e($user['total_paid_user']); ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-12">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center mb-2 mt-2">
                            <div class="theme-avtar bg-warning">
                                <i class="ti ti-shopping-cart"></i>
                            </div>
                            <div class="ms-3 mb-3 mt-3">
                                <h6 class="ml-4"><?php echo e(__('Total Orders')); ?></h6>
                            </div>
                        </div>

                        <div class="number-icon ms-3 mb-3 mt-3"><h3><?php echo e($user->total_orders); ?></h3></div>
                            <div class="ms-3 mb-3 mt-3">
                                <h6><?php echo e(__('Total Order Amount')); ?> : <span class="text-dark"><?php echo e(env('CURRENCY_SYMBOL')); ?><?php echo e($user['total_orders_price']); ?></span></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-12">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center mb-2 mt-2">
                            <div class="theme-avtar bg-info">
                                <i class="ti ti-trophy"></i>
                            </div>
                            <div class="ms-3 mb-3 mt-3">
                                <h6 class="ml-4"><?php echo e(__('Total Plans')); ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-12">
            <h4 class="h4 font-weight-400"><?php echo e(__('Recent Order')); ?></h4>
            <div class="card">
                <div class="chart">
                    <div id="chart-sales" data-color="primary" data-height="280" class="p-3"></div>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Koristu-latest/resources/views/dashboard/dashboard.blade.php ENDPATH**/ ?>