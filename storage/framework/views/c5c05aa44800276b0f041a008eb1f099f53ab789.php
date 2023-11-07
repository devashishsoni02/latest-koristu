<?php
$light_logo = get_file(light_logo()).'?'.time();
$dark_logo = get_file(dark_logo()).'?'.time();
?>

<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
<?php echo e(__('Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-action'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<!-- [ Main Content ] start -->
<div class="row">
   <!-- [ sample-page ] start -->
   <div class="col-sm-12">
      <div class="row">
         <div class="col-xl-3">
            <div class="card sticky-top setting-sidebar" style="top:30px">
               <div class="list-group list-group-flush" id="useradd-sidenav">
                    <a href="#site-settings" class="list-group-item list-group-item-action">
                        <?php echo e(__('Brand Settings')); ?>

                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                    </a>
                    <a href="#system-settings" class="list-group-item list-group-item-action">
                        <?php echo e(__('System Settings')); ?>

                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                    </a>
                    <?php if(Auth::user()->hasRole('company')): ?>
                        <a href="#company-setting-sidenav" class="list-group-item list-group-item-action">
                            <?php echo e(__('Company Settings')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                        <?php
                            $active_module =  ActivatedModule();
                            $dependency = explode(',','Account,Taskly');
                        ?>
                         <?php if(!empty(array_intersect($dependency,$active_module))): ?>
                            <a href="#proposal-print-sidenav" class="list-group-item list-group-item-action border-0"><?php echo e(__('Proposal Print Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <?php echo $__env->yieldPushContent('retainer_setting_sidebar'); ?>
                            <a href="#invoice-print-sidenav" class="list-group-item list-group-item-action border-0"><?php echo e(__('Invoice Print Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                         <?php endif; ?>
                     <?php endif; ?>
                     <?php echo $__env->yieldPushContent('general_setting_sidebar'); ?>
                     <?php echo $__env->yieldPushContent('account_setting_sidebar'); ?>
                     <?php echo $__env->yieldPushContent('hrm_setting_sidebar'); ?>
                     <?php echo $__env->yieldPushContent('crm_setting_sidebar'); ?>
                     <?php echo $__env->yieldPushContent('pos_setting_sidebar'); ?>
                     <?php echo $__env->yieldPushContent('rotas_setting_sidebar'); ?>
                     <?php echo $__env->yieldPushContent('support_setting_sidebar'); ?>
                     <?php echo $__env->yieldPushContent('sales_setting_sidebar'); ?>
                     <?php echo $__env->yieldPushContent('holidayz_setting_sidebar'); ?>
                     <?php echo $__env->yieldPushContent('timetracker_setting_sidebar'); ?>
                    <a href="#email-sidenav" class="list-group-item list-group-item-action">
                        <?php echo e(__('Email Settings')); ?>

                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                    </a>
                    <?php if(Auth::user()->hasRole('company')): ?>
                    <a href="#email-notification-sidenav" class="list-group-item list-group-item-action">
                        <?php echo e(__('Email Notification Settings')); ?>

                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                     </a>
                    <?php endif; ?>
                    <?php if(Auth::user()->hasRole('super admin')): ?>
                        <a href="#cookie-sidenav" class="list-group-item list-group-item-action border-0"><?php echo e(__('Cookie Settings')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        <a href="#pusher-sidenav" class="list-group-item list-group-item-action border-0"><?php echo e(__('Pusher Settings')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        <a href="#seo-sidenav" class="list-group-item list-group-item-action border-0"><?php echo e(__('SEO Settings')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                        <a href="#cache-sidenav" class="list-group-item list-group-item-action border-0"><?php echo e(__('Cache Settings')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('setting storage manage')): ?>
                        <a href="#storage-sidenav" class="list-group-item list-group-item-action">
                            <?php echo e(__('Storage Settings')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    <?php endif; ?>
                    <?php if(module_is_active('AIAssistant') || module_is_active('AIDocument') || module_is_active('AIImage')): ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('api key setting manage')): ?>
                            <a href="#aidocument-sidenav" class="list-group-item list-group-item-action">
                                <?php echo e(__('Chat GPT Key Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php echo $__env->yieldPushContent('company_setting_aftrer_site_setting_sidebar'); ?>

                    
                    <a href="#bank_transfer_sidenav" class="list-group-item list-group-item-action">
                        <?php echo e(__('Bank Transfer')); ?>

                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                    </a>
                    <?php echo $__env->yieldPushContent('payment_setting_sidebar'); ?>
               </div>

            </div>
         </div>
         <div class="col-xl-9">
             <!--Brand Settings-->
            <div id="site-settings" class="">
               <?php echo e(Form::open(['route' => ['settings.save'], 'enctype'=>'multipart/form-data','id'=>'setting-form'])); ?>

               <?php echo method_field('post'); ?>
               <div class="card">
                  <div class="card-header">
                     <h5><?php echo e(__('Brand Settings')); ?></h5>
                  </div>
                  <div class="card-body pb-0">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('setting logo manage')): ?>
                        <div class="row">
                            <div class="col-lg-4 col-12 d-flex">
                            <div class="card w-100">
                                <div class="card-header">
                                    <h5 class="small-title"><?php echo e(__('Logo Dark')); ?></h5>
                                </div>
                                <div class="card-body setting-card setting-logo-box p-3">
                                    <div class="d-flex flex-column justify-content-between align-items-center h-100">
                                        <div class="logo-content img-fluid logo-set-bg  text-center py-2">
                                            <img alt="image" src="<?php echo e(get_file(dark_logo())); ?><?php echo e('?'.time()); ?>" class="small-logo" id="pre_default_logo">
                                        </div>
                                        <div class="choose-files mt-3">
                                            <label for="logo_dark">
                                                <div class=" bg-primary "> <i class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?></div>
                                                <input type="file" class="form-control file" name="logo_dark" id="logo_dark" data-filename="logo_dark" onchange="document.getElementById('pre_default_logo').src = window.URL.createObjectURL(this.files[0])">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-lg-4 col-12 d-flex">
                            <div class="card w-100">
                                <div class="card-header">
                                    <h5 class="small-title"><?php echo e(__('Logo Light')); ?></h5>
                                </div>
                                <div class="card-body setting-card setting-logo-box p-3">
                                    <div class="d-flex flex-column justify-content-between align-items-center h-100">
                                        <div class="logo-content img-fluid logo-set-bg text-center py-2">
                                            <img alt="image" src="<?php echo e(get_file(light_logo())); ?><?php echo e('?'.time()); ?>" class="img_setting small-logo" id="landing_page_logo">
                                        </div>
                                        <div class="choose-files mt-3">
                                            <label for="logo_light">
                                                <div class=" bg-primary "> <i class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?></div>
                                                <input type="file" class="form-control file" name="logo_light" id="logo_light" data-filename="logo_light" onchange="document.getElementById('landing_page_logo').src = window.URL.createObjectURL(this.files[0])">

                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-lg-4 col-12 d-flex">
                            <div class="card w-100">
                                <div class="card-header">
                                    <h5 class="small-title"><?php echo e(__('Favicon')); ?></h5>
                                </div>
                                <div class="card-body setting-card setting-logo-box p-3">
                                    <div class="d-flex flex-column justify-content-between align-items-center h-100">
                                        <div class="logo-content img-fluid logo-set-bg text-center py-2">
                                            <img src="<?php echo e(get_file(favicon())); ?><?php echo e('?'.time()); ?>" class="setting-img" width="40px" id="img_favicon"/>
                                        </div>
                                        <div class="choose-files mt-3">
                                            <label for="favicon">
                                                <div class=" bg-primary "> <i class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?></div>
                                                <input type="file" class="form-control file" name="favicon" id="favicon" data-filename="favicon" onchange="document.getElementById('img_favicon').src = window.URL.createObjectURL(this.files[0])">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label for="title_text" class="form-label"><?php echo e(__('Title Text')); ?></label>
                                <?php echo e(Form::text('title_text',!empty(company_setting('title_text')) ? company_setting('title_text') : null,['class'=>'form-control','placeholder'=>__('Enter Title Text')])); ?>

                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label for="footer_text" class="form-label"><?php echo e(__('Footer Text')); ?></label>
                                <?php echo e(Form::text('footer_text',!empty(company_setting('footer_text')) ? company_setting('footer_text') : null,['class'=>'form-control','placeholder'=>__('Enter Footer Text')])); ?>

                            </div>
                        </div>
                        <?php if(Auth::user()->hasRole('super admin')): ?>
                            <div class="col-sm-3 col-12">
                                <div class="form-group col switch-width">
                                    <?php echo e(Form::label('landing_page',__('Enable Landing Page'),array('class'=>' col-form-label'))); ?>

                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" data-toggle="switchbutton" data-onstyle="primary" class="form-check-input decimal_format landing_page" name="landing_page" id="landing_page" <?php echo e(company_setting('landing_page')=='on'?'checked':''); ?>>
                                        <label class="form-check-label form-label" for="landing_page"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-12">
                                <div class="col switch-width">
                                    <div class="form-group mr-3">
                                        <label class="col-form-label"><?php echo e(__('Enable Signup')); ?></label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" data-toggle="switchbutton" data-onstyle="primary" class="" name="signup" id="faq" <?php echo e(company_setting('signup')=='on'?'checked':''); ?> >
                                            <label class="form-check-label" for="faq"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto  ">
                                <div class="form-group">
                                    <label class="text-dark mb-1 mt-3" for="email_verification"><?php echo e(__('Email Verification')); ?></label>
                                    <div class="">
                                        <input type="checkbox" name="email_verification" id="email_verification" data-toggle="switchbutton"  <?php echo e(admin_setting('email_verification')=='on'?'checked':''); ?>  data-onstyle="primary">
                                        <label class="form-check-label" for="email_verification"></label>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('setting theme manage')): ?>
                            <div class="row mt-2">
                                <h4 class="small-title"><?php echo e(__('Theme Customizer')); ?></h4>
                                <div class="settings-card p-3">
                                    <div class="row">
                                            <div class="col-md-3 col-sm-6 col-12">
                                                <h6 class="">
                                                    <i data-feather="credit-card" class="me-2"></i><?php echo e(__('Primary color settings')); ?>

                                                </h6>
                                                <hr class="my-2" />
                                                <div class="theme-color themes-color">
                                                    <a href="#!" class="<?php echo e((company_setting('color') && company_setting('color') == 'theme-1') ? 'active_color' : ''); ?>" data-value="theme-1" onclick="check_theme('theme-1')"></a>
                                                    <input type="radio" class="d-none" <?php echo e(company_setting('color') == 'theme-1' ? 'checked' : ''); ?>  name="color" value="theme-1">

                                                    <a href="#!" class="<?php echo e((company_setting('color') && company_setting('color') == 'theme-2') ? 'active_color' : ''); ?> " data-value="theme-2" onclick="check_theme('theme-2')"></a>
                                                    <input type="radio" class="d-none" <?php echo e(company_setting('color') == 'theme-2' ? 'checked' : ''); ?>  name="color" value="theme-2">
                                                    <a href="#!" class="<?php echo e((company_setting('color') && company_setting('color') == 'theme-3') ? 'active_color' : ''); ?>" data-value="theme-3" onclick="check_theme('theme-3')"></a>
                                                    <input type="radio" class="d-none" <?php echo e(company_setting('color') == 'theme-3' ? 'checked' : ''); ?>  name="color" value="theme-3">
                                                    <a href="#!" class="<?php echo e((company_setting('color') && company_setting('color') == 'theme-4') ? 'active_color' : ''); ?>" data-value="theme-4" onclick="check_theme('theme-4')"></a>
                                                    <input type="radio" class="d-none" <?php echo e(company_setting('color') == 'theme-4' ? 'checked' : ''); ?>  name="color" value="theme-4">
                                                    <a href="#!" class="<?php echo e((company_setting('color') && company_setting('color') == 'theme-5') ? 'active_color' : ''); ?>" data-value="theme-5" onclick="check_theme('theme-5')"></a>
                                                    <input type="radio" class="d-none" <?php echo e(company_setting('color') == 'theme-5' ? 'checked' : ''); ?>  name="color" value="theme-5">
                                                    <a href="#!" class="<?php echo e((company_setting('color') && company_setting('color') == 'theme-6') ? 'active_color' : ''); ?>" data-value="theme-6" onclick="check_theme('theme-6')"></a>
                                                    <input type="radio" class="d-none" <?php echo e(company_setting('color') == 'theme-6' ? 'checked' : ''); ?>  name="color" value="theme-6">
                                                    <a href="#!" class="<?php echo e((company_setting('color') && company_setting('color') == 'theme-7') ? 'active_color' : ''); ?>" data-value="theme-7" onclick="check_theme('theme-7')"></a>
                                                    <input type="radio" class="d-none" <?php echo e(company_setting('color') == 'theme-7' ? 'checked' : ''); ?>  name="color" value="theme-7">
                                                    <a href="#!" class="<?php echo e((company_setting('color') && company_setting('color') == 'theme-8') ? 'active_color' : ''); ?>" data-value="theme-8" onclick="check_theme('theme-8')"></a>
                                                    <input type="radio" class="d-none" <?php echo e(company_setting('color') == 'theme-8' ? 'checked' : ''); ?>  name="color" value="theme-8">
                                                    <a href="#!" class="<?php echo e((company_setting('color') && company_setting('color') == 'theme-9') ? 'active_color' : ''); ?>" data-value="theme-9" onclick="check_theme('theme-9')"></a>
                                                    <input type="radio" class="d-none" <?php echo e(company_setting('color') == 'theme-9' ? 'checked' : ''); ?>  name="color" value="theme-9">
                                                    <a href="#!" class="<?php echo e((company_setting('color') && company_setting('color') == 'theme-10') ? 'active_color' : ''); ?>" data-value="theme-10" onclick="check_theme('theme-10')"></a>
                                                    <input type="radio" class="d-none" <?php echo e(company_setting('color') == 'theme-10' ? 'checked' : ''); ?>  name="color" value="theme-10">
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-12">
                                                <h6>
                                                    <i data-feather="layout" class="me-2"></i> <?php echo e(__('Sidebar settings')); ?>

                                                </h6>
                                                <hr class="my-2" />
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" class="form-check-input" id="site_transparent" name="site_transparent" <?php echo e(company_setting('site_transparent')=='on'?'checked':''); ?>  />

                                                    <label class="form-check-label f-w-600 pl-1" for="site_transparent"><?php echo e(__('Transparent layout')); ?></label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-12">
                                                <h6 class="">
                                                    <i data-feather="sun" class=""></i><?php echo e(__('Layout settings')); ?>

                                                </h6>
                                                <hr class=" my-2 " />
                                                <div class="form-check form-switch mt-2">

                                                    <input type="checkbox" class="form-check-input" id="cust-darklayout" name="cust_darklayout"  <?php echo e(company_setting('cust_darklayout')=='on'?'checked':''); ?> />
                                                    <label class="form-check-label f-w-600 pl-1" for="cust-darklayout"><?php echo e(__('Dark Layout')); ?></label>

                                                </div>
                                            </div>
                                        <div class="col-sm-3 col-12">
                                            <h6 class="">
                                                <i data-feather="align-right" class=""></i><?php echo e(__('Enable RTL')); ?>

                                            </h6>
                                            <hr class=" my-2 " />
                                            <div class="form-check form-switch mt-2">

                                                <input type="checkbox" class="form-check-input" id="site_rtl" name="site_rtl" <?php echo e(company_setting('site_rtl')=='on'?'checked':''); ?>/>
                                                <label class="form-check-label f-w-600 pl-1" for="site_rtl"><?php echo e(__('RTL Layout')); ?></label>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                  </div>
                  <div class="card-footer text-end">
                     <input class="btn btn-print-invoice  btn-primary " type="submit" value="<?php echo e(__('Save Changes')); ?>">
                  </div>
                <?php echo e(Form::close()); ?>

               </div>
            </div>
             <!--system settings-->
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                    <div class="card" id="system-settings">
                        <div class="card-header">
                            <h5 class="small-title"><?php echo e(__('System Settings')); ?></h5>
                        </div>
                        <?php echo e(Form::open(['route' => ['system.settings.save'],'id'=>'setting-system-form'])); ?>

                        <?php echo method_field('post'); ?>
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group col switch-width">
                                        <?php echo e(Form::label('currency_format',__('Decimal Format'),array('class'=>' col-form-label'))); ?>

                                        <select class="form-control" data-trigger name="currency_format" id="currency_format" placeholder="This is a search placeholder">
                                            <option value="1" <?php echo e(company_setting('currency_format')=='1'?'selected':''); ?>>1.0</option>
                                            <option value="2" <?php echo e(company_setting('currency_format')=='2'?'selected':''); ?>>1.00</option>
                                            <option value="3" <?php echo e(company_setting('currency_format')=='3'?'selected':''); ?>>1.000</option>
                                            <option value="4" <?php echo e(company_setting('currency_format')=='4'?'selected':''); ?>>1.0000</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group col switch-width">
                                        <?php echo e(Form::label('defult_currancy',__('Default Currancy'),array('class'=>' col-form-label'))); ?>

                                        <select class="form-control" data-trigger name="defult_currancy" id="defult_currancy" placeholder="This is a search placeholder">
                                            <?php $__currentLoopData = currency(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($c->symbol); ?>-<?php echo e($c->code); ?>" data-symbol="<?php echo e($c->symbol); ?>" <?php echo e(company_setting('defult_currancy')== $c->code ?'selected':''); ?>><?php echo e($c->symbol); ?> - <?php echo e($c->code); ?> </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group col switch-width">
                                        <?php echo e(Form::label('defult_language',__('Default Language'),array('class'=>' col-form-label'))); ?>

                                        <select class="form-control" data-trigger name="defult_language" id="defult_language" placeholder="This is a search placeholder">
                                            <?php $__currentLoopData = languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>" <?php echo e(company_setting('defult_language')== $key ?'selected':''); ?>><?php echo e(Str::ucfirst($language)); ?> </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="form-group col switch-width">
                                        <?php echo e(Form::label('defult_timezone',__('Default Timezone'),array('class'=>' col-form-label'))); ?>

                                        <?php echo e(Form::select('defult_timezone',$timezones, company_setting('defult_timezone') , ['id' => 'timezone','class'=>"form-control choices",'searchEnabled'=>'true'])); ?>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label" for="example3cols3Input"><?php echo e(__('Currency Symbol Position')); ?></label>
                                        <div class="row ms-1">
                                            <div class="form-check col-md-6">
                                                <input class="form-check-input" type="radio" name="site_currency_symbol_position" value="pre" <?php if(empty(company_setting('site_currency_symbol_position')) || company_setting('site_currency_symbol_position') == 'pre'): ?> checked <?php endif; ?>
                                                id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    <?php echo e(__('Pre')); ?>

                                                </label>
                                            </div>
                                            <div class="form-check col-md-6">
                                                <input class="form-check-input" type="radio" name="site_currency_symbol_position" value="post" <?php if(company_setting('site_currency_symbol_position') == 'post'): ?> checked <?php endif; ?>
                                                id="flexCheckChecked">
                                                <label class="form-check-label" for="flexCheckChecked">
                                                    <?php echo e(__('Post')); ?>

                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="site_date_format" class="form-label"><?php echo e(__('Date Format')); ?></label>
                                        <select type="text" name="site_date_format" class="form-control selectric" id="site_date_format">
                                            <option value="d-m-Y" <?php if(company_setting('site_date_format') == 'd-m-Y'): ?> selected="selected" <?php endif; ?>>DD-MM-YYYY</option>
                                            <option value="m-d-Y" <?php if(company_setting('site_date_format') == 'm-d-Y'): ?> selected="selected" <?php endif; ?>>MM-DD-YYYY</option>
                                            <option value="Y-m-d" <?php if(company_setting('site_date_format') == 'Y-m-d'): ?> selected="selected" <?php endif; ?>>YYYY-MM-DD</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="site_time_format" class="form-label"><?php echo e(__('Time Format')); ?></label>
                                        <select type="text" name="site_time_format" class="form-control selectric" id="site_time_format">
                                            <option value="g:i A" <?php if(company_setting('site_time_format') == 'g:i A'): ?> selected="selected" <?php endif; ?>>10:30 PM</option>
                                            <option value="H:i" <?php if(company_setting('site_time_format') == 'H:i'): ?> selected="selected" <?php endif; ?>>22:30</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <input class="btn btn-print-invoice  btn-primary " type="submit" value="<?php echo e(__('Save Changes')); ?>">
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                    </div>
                </div>
            
            <?php if(Auth::user()->hasRole('company')): ?>
            <div class="card" id="company-setting-sidenav">
                <?php echo e(Form::open(['route' => 'company.setting.save'])); ?>

                <div class="card-header">
                    <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-10">
                            <h5 class=""><?php echo e(__('Company Settings')); ?></h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <?php echo e(Form::label('company_name', __('Company Name'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('company_name', !empty(company_setting('company_name')) ? company_setting('company_name') : null, ['class' => 'form-control ', 'placeholder' => 'Enter Company Name'])); ?>

                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <?php echo e(Form::label('company_address', __('Address'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('company_address', !empty(company_setting('company_address')) ? company_setting('company_address') : null, ['class' => 'form-control ', 'placeholder' => 'Enter Address'])); ?>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?php echo e(Form::label('company_city', __('City'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('company_city', !empty(company_setting('company_city')) ? company_setting('company_city') : null, ['class' => 'form-control ', 'placeholder' => 'Enter City'])); ?>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?php echo e(Form::label('company_state', __('State'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('company_state', !empty(company_setting('company_state')) ? company_setting('company_state') : null, ['class' => 'form-control ', 'placeholder' => 'Enter State'])); ?>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?php echo e(Form::label('company_country', __('Country'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('company_country', !empty(company_setting('company_country')) ? company_setting('company_country') : null, ['class' => 'form-control ', 'placeholder' => 'Enter Country'])); ?>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?php echo e(Form::label('company_zipcode', __('Zip/Post Code'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('company_zipcode', !empty(company_setting('company_zipcode')) ? company_setting('company_zipcode') : null, ['class' => 'form-control ', 'placeholder' => 'Enter Zip/Post Code'])); ?>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?php echo e(Form::label('company_telephone', __('Telephone'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('company_telephone', !empty(company_setting('company_telephone')) ? company_setting('company_telephone') : null, ['class' => 'form-control ', 'placeholder' => 'Enter Telephone'])); ?>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?php echo e(Form::label('company_email_from_name', __('Email (From Name)'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('company_email_from_name', !empty(company_setting('company_email_from_name')) ? company_setting('company_email_from_name') : null, ['class' => 'form-control ', 'placeholder' => 'Enter Email From Name'])); ?>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?php echo e(Form::label('registration_number', __('Company Registration Number'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('registration_number', !empty(company_setting('registration_number')) ? company_setting('registration_number') : null, ['class' => 'form-control ', 'placeholder' => 'Enter Company Registration Number'])); ?>

                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <?php echo e(Form::label('company_email', __('System Email'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('company_email', !empty(company_setting('company_email')) ? company_setting('company_email') : null, ['class' => 'form-control ', 'placeholder' => 'Enter System Email'])); ?>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="vat_gst_number_switch"><?php echo e(__('Tax Number')); ?></label>
                            <div class="form-check form-switch custom-switch-v1 float-end">
                                <input type="checkbox" name="vat_gst_number_switch" class="form-check-input input-primary pointer" value="on" id="vat_gst_number_switch" <?php echo e(company_setting('vat_gst_number_switch')=='on'?' checked ':''); ?>>
                                <label class="form-check-label" for="vat_gst_number_switch"></label>
                            </div>
                        </div>
                        <div class=" col-md-6 tax_type_div <?php echo e(company_setting('vat_gst_number_switch') !='on'?' d-none ':''); ?>">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check form-check-inline form-group mb-3">
                                            <input type="radio" id="customRadio8" name="tax_type" value="VAT"
                                                class="form-check-input" <?php echo e(company_setting('tax_type') == 'VAT' ? 'checked' : ''); ?>>
                                            <label class="form-check-label" for="customRadio8"><?php echo e(__('VAT Number')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-check-inline form-group mb-3">
                                            <input type="radio" id="customRadio7" name="tax_type" value="GST"
                                                class="form-check-input" <?php echo e(company_setting('tax_type') == 'GST' ? 'checked' : ''); ?>>
                                            <label class="form-check-label" for="customRadio7"><?php echo e(__('GST Number')); ?></label>
                                        </div>
                                    </div>
                                </div>
                                <?php echo e(Form::text('vat_number', !empty(company_setting('vat_number')) ? company_setting('vat_number') : null, ['class' => 'form-control', 'placeholder' => __('Enter VAT / GST Number')])); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <input class="btn btn-print-invoice  btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                </div>
                <?php echo e(Form::close()); ?>

            </div>
            <?php
                $active_module =  ActivatedModule();
                $dependency = explode(',','Account,Taskly');
            ?>
                <?php if(!empty(array_intersect($dependency,$active_module))): ?>
                <!--Proposal print Setting-->
                <div id="proposal-print-sidenav" class="card">
                    <div class="card-header">
                        <h5><?php echo e(__('Proposal Print Settings')); ?></h5>
                        <small class="text-muted"><?php echo e(__('Edit your Company Proposal details')); ?></small>
                    </div>
                    <div class="bg-none">
                        <div class="row company-setting">
                            <div class="">
                                <form id="setting-form" method="post" action="<?php echo e(route('proposal.template.setting')); ?>" enctype ="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="card-header card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <?php echo e(Form::label('proposal_prefix',__('Prefix'),array('class'=>'form-label'))); ?>

                                            <?php echo e(Form::text('proposal_prefix',!empty(company_setting('proposal_prefix')) ? company_setting('proposal_prefix') :'#PROP0',array('class'=>'form-control', 'placeholder' => 'Enter Prefix'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <?php echo e(Form::label('proposal_starting_number',__('Starting Number'),array('class'=>'form-label'))); ?>

                                            <?php echo e(Form::number('proposal_starting_number',!empty(company_setting('proposal_starting_number')) ? company_setting('proposal_starting_number') : 1,array('class'=>'form-control', 'placeholder' => 'Enter Starting Number'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <?php echo e(Form::label('proposal_footer_title',__('Footer Title'),array('class'=>'form-label'))); ?>

                                            <?php echo e(Form::text('proposal_footer_title',!empty(company_setting('proposal_footer_title')) ? company_setting('proposal_footer_title') :'',array('class'=>'form-control', 'placeholder' => 'Enter Footer Title'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <?php echo e(Form::label('proposal_footer_notes',__('Footer Notes'),array('class'=>'form-label'))); ?>

                                            <?php echo e(Form::textarea('proposal_footer_notes',!empty(company_setting('proposal_footer_notes')) ? company_setting('proposal_footer_notes') : '',array('class'=>'form-control','rows'=>'1' ,'placeholder' => 'Enter Footer Notes'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mt-2">
                                            <?php echo e(Form::label('proposal_shipping_display',__('Shipping Display?'),array('class'=>'form-label'))); ?>

                                            <div class=" form-switch form-switch-left">
                                                <input type="checkbox" class="form-check-input" name="proposal_shipping_display" id="proposal_shipping_display" <?php echo e((company_setting('proposal_shipping_display')=='on')?'checked':''); ?> >
                                                <label class="form-check-label" for="proposal_shipping_display"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card-header card-body">
                                            <div class="form-group">
                                                <label for="proposal_template" class="col-form-label"><?php echo e(__('Template')); ?></label>
                                                <select class="form-control" name="proposal_template" id="proposal_template">
                                                    <?php $__currentLoopData = templateData()['templates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($key); ?>" <?php echo e(( !empty( company_setting('proposal_template')) && company_setting('proposal_template') == $key) ? 'selected' : ''); ?>><?php echo e($template); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label"><?php echo e(__('Color Input')); ?></label>
                                                <div class="row gutters-xs">
                                                    <?php $__currentLoopData = templateData()['colors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="col-auto">
                                                            <label class="colorinput">
                                                                <input name="proposal_color" type="radio" value="<?php echo e($color); ?>" class="colorinput-input" <?php echo e(( !empty( company_setting('proposal_color')) && company_setting('proposal_color') == $color) ? 'checked' : ''); ?>>
                                                                <span class="colorinput-color" style="background: #<?php echo e($color); ?>"></span>
                                                            </label>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label"><?php echo e(__('Logo')); ?></label>
                                                <div class="choose-files mt-3">
                                                    <label for="proposal_logo">
                                                        <div class=" bg-primary "> <i class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?></div>
                                                        <img id="blah12" class="mt-3" src=""  width="70%"  />
                                                        <input type="file" class="form-control file" name="proposal_logo" id="proposal_logo" data-filename="proposal_logo_update" onchange="document.getElementById('blah12').src = window.URL.createObjectURL(this.files[0])">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group mt-2 text-end">
                                                <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn btn-print-invoice  btn-primary m-r-10">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <?php if(!empty(company_setting('proposal_template')) && !empty( company_setting('proposal_color') )): ?>
                                            <iframe id="proposal_frame" class="w-100 h-100" frameborder="0" src="<?php echo e(route('proposal.preview',[company_setting('proposal_template'),company_setting('proposal_color')])); ?>"></iframe>
                                        <?php else: ?>
                                            <iframe id="proposal_frame" class="w-100 h-100" frameborder="0" src="<?php echo e(route('proposal.preview',['template1','fffff'])); ?>"></iframe>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
                <?php echo $__env->yieldPushContent('retainer_setting_sidebar_div'); ?>
                <!--Invoice print Setting-->
                <div id="invoice-print-sidenav" class="card">
                    <div class="card-header">
                        <h5><?php echo e(__('Invoice Print Settings')); ?></h5>
                        <small class="text-muted"><?php echo e(__('Edit your Company invoice details')); ?></small>
                    </div>
                    <div class="bg-none">
                        <div class="row company-setting">
                            <form id="setting-form" method="post" action="<?php echo e(route('invoice.template.setting')); ?>" enctype ="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="card-header card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <?php echo e(Form::label('invoice_prefix',__('Prefix'),array('class'=>'form-label'))); ?>

                                            <?php echo e(Form::text('invoice_prefix',!empty(company_setting('invoice_prefix')) ? company_setting('invoice_prefix') :'#INV',array('class'=>'form-control', 'placeholder' => 'Enter Prefix'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <?php echo e(Form::label('invoice_starting_number',__('Starting Number'),array('class'=>'form-label'))); ?>

                                            <?php echo e(Form::number('invoice_starting_number',!empty(company_setting('invoice_starting_number')) ? company_setting('invoice_starting_number') : 1,array('class'=>'form-control', 'placeholder' => 'Enter Invoice Starting Number'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <?php echo e(Form::label('invoice_footer_title',__('Footer Title'),array('class'=>'form-label'))); ?>

                                            <?php echo e(Form::text('invoice_footer_title',!empty(company_setting('invoice_footer_title')) ? company_setting('invoice_footer_title') :'',array('class'=>'form-control', 'placeholder' => 'Enter Footer Title'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <?php echo e(Form::label('invoice_footer_notes',__('Footer Notes'),array('class'=>'form-label'))); ?>

                                            <?php echo e(Form::textarea('invoice_footer_notes',!empty(company_setting('invoice_footer_notes')) ? company_setting('invoice_footer_notes') : '',array('class'=>'form-control','rows'=>'1' ,'placeholder' => 'Enter Footer Notes'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mt-2">
                                            <?php echo e(Form::label('invoice_shipping_display',__('Shipping Display?'),array('class'=>'form-label'))); ?>

                                            <div class=" form-switch form-switch-left">
                                                <input type="checkbox" class="form-check-input" name="invoice_shipping_display" id="invoice_shipping_display" <?php echo e((company_setting('invoice_shipping_display')=='on')?'checked':''); ?> >
                                                <label class="form-check-label" for="invoice_shipping_display"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card-header card-body">
                                            <div class="form-group">
                                                <label for="invoice_template" class="col-form-label"><?php echo e(__('Template')); ?></label>
                                                <select class="form-control" name="invoice_template" id="invoice_template">
                                                    <?php $__currentLoopData = templateData()['templates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($key); ?>" <?php echo e(( !empty( company_setting('invoice_template')) && company_setting('invoice_template') == $key) ? 'selected' : ''); ?>><?php echo e($template); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label"><?php echo e(__('Color Input')); ?></label>
                                                <div class="row gutters-xs">
                                                    <?php $__currentLoopData = templateData()['colors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="col-auto">
                                                            <label class="colorinput">
                                                                <input name="invoice_color" type="radio" value="<?php echo e($color); ?>" class="colorinput-input" <?php echo e(( !empty( company_setting('invoice_color')) && company_setting('invoice_color') == $color) ? 'checked' : ''); ?>>
                                                                <span class="colorinput-color" style="background: #<?php echo e($color); ?>"></span>
                                                            </label>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label"><?php echo e(__('Logo')); ?></label>
                                                <div class="choose-files mt-3">
                                                    <label for="invoice_logo">
                                                        <div class=" bg-primary "> <i class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?></div>
                                                        <img id="blah6" class="mt-3" src=""  width="70%"  />
                                                        <input type="file" class="form-control file" name="invoice_logo" id="invoice_logo" data-filename="invoice_logo_update" onchange="document.getElementById('blah6').src = window.URL.createObjectURL(this.files[0])">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group mt-2 text-end">
                                                <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn btn-print-invoice  btn-primary m-r-10">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <?php if(!empty(company_setting('invoice_template')) && !empty( company_setting('invoice_color') )): ?>
                                            <iframe id="invoice_frame" class="w-100 h-100" frameborder="0" src="<?php echo e(route('invoice.preview',[company_setting('invoice_template'),company_setting('invoice_color')])); ?>"></iframe>
                                        <?php else: ?>
                                            <iframe id="invoice_frame" class="w-100 h-100" frameborder="0" src="<?php echo e(route('invoice.preview',['template1','fffff'])); ?>"></iframe>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            <?php endif; ?>
            <?php echo $__env->yieldPushContent('general_setting_sidebar_div'); ?>
            <?php echo $__env->yieldPushContent('account_setting_sidebar_div'); ?>
            <?php echo $__env->yieldPushContent('hrm_setting_sidebar_div'); ?>
            <?php echo $__env->yieldPushContent('crm_setting_sidebar_div'); ?>
            <?php echo $__env->yieldPushContent('pos_setting_sidebar_div'); ?>
            <?php echo $__env->yieldPushContent('rotas_setting_sidebar_div'); ?>
            <?php echo $__env->yieldPushContent('support_setting_sidebar_div'); ?>
            <?php echo $__env->yieldPushContent('sales_setting_sidebar_div'); ?>
            <?php echo $__env->yieldPushContent('holidayz_setting_sidebar_div'); ?>
            <?php echo $__env->yieldPushContent('timetracker_setting_sidebar_div'); ?>
            <div class="card" id="email-sidenav">
                <div class="email-setting-wrap ">
                    <?php echo e(Form::open(['route' => ['mail.setting.store'],'id'=>'mail-form'])); ?>

                    <?php echo method_field('post'); ?>
                        <div class="card-header">
                            <h3 class="h5"><?php echo e(__('Email Settings')); ?></h3>
                        </div>
                        <div class="card-body pb-0">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="mail_driver" class="form-label"><?php echo e(__('Mail Driver')); ?></label>
                                <?php echo e(Form::text('mail_driver',company_setting('mail_driver'),['class'=>'form-control','placeholder'=>__('Enter Mail Driver'),'id'=>'mail_driver'])); ?>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="mail_host" class="form-label"><?php echo e(__('Mail Host')); ?></label>
                                <?php echo e(Form::text('mail_host',company_setting('mail_host'),['class'=>'form-control','placeholder'=>__('Enter Mail Driver'),'id'=>'mail_host'])); ?>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="mail_port" class="form-label"><?php echo e(__('Mail Port')); ?></label>
                                <?php echo e(Form::text('mail_port', company_setting('mail_port'), ['class' => 'form-control', 'placeholder' => __('Enter mail port'), 'required' => 'required','id'=>'mail_port'])); ?>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="mail_username" class="form-label"><?php echo e(__('Mail Username')); ?></label>
                                <?php echo e(Form::text('mail_username', company_setting('mail_username'), ['class' => 'form-control', 'placeholder' => __('Enter mail username'), 'required' => 'required','id'=>'mail_username'])); ?>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="mail_password" class="form-label"><?php echo e(__('Mail Password')); ?></label>
                                <?php echo e(Form::text('mail_password', company_setting('mail_password'), ['class' => 'form-control', 'placeholder' => __('Enter mail password'), 'required' => 'required','id'=>'mail_password'])); ?>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="mail_encryption" class="form-label"><?php echo e(__('Mail Encryption')); ?></label>
                                <?php echo e(Form::text('mail_encryption', company_setting('mail_encryption'), ['class' => 'form-control', 'placeholder' => __('Enter mail encryption'), 'required' => 'required','id'=>'mail_encryption'])); ?>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="mail_from_address" class="form-label"><?php echo e(__('Mail From Address')); ?></label>
                                <?php echo e(Form::text('mail_from_address', company_setting('mail_from_address'), ['class' => 'form-control ', 'placeholder' => __('Enter mail from address'), 'required' => 'required','id'=>'mail_from_address'])); ?>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="mail_from_name" class="form-label"><?php echo e(__('Mail From Name')); ?></label>
                                <?php echo e(Form::text('mail_from_name', company_setting('mail_from_name'), ['class' => 'form-control', 'placeholder' => __('Enter mail from name'), 'required' => 'required','id'=>'mail_from_name'])); ?>

                            </div>
                        </div>
                    </div>

                        <div class="card-footer d-flex justify-content-between flex-wrap "style="gap:10px">

                            <button type="button" data-url="<?php echo e(route('test.setting.mail')); ?>"  data-title="<?php echo e(__('Send Test Mail')); ?>" class="btn btn-print-invoice  btn-primary m-r-10 send_email test-mail"><?php echo e(__('Send Test Mail')); ?></button>

                            <input class="btn btn-print-invoice  btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                        </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
            <?php if(Auth::user()->hasRole('company')): ?>
                <!--Email Notification Settings-->
                <div class="card" id="email-notification-sidenav">
                    <div class="email-setting-wrap ">
                        <?php echo e(Form::open(['route' => ['mail.notification.setting.store'],'id'=>'mail-notification-form'])); ?>

                        <?php echo method_field('post'); ?>
                            <div class="card-header">
                                <h3 class="h5"><?php echo e(__('Email Notification Settings')); ?></h3>
                            </div>
                            <div class="card-body pb-0">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <?php
                                    $active = 'active';
                                ?>
                                <?php $__currentLoopData = $email_notification_modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e_module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(Gate::check($e_module.' manage')|| Gate::check(strtolower($e_module).' manage') ||  $e_module == 'general'): ?>
                                <?php if((module_is_active($e_module)) || $e_module == 'general'): ?>
                                        <li class="nav-item">
                                            <a class="nav-link text-capitalize <?php echo e($active); ?>" id="pills-<?php echo e(strtolower($e_module)); ?>-tab-email" data-bs-toggle="pill" href="#pills-<?php echo e(strtolower($e_module)); ?>-email" role="tab" aria-controls="pills-<?php echo e(strtolower($e_module)); ?>-email" aria-selected="true"><?php echo e(Module_Alias_Name($e_module)); ?></a>
                                        </li>
                                    <?php
                                        $active = '';
                                    ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <div class="tab-content mb-3" id="pills-tabContent">
                                <?php $__currentLoopData = $email_notification_modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e_module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if((module_is_active($e_module)) || $e_module == 'general'): ?>
                                        <div class="tab-pane fade <?php echo e($loop->index == 0? 'active':''); ?> show" id="pills-<?php echo e(strtolower($e_module)); ?>-email" role="tabpanel" aria-labelledby="pills-<?php echo e(strtolower($e_module)); ?>-tab-email">
                                            <div class="row">
                                                <?php $__currentLoopData = $email_notify; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e_action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(Gate::check($e_action->permissions) || $e_action->permissions == null): ?>
                                                <?php if($e_action->module == $e_module): ?>
                                                        <div class="col-lg-4 col-md-6 col-12">
                                                            <div class="d-flex align-items-center justify-content-between list_colume_notifi pb-2 mb-3">
                                                                <div class="mb-3 mb-sm-0">
                                                                    <h6>
                                                                        <label for="<?php echo e($e_action->action); ?>" class="form-label"><?php echo e($e_action->action); ?></label>
                                                                    </h6>
                                                                </div>
                                                                <div class="text-end">
                                                                    <div class="form-check form-switch d-inline-block">
                                                                        <input type="hidden" name="mail_noti[<?php echo e($e_action->action); ?>]" value="0" />
                                                                        <input class="form-check-input" <?php echo e((company_setting($e_action->action) == true) ? 'checked' : ''); ?> id="mail_notificaation" name="mail_noti[<?php echo e($e_action->action); ?>]" type="checkbox" value="1">
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <input class="btn btn-print-invoice  btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                            </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            <?php endif; ?>
            <?php if(Auth::user()->hasRole('super admin')): ?>
            
            <div class="card" id="cookie-sidenav">
                <?php echo e(Form::open(['route' => ['cookie.setting.save'],'method'=>'post'])); ?>

                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <h5 class=""><?php echo e(__('Cookie Settings')); ?></h5>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 text-end">
                            <div class="form-check form-switch custom-switch-v1 float-end">
                                <input type="checkbox" name="enable_cookie" class="form-check-input input-primary" id="enable_cookie"
                                    <?php echo e(admin_setting('enable_cookie') == 'on' ? ' checked ' : ''); ?>>
                                <label class="form-check-label" for="enable_cookie"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6">
                            <div class="form-check form-switch custom-switch-v1" id="cookie_log">
                                <input type="checkbox" name="cookie_logging" class="form-check-input input-primary cookie_setting"
                                       id="cookie_logging" <?php echo e(admin_setting('cookie_logging') == 'on' ? ' checked ' : ''); ?>>
                                <label class="form-check-label" for="cookie_logging"><?php echo e(__('Enable logging')); ?></label>
                                <small class="text-danger"><?php echo e(__('After enabling logging, user cookie data will be stored in CSV file.')); ?></small>
                            </div>
                            <div class="form-group" >
                                <?php echo e(Form::label('cookie_title', __('Cookie Title'), ['class' => 'col-form-label' ])); ?>

                                <?php echo e(Form::text('cookie_title',!empty(admin_setting('cookie_title')) ? admin_setting('cookie_title') : null , ['class' => 'form-control cookie_setting'] )); ?>

                            </div>
                            <div class="form-group ">
                                <?php echo e(Form::label('cookie_description', __('Cookie Description'), ['class' => ' form-label'])); ?>

                                <?php echo Form::textarea('cookie_description',!empty(admin_setting('cookie_description')) ? admin_setting('cookie_description') : null , ['class' => 'form-control cookie_setting', 'rows' => '3']); ?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch custom-switch-v1 ">
                                <input type="checkbox" name="necessary_cookies" class="form-check-input input-primary cookie_setting"
                                       id="necessary_cookies" checked onclick="return false">
                                <label class="form-check-label" for="necessary_cookies"><?php echo e(__('Strictly necessary cookies')); ?></label>
                            </div>
                            <div class="form-group ">
                                <?php echo e(Form::label('strictly_cookie_title', __(' Strictly Cookie Title'), ['class' => 'col-form-label'])); ?>

                                <?php echo e(Form::text('strictly_cookie_title',!empty(admin_setting('strictly_cookie_title')) ? admin_setting('strictly_cookie_title') : null , ['class' => 'form-control cookie_setting'])); ?>

                            </div>
                            <div class="form-group ">
                                <?php echo e(Form::label('strictly_cookie_description', __('Strictly Cookie Description'), ['class' => ' form-label'])); ?>

                                <?php echo Form::textarea('strictly_cookie_description',!empty(admin_setting('strictly_cookie_description')) ? admin_setting('strictly_cookie_description') : null , ['class' => 'form-control cookie_setting ', 'rows' => '3']); ?>

                            </div>
                        </div>
                        <div class="col-12">
                            <h5><?php echo e(__('More Information')); ?></h5>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo e(Form::label('more_information_description', __('Contact Us Description'), ['class' => 'col-form-label'])); ?>

                                <?php echo e(Form::text('more_information_description',!empty(admin_setting('more_information_description')) ? admin_setting('more_information_description') : null , ['class' => 'form-control cookie_setting'])); ?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <?php echo e(Form::label('contactus_url', __('Contact Us URL'), ['class' => 'col-form-label'])); ?>

                                <?php echo e(Form::text('contactus_url',!empty(admin_setting('contactus_url')) ? admin_setting('contactus_url') : null , ['class' => 'form-control cookie_setting'])); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6">
                            <?php if(admin_setting('cookie_logging') == 'on'): ?>
                                <?php if(check_file('uploads/sample/cookie_data.csv')): ?>
                                    <label for="file" class="form-label"><?php echo e(__('Download cookie accepted data')); ?></label>
                                    <a href="<?php echo e(asset('uploads/sample/cookie_data.csv')); ?>" class="btn btn-primary mr-3">
                                        <i class="ti ti-download"></i>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-6 text-end ">
                            <input class="btn btn-print-invoice btn-primary" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                        </div>
                    </div>
                </div>
                <?php echo e(Form::close()); ?>

            </div>

             <!--Pusher Setting-->
             <div id="pusher-sidenav" class="card">
                <div class="card-header">
                    <h5><?php echo e(__('Pusher Settings')); ?></h5>
                </div>
                <div class="card-body">
                    <?php echo e(Form::open(['route' => ['pusher.setting'],'method'=>'post','id'=>'pusher-form'])); ?>

                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo e(Form::label('pusher_app_id',__('Pusher App Id'),array('class'=>'form-label'))); ?>

                                <?php echo e(Form::text('pusher_app_id',!empty(admin_setting('PUSHER_APP_ID')) ? admin_setting('PUSHER_APP_ID') :null,array('class'=>'form-control font-style','required'=>'required','placeholder'=>'Enter Pusher App Id'))); ?>

                                <?php $__errorArgs = ['pusher_app_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-pusher_app_id" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo e(Form::label('pusher_app_key',__('Pusher App Key'),array('class'=>'form-label'))); ?>

                                <?php echo e(Form::text('pusher_app_key',!empty(admin_setting('PUSHER_APP_KEY')) ? admin_setting('PUSHER_APP_KEY') :null,array('class'=>'form-control font-style','required'=>'required','placeholder'=>'Enter Pusher App Key'))); ?>

                                <?php $__errorArgs = ['pusher_app_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-pusher_app_key" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo e(Form::label('pusher_app_secret',__('Pusher App Secret'),array('class'=>'form-label'))); ?>

                                <?php echo e(Form::text('pusher_app_secret',!empty(admin_setting('PUSHER_APP_SECRET')) ? admin_setting('PUSHER_APP_SECRET') :null,array('class'=>'form-control font-style','required'=>'required','placeholder'=>'Enter Pusher App Secret'))); ?>

                                <?php $__errorArgs = ['pusher_app_secret'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-pusher_app_secret" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo e(Form::label('pusher_app_cluster',__('Pusher App Cluster'),array('class'=>'form-label'))); ?>

                                <?php echo e(Form::text('pusher_app_cluster',!empty(admin_setting('PUSHER_APP_CLUSTER')) ? admin_setting('PUSHER_APP_CLUSTER') :null,array('class'=>'form-control font-style','required'=>'required','placeholder'=>'Enter Pusher App Cluster'))); ?>

                                <?php $__errorArgs = ['pusher_app_cluster'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-pusher_app_cluster" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <input class="btn btn-print-invoice  btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                </div>

                <?php echo e(Form::close()); ?>

            </div>
            

            <div id="seo-sidenav" class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <h5><?php echo e(__('SEO Settings')); ?></h5>
                        </div>
                    </div>
                </div>
                <?php echo e(Form::open(['url' => route('seo.setting.save'), 'method' => 'post', 'enctype' => 'multipart/form-data'])); ?>

                <?php echo csrf_field(); ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <?php echo e(Form::label('meta_title', __('Meta Title'), ['class' => 'col-form-label'])); ?>

                                <?php echo e(Form::text('meta_title', !empty(admin_setting('meta_title')) ? admin_setting('meta_title') :null, ['class' => 'form-control ','required'=>'required','placeholder' => 'Meta Title'])); ?>

                            </div>
                            <div class="form-group">
                                <?php echo e(Form::label('meta_keywords', __('Meta Keywords'), ['class' => 'col-form-label'])); ?>

                                <?php echo e(Form::textarea('meta_keywords', !empty(admin_setting('meta_keywords')) ? admin_setting('meta_keywords') :null , ['class' => 'form-control ','required'=>'required','placeholder' => 'Meta Keywords','rows'=>2])); ?>

                            </div>
                            <div class="form-group">
                                <?php echo e(Form::label('meta_description', __('Meta Description'), ['class' => 'col-form-label'])); ?>

                                <?php echo e(Form::textarea('meta_description', !empty(admin_setting('meta_description')) ? admin_setting('meta_description') :null , ['class' => 'form-control ','required'=>'required','placeholder' => 'Meta Description','rows'=>3])); ?>

                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group mb-0">
                            <?php echo e(Form::label('Meta Image', __('Meta Image'), ['class' => 'col-form-label'])); ?>

                            </div>
                            <div class="setting-card">
                                <div class="logo-content">
                                    <img id="image2" src="<?php echo e(get_file( (!empty(admin_setting('meta_image'))) ? (check_file(admin_setting('meta_image'))) ?  admin_setting('meta_image') : 'uploads/meta/meta_image.png' : 'uploads/meta/meta_image.png'  )); ?><?php echo e('?'.time()); ?>"
                                        class="img_setting seo_image">
                                </div>
                                <div class="choose-files mt-4">
                                    <label for="meta_image">
                                        <div class="bg-primary company_favicon_update"> <i
                                                class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                        </div>
                                        <input type="file" class="form-control file" accept="image/png, image/gif, image/jpeg,image/jpg"  id="meta_image" name="meta_image" onchange="document.getElementById('image2').src = window.URL.createObjectURL(this.files[0])"
                                            data-filename="meta_image">
                                    </label>
                                </div>
                                <?php $__errorArgs = ['meta_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="row">
                                    <span class="invalid-logo" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <input class="btn btn-print-invoice btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                </div>
                <?php echo e(Form::close()); ?>

            </div>

             
             <div class="card" id="cache-sidenav">
                <div class="card-header">
                    <h5><?php echo e('Cache Settings'); ?></h5>
                    <small class="text-secondary font-weight-bold">
                        <?php echo e(__("This is a page meant for more advanced users, simply ignore it if you don't understand what cache is.")); ?>

                    </small>
                </div>
                <form method="GET" action="<?php echo e(route('config.cache')); ?>" accept-charset="UTF-8">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 form-group">
                                <?php echo e(Form::label('Current cache size', __('Current cache size'), ['class' => 'col-form-label'])); ?>

                                <div class="input-group">
                                    <input type="text" class="form-control" value="<?php echo e(CacheSize()); ?>" readonly >
                                    <div class="input-group-append">
                                        <span class="input-group-text"><?php echo e(__('MB')); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <input class="btn btn-print-invoice btn-primary m-r-10" type="submit" value="<?php echo e(__('Cache Clear')); ?>">
                    </div>
                <?php echo e(Form::close()); ?>

            </div>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('setting storage manage')): ?>
                <div class="card" id="storage-sidenav">
                    <?php echo e(Form::open(array('route' => 'storage.setting.store', 'enctype' => "multipart/form-data"))); ?>

                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <h5 class=""><?php echo e(__('Storage Settings')); ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="pe-2">
                                    <input type="radio" class="btn-check" name="storage_setting" id="local-outlined" autocomplete="off" <?php echo e(company_setting('storage_setting') == 'local'?'checked':''); ?> value="local">
                                    <label class="btn btn-outline-primary" for="local-outlined"><?php echo e(__('Local')); ?></label>
                                </div>
                                <div  class="pe-2">
                                    <input type="radio" class="btn-check" name="storage_setting" id="s3-outlined" autocomplete="off" <?php echo e(company_setting('storage_setting')=='s3'?'checked':''); ?>  value="s3">
                                    <label class="btn btn-outline-primary" for="s3-outlined"> <?php echo e(__('AWS S3')); ?></label>
                                </div>

                                <div  class="pe-2">
                                    <input type="radio" class="btn-check" name="storage_setting" id="wasabi-outlined" autocomplete="off" <?php echo e(company_setting('storage_setting')=='wasabi'?'checked':''); ?> value="wasabi">
                                    <label class="btn btn-outline-primary" for="wasabi-outlined"><?php echo e(__('Wasabi')); ?></label>
                                </div>
                            </div>
                            <hr class="mt-4">
                            <div class="local-setting row <?php echo e(company_setting('storage_setting')=='local'?' ':'d-none'); ?>">
                                <h4 class="small-title"><?php echo e(__('Local Settings')); ?></h4>
                                <div class="form-group col-12 switch-width">
                                    <?php echo e(Form::label('local_storage_validation',__('Only Upload Files'),array('class'=>' col-form-label'))); ?>

                                    <?php echo e(Form::select('local_storage_validation[]',array_flip($file_type), company_setting('local_storage_validation') , ['id' => 'local_storage_validation','class'=>" choices",'multiple'=>"",'searchEnabled'=>'true'])); ?>

                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label" for="local_storage_max_upload_size"><?php echo e(__('Max upload size ( In KB)')); ?></label>
                                        <input type="number" name="local_storage_max_upload_size" class="form-control" value="<?php echo e(company_setting('local_storage_max_upload_size')); ?>" placeholder="<?php echo e(__('Max upload size')); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="s3-setting row <?php echo e(company_setting('storage_setting')=='s3'?' ':'d-none'); ?>">
                                <h4 class="small-title mb-3"><?php echo e(__('AWS S3 Settings')); ?></h4>

                                <div class=" row ">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="s3_key"><?php echo e(__('S3 Key')); ?></label>
                                            <input type="text" name="s3_key" class="form-control" value="" placeholder="<?php echo e(__('S3 Key')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="s3_secret"><?php echo e(__('S3 Secret')); ?></label>
                                            <input type="text" name="s3_secret" class="form-control" value="" placeholder="<?php echo e(__('S3 Secret')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="s3_region"><?php echo e(__('S3 Region')); ?></label>
                                            <input type="text" name="s3_region" class="form-control" value="" placeholder="<?php echo e(__('S3 Region')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="s3_bucket"><?php echo e(__('S3 Bucket')); ?></label>
                                            <input type="text" name="s3_bucket" class="form-control" value="" placeholder="<?php echo e(__('S3 Bucket')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="s3_url"><?php echo e(__('S3 URL')); ?></label>
                                            <input type="text" name="s3_url" class="form-control" value="" placeholder="<?php echo e(__('S3 URL')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="s3_endpoint"><?php echo e(__('S3 Endpoint')); ?></label>
                                            <input type="text" name="s3_endpoint" class="form-control" value="" placeholder="<?php echo e(__('S3 Bucket')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label" for="s3_max_upload_size"><?php echo e(__('Max upload size ( In KB)')); ?></label>
                                            <input type="number" name="s3_max_upload_size" class="form-control" value="<?php echo e(company_setting('s3_max_upload_size')); ?>" placeholder="<?php echo e(__('Max upload size')); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12 switch-width">
                                    <?php echo e(Form::label('s3_storage_validation',__('Only Upload Files'),array('class'=>' col-form-label'))); ?>

                                    <?php echo e(Form::select('s3_storage_validation[]',array_flip($file_type), company_setting('s3_storage_validation') , ['id' => 's3_storage_validation','class'=>" choices",'multiple'=>""])); ?>

                                </div>
                            </div>

                            <div class="wasabi-setting row <?php echo e(company_setting('storage_setting')=='wasabi'?' ':'d-none'); ?>">
                                <h4 class="small-title mb-3"><?php echo e(__('Wasabi Settings')); ?></h4>
                                <div class=" row ">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="s3_key"><?php echo e(__('Wasabi Key')); ?></label>
                                            <input type="text" name="wasabi_key" class="form-control" value="<?php echo e(company_setting('wasabi_key')); ?>" placeholder="<?php echo e(__('Wasabi Key')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="s3_secret"><?php echo e(__('Wasabi Secret')); ?></label>
                                            <input type="text" name="wasabi_secret" class="form-control" value="<?php echo e(company_setting('wasabi_secret')); ?>" placeholder="<?php echo e(__('Wasabi Secret')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="s3_region"><?php echo e(__('Wasabi Region')); ?></label>
                                            <input type="text" name="wasabi_region" class="form-control" value="<?php echo e(company_setting('wasabi_region')); ?>" placeholder="<?php echo e(__('Wasabi Region')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="wasabi_bucket"><?php echo e(__('Wasabi Bucket')); ?></label>
                                            <input type="text" name="wasabi_bucket" class="form-control" value="<?php echo e(company_setting('wasabi_bucket')); ?>" placeholder="<?php echo e(__('Wasabi Bucket')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="wasabi_url"><?php echo e(__('Wasabi URL')); ?></label>
                                            <input type="text" name="wasabi_url" class="form-control" value="<?php echo e(company_setting('wasabi_url')); ?>" placeholder="<?php echo e(__('Wasabi URL')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="wasabi_root"><?php echo e(__('Wasabi Root')); ?></label>
                                            <input type="text" name="wasabi_root" class="form-control" value="<?php echo e(company_setting('wasabi_root')); ?>" placeholder="<?php echo e(__('Wasabi Sub Folder')); ?>">
                                            <small class="text-danger"><?php echo e(__('If a folder has been created under the bucket then enter the folder name otherwise blank')); ?> </small>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label" for="wasabi_root"><?php echo e(__('Max upload size ( In KB)')); ?></label>
                                            <input type="number" name="wasabi_max_upload_size" class="form-control" value="<?php echo e(company_setting('wasabi_max_upload_size')); ?>" placeholder="<?php echo e(__('Max upload size')); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-12 switch-width">
                                        <?php echo e(Form::label('wasabi_storage_validation',__('Only Upload Files'),array('class'=>' col-form-label'))); ?>

                                        <?php echo e(Form::select('wasabi_storage_validation[]',array_flip($file_type), company_setting('wasabi_storage_validation') , ['id' => 'wasabi_storage_validation','class'=>" choices",'multiple'=>""])); ?>

                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="card-footer text-end">
                            <input class="btn btn-print-invoice  btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                        </div>
                    <?php echo e(Form::close()); ?>

                </div>
            <?php endif; ?>
            <?php if(module_is_active('AIAssistant') || module_is_active('AIDocument') || module_is_active('AIImage')): ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('api key setting manage')): ?>
                    <div class="card" id="aidocument-sidenav">
                        <?php echo e(Form::open(['route' => 'ai.key.setting.save'])); ?>

                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <h5><?php echo e(__('Chat GPT Key Settings')); ?></h5>
                                    <small class="text-muted"><?php echo e(__('Edit your key details')); ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mt-2">
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <?php if(count($ai_key_settings)>0): ?>
                                        <?php $i=1; ?>
                                        <?php $__currentLoopData = $ai_key_settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="d-flex gap-1 mb-4">
                                            <input type="text" class="form-control" name="api_key[]" value="<?php echo e($key_data->key); ?>"/>
                                            <?php if($i==1): ?>
                                                <a href="javascript:void(0);" class="add_button btn btn-primary" title="Add field"><i class="ti ti-plus"></i></a>
                                            <?php else: ?>
                                            <a href="javascript:void(0);" class="remove_button btn btn-danger"><i class="ti ti-trash"></i></a>
                                            <?php endif; ?>
                                        </div>
                                        <?php $i++; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                        <div class="d-flex gap-1 mb-4">
                                            <input type="text" class="form-control " name="api_key[]" value=""/>

                                            <a href="javascript:void(0);" class="add_button btn btn-primary" title="Add field"><i class="ti ti-plus"></i></a>

                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <input class="btn btn-print-invoice  btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <?php echo $__env->yieldPushContent('company_setting_aftrer_site_setting_sidebar_div'); ?>

            
            <div class="card" id="bank_transfer_sidenav">
                <?php echo e(Form::open(['route' => ['bank_transfer.setting'], 'id' => 'payment-form'])); ?>

                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <h5 class=""><?php echo e(__('Bank Transfer')); ?></h5>
                            <?php if(\Auth::user()->type == "super admin"): ?>
                                <small><?php echo e(__('These details will be used to collect subscription plan payments.Each subscription plan will have a payment button based on the below configuration.')); ?></small>
                            <?php else: ?>
                                <small><?php echo e(__('These details will be used to collect invoice payments. Each invoice will have a payment button based on the below configuration.')); ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 text-end">
                            <div class="form-check form-switch custom-switch-v1 float-end">
                                <input type="checkbox" name="bank_transfer_payment_is_on" class="form-check-input input-primary" id="bank_transfer_payment_is_on" <?php echo e(company_setting('bank_transfer_payment_is_on')=='on'?' checked ':''); ?> >
                                <label class="form-check-label" for="bank_transfer_payment_is_on"></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-form-label"><?php echo e(__('Bank Details')); ?></label>
                                <textarea type="text" name="bank_number" id="bank_number" class="form-control bank_transfer_text" <?php echo e(company_setting('bank_transfer_payment_is_on') == 'on' ? '' : ' disabled'); ?> rows="3" placeholder="<?php echo e(__('Bank Transfer Number')); ?>"><?php echo e(!empty(company_setting('bank_number'))?company_setting('bank_number'):''); ?></textarea>
                                <small><?php echo e(__('Example : Bank : bank name </br> Account Number : 0000 0000 </br>')); ?></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <input class="btn btn-print-invoice btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                </div>
                <?php echo e(Form::close()); ?>


            </div>
            <?php echo $__env->yieldPushContent('payment_setting_sidebar_div'); ?>
         </div>
         <!-- [ sample-page ] end -->
      </div>
      <!-- [ Main Content ] end -->
   </div>
</div>
<!-- [ Main Content ] end -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
    $(document).on("change", "select[name='proposal_template'], input[name='proposal_color']", function () {
            var template = $("select[name='proposal_template']").val();
            var color = $("input[name='proposal_color']:checked").val();
            $('#proposal_frame').attr('src', '<?php echo e(url('/proposal/preview')); ?>/' + template + '/' + color);
        });
</script>
<script>
    $(document).on("change", "select[name='invoice_template'], input[name='invoice_color']", function () {
            var template = $("select[name='invoice_template']").val();
            var color = $("input[name='invoice_color']:checked").val();
            $('#invoice_frame').attr('src', '<?php echo e(url('/invoices/preview')); ?>/' + template + '/' + color);
        });
</script>
<script>
    $(document).on('change','[name=storage_setting]',function(){
        if($(this).val() == 's3'){
            $('.s3-setting').removeClass('d-none');
            $('.wasabi-setting').addClass('d-none');
            $('.local-setting').addClass('d-none');
        }else if($(this).val() == 'wasabi'){
            $('.s3-setting').addClass('d-none');
            $('.wasabi-setting').removeClass('d-none');
            $('.local-setting').addClass('d-none');
        }else{
            $('.s3-setting').addClass('d-none');
            $('.wasabi-setting').addClass('d-none');
            $('.local-setting').removeClass('d-none');
        }
    });
    $(document).on('change','#defult_currancy',function(){
        var sy = $('#defult_currancy option:selected').attr('data-symbol');
        $('#defult_currancy_symbol').val(sy);

    });
    function check_theme(color_val) {
        $('input[value="' + color_val + '"]').prop('checked', true);
        $('a[data-value]').removeClass('active_color');
        $('a[data-value="' + color_val + '"]').addClass('active_color');
    }
    var themescolors = document.querySelectorAll(".themes-color > a");
    for (var h = 0; h < themescolors.length; h++) {
        var c = themescolors[h];

        c.addEventListener("click", function(event) {
            var targetElement = event.target;
            if (targetElement.tagName == "SPAN") {
                targetElement = targetElement.parentNode;
            }
            var temp = targetElement.getAttribute("data-value");
            removeClassByPrefix(document.querySelector("body"), "theme-");
            document.querySelector("body").classList.add(temp);
        });
    }
    function removeClassByPrefix(node, prefix) {
        for (let i = 0; i < node.classList.length; i++) {
            let value = node.classList[i];
            if (value.startsWith(prefix)) {
                node.classList.remove(value);
            }
        }
    }
    if ($('#useradd-sidenav').length > 0) {
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300,
        });

        // $(".list-group-item").click(function(){
        //     $('.list-group-item').filter(function(){
        //         return this.href == id;
        //     }).parent().removeClass('text-primary');
        // });
    }
    function cust_theme_bg(params) {
        var custthemebg = document.querySelector("#site_transparent");
        var val = "checked";
        if (val) {
            document.querySelector(".dash-sidebar").classList.add("transprent-bg");
            document
                .querySelector(".dash-header:not(.dash-mob-header)")
                .classList.add("transprent-bg");
        } else {
            document.querySelector(".dash-sidebar").classList.remove("transprent-bg");
            document
                .querySelector(".dash-header:not(.dash-mob-header)")
                .classList.remove("transprent-bg");
        }
    }
    if ($('#site_transparent').length > 0) {
        var custthemebg = document.querySelector("#site_transparent");
        custthemebg.addEventListener("click", function() {
            if (custthemebg.checked) {
                document.querySelector(".dash-sidebar").classList.add("transprent-bg");
                document
                    .querySelector(".dash-header:not(.dash-mob-header)")
                    .classList.add("transprent-bg");
            } else {
                document.querySelector(".dash-sidebar").classList.remove("transprent-bg");
                document
                    .querySelector(".dash-header:not(.dash-mob-header)")
                    .classList.remove("transprent-bg");
            }
        });
    }




       /* Open Test Mail Modal */
       $(document).on('click', '.test-mail', function (e) {
            e.preventDefault();
            var title = $(this).attr('data-title');
            var size = 'md';
            var url = $(this).attr('data-url');
            if (typeof url != 'undefined') {
                $("#commonModal .modal-title").html(title);
                $("#commonModal .modal-dialog").addClass('modal-' + size);
                $("#commonModal").modal('show');

                $.post(url, {
                    mail_driver: $("#mail_driver").val(),
                    mail_host: $("#mail_host").val(),
                    mail_port: $("#mail_port").val(),
                    mail_username: $("#mail_username").val(),
                    mail_password: $("#mail_password").val(),
                    mail_from_address: $("#mail_from_address").val(),
                    mail_encryption: $("#mail_encryption").val(),
                    _token: "<?php echo e(csrf_token()); ?>",
                }, function (data) {
                    $('#commonModal .body').html(data);
                });
            }
        })
        /* End Test Mail Modal */

         /* Test Mail Send
        ----------------------------------------*/
        $(document).on('click', '#test-send-mail', function () {
            $('#test-mail-form').ajaxForm(function (res) {
                if (res.flag == 1) {
                    toastrs('Success',res.msg, 'success');
                    $('#commonModal').modal('hide');
                }
                else
                {
                    toastrs('Error',res.msg, 'error');
                }
            }).submit();
        });

</script>

<script>
    $(document).on('change', '#vat_gst_number_switch', function() {
        if($(this).is(':checked'))
        {
            $('.tax_type_div').removeClass('d-none');

        } else {
            $('.tax_type_div').addClass('d-none');

        }
    });
</script>

<script>
    var custdarklayout = document.querySelector("#cust-darklayout");
      custdarklayout.addEventListener("click", function () {
          if (custdarklayout.checked) {
          document.querySelector(".m-header > .b-brand > .logo-lg").setAttribute("src", "<?php echo e($light_logo); ?>");
          document.querySelector("#main-style-link").setAttribute("href", "<?php echo e(asset('assets/css/style-dark.css')); ?>");
          } else {
          document.querySelector(".m-header > .b-brand > .logo-lg").setAttribute("src", "<?php echo e($dark_logo); ?>");
          document.querySelector("#main-style-link").setAttribute("href", "<?php echo e(asset('assets/css/style.css')); ?>");
          }
      });
      function removeClassByPrefix(node, prefix) {
          for (let i = 0; i < node.classList.length; i++) {
          let value = node.classList[i];
          if (value.startsWith(prefix)) {
              node.classList.remove(value);
          }
          }
      }
</script>

<?php if(admin_setting('enable_cookie') != 'on'): ?>
<script>
    $(document).ready(function () {
        $('.cookie_setting').attr("disabled", "disabled");
    });
</script>
<?php endif; ?>
<script>
    $(document).on('click', '#enable_cookie', function() {
        if ($('#enable_cookie').prop('checked')) {
            $(".cookie_setting").removeAttr("disabled");
        } else {
            $('.cookie_setting').attr("disabled", "disabled");
        }
    });
</script>
<script>
    $(document).on('click', '#bank_transfer_payment_is_on', function() {
        if ($('#bank_transfer_payment_is_on').prop('checked')) {
            $(".bank_transfer_text").removeAttr("disabled");
        } else {
            $('.bank_transfer_text').attr("disabled", "disabled");
        }
    });
</script>

<?php if(module_is_active('AIAssistant') || module_is_active('AIDocument') || module_is_active('AIImage')): ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('api key setting manage')): ?>
    <script>
        $(document).ready(function(){
            var maxField = 100; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div class="d-flex gap-1 mb-4"><input type="text" class="form-control " name="api_key[]" value=""/><a href="javascript:void(0);" class="remove_button btn btn-danger"><i class="ti ti-trash"></i></a></div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>
    <?php endif; ?>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Koristu-latest/resources/views/settings/index.blade.php ENDPATH**/ ?>