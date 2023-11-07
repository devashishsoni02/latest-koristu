<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('paypal manage')): ?>

<div class="card" id="paypal_sidenav">
    <?php echo e(Form::open(['route' => ['paypal.company.setting'], 'enctype' => 'multipart/form-data', 'id' => 'payment-form'])); ?>


    <div class="card-header">
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-10">
                <h5 class=""><?php echo e(__('Paypal')); ?></h5>
                <?php if(\Auth::user()->type == "super admin"): ?>
                    <small><?php echo e(__('These details will be used to collect subscription plan payments.Each subscription plan will have a payment button based on the below configuration.')); ?></small>
                <?php else: ?>
                    <small><?php echo e(__('These details will be used to collect invoice payments. Each invoice will have a payment button based on the below configuration.')); ?></small>
                <?php endif; ?>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 text-end">
                <div class="form-check form-switch custom-switch-v1 float-end">
                    <input type="checkbox" name="paypal_payment_is_on" class="form-check-input input-primary" id="paypal_payment_is_on" <?php echo e(company_setting('paypal_payment_is_on')=='on'?' checked ':''); ?> >
                    <label class="form-check-label" for="paypal_payment_is_on"></label>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <label class="paypal-label col-form-label" for="company_paypal_mode"><?php echo e(__('Paypal Mode')); ?></label> <br>
                <div class="d-flex">
                    <div class="mr-2">
                        <div class="p-3">
                            <div class="form-check">
                                <label class="form-check-labe text-dark">
                                    <input type="radio" name="company_paypal_mode" value="sandbox" class="form-check-input"
                                        <?php echo e(empty(company_setting('company_paypal_mode')) || company_setting('company_paypal_mode') == '' || company_setting('company_paypal_mode') == 'sandbox' ? 'checked="checked"' : ''); ?>>
                                    <?php echo e(__('Sandbox')); ?>

                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mr-2">
                        <div class="p-3">
                            <div class="form-check">
                                <label class="form-check-labe text-dark">
                                    <input type="radio" name="company_paypal_mode" value="live" class="form-check-input"
                                        <?php echo e(!empty(company_setting('company_paypal_mode')) && company_setting('company_paypal_mode') == 'live' ? 'checked="checked"' : ''); ?>>
                                    <?php echo e(__('Live')); ?>

                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="company_paypal_client_id" class="col-form-label"><?php echo e(__('Client ID')); ?></label>
                    <input type="text" name="company_paypal_client_id" id="company_paypal_client_id" class="form-control" value="<?php echo e(empty(company_setting('company_paypal_client_id')) || is_null(company_setting('company_paypal_client_id')) ? '' : company_setting('company_paypal_client_id')); ?>" placeholder="<?php echo e(__('Client ID')); ?>"<?php echo e(company_setting('paypal_payment_is_on')=='on'?'':' disabled'); ?>>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="company_paypal_secret_key" class="col-form-label"><?php echo e(__('Secret Key')); ?></label>
                    <input type="text" name="company_paypal_secret_key" id="company_paypal_secret_key" class="form-control" value="<?php echo e(empty(company_setting('company_paypal_secret_key')) || is_null(company_setting('company_paypal_secret_key')) ? '' : company_setting('company_paypal_secret_key')); ?>" placeholder="<?php echo e(__('Secret Key')); ?>" <?php echo e(company_setting('paypal_payment_is_on')=='on'?'':' disabled'); ?>>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <input class="btn btn-print-invoice btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
    </div>
    <?php echo e(Form::close()); ?>


</div>

<?php $__env->startPush('scripts'); ?>
<script>
   $(document).on('click','#paypal_payment_is_on',function(){
        if( $('#paypal_payment_is_on').prop('checked') )
        {
            $("#company_paypal_client_id").removeAttr("disabled");
            $("#company_paypal_secret_key").removeAttr("disabled");
        } else {
            $('#company_paypal_client_id').attr("disabled", "disabled");
            $('#company_paypal_secret_key').attr("disabled", "disabled");
        }
    });
</script>
<?php $__env->stopPush(); ?>

<?php endif; ?>


<?php /**PATH /opt/lampp/htdocs/Koristu-latest/Modules/Paypal/Resources/views/setting/nav_containt_div.blade.php ENDPATH**/ ?>