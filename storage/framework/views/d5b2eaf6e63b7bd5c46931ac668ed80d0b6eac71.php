<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('stripe manage')): ?>
    <div class="card" id="stripe-sidenav">
        <?php echo e(Form::open(['route' => 'stripe.setting.store', 'enctype' => 'multipart/form-data'])); ?>


        <div class="card-header">
            <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-10">
                    <h5 class=""><?php echo e(__('Stripe')); ?></h5>
                    <?php if(Auth::user()->type == 'company'): ?>
                        <small><?php echo e(__('These details will be used to collect invoice payments. Each invoice will have a payment button based on the below configuration.')); ?></small>
                    <?php elseif(Auth::user()->type == 'super admin'): ?>
                        <small><?php echo e(__('These details will be used to collect subscription plan payments.Each subscription plan will have a payment button based on the below configuration.')); ?></small>
                    <?php endif; ?>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 text-end">
                    <div class="form-check form-switch custom-switch-v1 float-end">
                        <input type="checkbox" name="stripe_is_on" class="form-check-input input-primary" id="stripe_is_on"
                            <?php echo e(company_setting('stripe_is_on') == 'on' ? ' checked ' : ''); ?>>
                        <label class="form-check-label" for="stripe_is_on"></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mt-2">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="stripe_key" class="form-label"><?php echo e(__('Stripe Key')); ?></label>
                        <input class="form-control stripe_webhook" placeholder="<?php echo e(__('Stripe Key')); ?>" name="stripe_key"
                            type="text" value="<?php echo e(company_setting('stripe_key')); ?>"
                            <?php echo e(company_setting('stripe_is_on') == 'on' ? '' : ' disabled'); ?> id="stripe_key">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="stripe_secret" class="form-label"><?php echo e(__('Stripe Secret Key')); ?></label>
                        <input class="form-control stripe_webhook" placeholder="<?php echo e(__('Stripe Secret Key')); ?>"
                            name="stripe_secret" type="text" value="<?php echo e(company_setting('stripe_secret')); ?>"
                            <?php echo e(company_setting('stripe_is_on') == 'on' ? '' : ' disabled'); ?> id="stripe_secret">
                    </div>
                </div>
            </div>

        </div>
        <div class="card-footer text-end">
            <input class="btn btn-print-invoice  btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
        </div>
        <?php echo e(Form::close()); ?>

    </div>
    <?php $__env->startPush('scripts'); ?>
        <script>
            $(document).on('click', '#stripe_is_on', function() {
                if ($('#stripe_is_on').prop('checked')) {
                    $(".stripe_webhook").removeAttr("disabled");
                } else {
                    $('.stripe_webhook').attr("disabled", "disabled");
                }
            });
        </script>
    <?php $__env->stopPush(); ?>

<?php endif; ?>
<?php /**PATH /opt/lampp/htdocs/Koristu-latest/Modules/Stripe/Resources/views/setting/nav_containt_div.blade.php ENDPATH**/ ?>