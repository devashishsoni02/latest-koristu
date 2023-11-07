<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pos manage')): ?>
<div class="card" id="pos-sidenav">
    <?php echo e(Form::open(array('route' => 'pos.setting.store'))); ?>

    <div class="card-header">
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-10">
                <h5 class=""><?php echo e(__('POS Settings')); ?></h5>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row mt-2">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="low_product_stock_threshold" class="form-label"><?php echo e(__('Low Product Stock Threshold')); ?></label>
                     <input type="number" name="low_product_stock_threshold" class="form-control" placeholder="<?php echo e(__('Low Product Stock Threshold')); ?>"   value="<?php echo e(!empty(company_setting('low_product_stock_threshold')) ? company_setting('low_product_stock_threshold') : ''); ?>" id="low_product_stock_threshold">
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <input class="btn btn-print-invoice  btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
    </div>
    <?php echo e(Form::close()); ?>

</div>
<div id="purchase-print-sidenav" class="card">
    <div class="card-header">
        <h5><?php echo e(__('Purchase Print Settings')); ?></h5>
        <small class="text-muted"><?php echo e(__('Edit details about your Company Bill')); ?></small>
    </div>
    <div class="bg-none">
        <div class="row company-setting">
            <form id="setting-form" method="post" action="<?php echo e(route('purchase.template.setting')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="card-header card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo e(Form::label('purchase_prefix',__('Prefix'),array('class'=>'form-label'))); ?>

                                <?php echo e(Form::text('purchase_prefix',!empty(company_setting('purchase_prefix')) ? company_setting('purchase_prefix') :'#PUR',array('class'=>'form-control', 'placeholder' => 'Enter Purchase Prefix'))); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo e(Form::label('purchase_footer_title',__('Footer Title'),array('class'=>'form-label'))); ?>

                                <?php echo e(Form::text('purchase_footer_title',!empty(company_setting('purchase_footer_title')) ? company_setting('purchase_footer_title') :'',array('class'=>'form-control', 'placeholder' => 'Enter Footer Title'))); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo e(Form::label('purchase_footer_notes',__('Footer Notes'),array('class'=>'form-label'))); ?>

                                <?php echo e(Form::textarea('purchase_footer_notes',!empty(company_setting('purchase_footer_notes')) ? company_setting('purchase_footer_notes') : '',array('class'=>'form-control','rows'=>'1' ,'placeholder' => 'Enter Purchase Footer Notes'))); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mt-2">
                                <?php echo e(Form::label('purchase_shipping_display',__('Shipping Display?'),array('class'=>'form-label'))); ?>

                                <div class=" form-switch form-switch-left">
                                    <input type="checkbox" class="form-check-input" name="purchase_shipping_display" id="purchase_shipping_display" <?php echo e((company_setting('purchase_shipping_display')=='on')?'checked':''); ?> >
                                    <label class="form-check-label" for="purchase_shipping_display"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card-header card-body">
                            <div class="form-group">
                                <?php echo e(Form::label('purchase_template',__('Template'),array('class'=>'form-label'))); ?>

                                <?php echo e(Form::select('purchase_template',\Modules\Pos\Entities\Pos::templateData()['templates'],!empty(company_setting('purchase_template')) ? company_setting('purchase_template') : null, array('class' => 'form-control ','required'=>'required'))); ?>

                            </div>
                            <div class="form-group">
                                <label class="col-form-label"><?php echo e(__('Color Input')); ?></label>
                                <div class="row gutters-xs">
                                    <?php $__currentLoopData = \Modules\Pos\Entities\Pos::templateData()['colors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-auto">
                                            <label class="colorinput">
                                                <input name="purchase_color" type="radio" value="<?php echo e($color); ?>" class="colorinput-input" <?php echo e((!empty(company_setting('purchase_color')) && company_setting('purchase_color') == $color) ? 'checked' : ''); ?>>
                                                <span class="colorinput-color" style="background: #<?php echo e($color); ?>"></span>
                                            </label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label"><?php echo e(__('Logo')); ?></label>
                                <div class="choose-files mt-3">
                                    <label for="purchase_logo">
                                        <div class=" bg-primary "> <i class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?></div>
                                        <img id="blah7" class="mt-3" src=""  width="70%"  />
                                        <input type="file" class="form-control file" name="purchase_logo" id="purchase_logo" data-filename="purchase_logo">
                                    </label>
                                </div>
                            </div>
                            <div class="form-group mt-2 text-end">
                                <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn btn-print-invoice  btn-primary m-r-10">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <?php if(!empty( company_setting('purchase_template')) && !empty(company_setting('purchase_color'))): ?>
                            <iframe id="purchase_frame" class="w-100 h-100" frameborder="0" src="<?php echo e(route('purchase.preview',[company_setting('purchase_template'), company_setting('purchase_color')])); ?>"></iframe>
                        <?php else: ?>
                            <iframe id="purchase_frame" class="w-100 h-100" frameborder="0" src="<?php echo e(route('purchase.preview',['template1','fffff'])); ?>"></iframe>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="pos-print-sidenav" class="card">
    <div class="card-header">
        <h5><?php echo e(__('Pos Print Settings')); ?></h5>
        <small class="text-muted"><?php echo e(__('Edit details about your Company Bill')); ?></small>
    </div>
    <div class="bg-none">
        <div class="row company-setting">
            <form id="setting-form" method="post" action="<?php echo e(route('pos.template.setting')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row ms-2">
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('pos_prefix',__('Prefix'),array('class'=>'form-label'))); ?>

                            <?php echo e(Form::text('pos_prefix',!empty(company_setting('pos_prefix')) ? company_setting('pos_prefix') :'#PUR',array('class'=>'form-control', 'placeholder' => 'Enter Pos Prefix'))); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('pos_footer_title',__('Footer Title'),array('class'=>'form-label'))); ?>

                            <?php echo e(Form::text('pos_footer_title',!empty(company_setting('pos_footer_title')) ? company_setting('pos_footer_title') :'',array('class'=>'form-control', 'placeholder' => 'Enter Footer Title'))); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('pos_footer_notes',__('Footer Notes'),array('class'=>'form-label'))); ?>

                            <?php echo e(Form::textarea('pos_footer_notes',!empty(company_setting('pos_footer_notes')) ? company_setting('pos_footer_notes') : '',array('class'=>'form-control','rows'=>'1' ,'placeholder' => 'Enter Pos Footer Notes'))); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mt-2">
                            <?php echo e(Form::label('pos_shipping_display',__('Shipping Display?'),array('class'=>'form-label'))); ?>

                            <div class=" form-switch form-switch-left">
                                <input type="checkbox" class="form-check-input" name="pos_shipping_display" id="pos_shipping_display" <?php echo e((company_setting('pos_shipping_display')=='on')?'checked':''); ?> >
                                <label class="form-check-label" for="pos_shipping_display"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card-header card-body">
                            <div class="form-group">
                                <label for="address" class="form-label"><?php echo e(__('POS Template')); ?></label>
                                <select class="form-control" name="pos_template">
                                    <?php $__currentLoopData = \Modules\Pos\Entities\Pos::templateData()['templates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($key); ?>" <?php echo e((!empty(company_setting('pos_template')) && company_setting('pos_template') == $key) ? 'selected' : ''); ?>><?php echo e($template); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label"><?php echo e(__('Color Input')); ?></label>
                                <div class="row gutters-xs">
                                    <?php $__currentLoopData = \Modules\Pos\Entities\Pos::templateData()['colors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-auto">
                                        <label class="colorinput">
                                            <input name="pos_color" type="radio" value="<?php echo e($color); ?>" class="colorinput-input" <?php echo e((!empty(company_setting('pos_color')) && company_setting('pos_color') == $color) ? 'checked' : ''); ?>>
                                            <span class="colorinput-color" style="background: #<?php echo e($color); ?>"></span>
                                        </label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label"><?php echo e(__('Logo')); ?></label>
                                <div class="choose-files mt-2 ">
                                    <label for="pos_logo">
                                        <div class=" bg-primary pos_logo_update"> <i class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?></div>
                                        <input type="file" class="form-control file" name="pos_logo" id="pos_logo" data-filename="pos_logo_update">
                                        <img id="pos_image" class="mt-2" style="width:25%;"/>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group mt-2 text-end">
                                <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn btn-print-invoice  btn-primary m-r-10">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <?php if(!empty(company_setting('pos_template')) && !empty(company_setting('pos_color'))): ?>
                            <iframe id="pos_frame" class="w-100 h-100" frameborder="0" src="<?php echo e(route('pos.preview',[company_setting('pos_template'),company_setting('pos_color')])); ?>"></iframe>
                        <?php else: ?>
                            <iframe id="pos_frame" class="w-100 h-100" frameborder="0" src="<?php echo e(route('pos.preview',['template1','fffff'])); ?>"></iframe>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php endif; ?>
<script>

    $(document).on("change", "select[name='purchase_template'], input[name='purchase_color']", function () {
        var template = $("select[name='purchase_template']").val();
        var color = $("input[name='purchase_color']:checked").val();
        $('#purchase_frame').attr('src', '<?php echo e(url('/purchase/preview')); ?>/' + template + '/' + color);
    });
    document.getElementById('purchase_logo').onchange = function () {
        var src = URL.createObjectURL(this.files[0])
        document.getElementById('purchase_image').src = src
    }

    $(document).on("change", "select[name='pos_template'], input[name='pos_color']", function () {
            var template = $("select[name='pos_template']").val();
            var color = $("input[name='pos_color']:checked").val();
            $('#pos_frame').attr('src', '<?php echo e(url('/pos/preview')); ?>/' + template + '/' + color);
        });

        document.getElementById('pos_logo').onchange = function () {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('pos_image').src = src
        }

</script>
<?php /**PATH /opt/lampp/htdocs/Koristu-latest/Modules/Pos/Resources/views/setting/nav_containt_div.blade.php ENDPATH**/ ?>