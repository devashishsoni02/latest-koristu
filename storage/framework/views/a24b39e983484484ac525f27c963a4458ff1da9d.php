<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('hrm manage')): ?>
    <div class="card" id="hrm-sidenav">
        <?php echo e(Form::open(['route' => 'hrm.setting.store', 'id' => 'hrm_setting_store'])); ?>

        <div class="card-header">
            <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-10">
                    <h5 class=""><?php echo e(__('HRM Settings')); ?></h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mt-2">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="employee_prefix" class="form-label"><?php echo e(__('Employee Prefix')); ?></label>
                        <input type="text" name="employee_prefix" class="form-control"
                            placeholder="<?php echo e(__('Employee Prefix')); ?>"
                            value="<?php echo e(!empty(company_setting('employee_prefix')) ? company_setting('employee_prefix') : '#EMP000'); ?>"
                            id="employee_prefix">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="company_start_time" class="form-label"><?php echo e(__('Company Start Time')); ?></label>
                        <input type="time" name="company_start_time" class="form-control"
                            value="<?php echo e(!empty(company_setting('company_start_time')) ? company_setting('company_start_time') : '09:00'); ?>"
                            id="company_start_time">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="company_end_time" class="form-label"><?php echo e(__('Company End Time')); ?></label>
                        <input type="time" name="company_end_time" class="form-control"
                            value="<?php echo e(!empty(company_setting('company_end_time')) ? company_setting('company_end_time') : '18:00'); ?>"
                            id="company_end_time">
                    </div>
                </div>

                <?php if(Auth::user()->can('ip restrict manage')): ?>
                    <div class="col-md-4">
                        <div class="form-group col switch-width">
                            <?php echo e(Form::label('ip_restrict', __('IP Restrict'), ['class' => ' col-form-label'])); ?>

                            <div class="custom-control custom-switch float-end">
                                <input type="checkbox" data-toggle="switchbutton" data-onstyle="primary"
                                    class="form-check-input decimal_format ip_restrict" name="ip_restrict" id="ip_restrict"
                                    <?php echo e(company_setting('ip_restrict') == 'on' ? 'checked' : ''); ?>>
                                <label class="form-check-label form-label" for="ip_restrict"></label>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php echo e(Form::close()); ?>


            </div>
        </div>
        <div class="card-footer text-end">
            <input class="btn btn-print-invoice  btn-primary m-r-10 hrm_setting_btn" type="button"
                value="<?php echo e(__('Save Changes')); ?>">
        </div>
    </div>

    <div class="ip_restrict_div <?php echo e(company_setting('ip_restrict') != 'on' ? ' d-none ' : ''); ?>" id="ip_restrict">
        <div class="card">
            <?php if(Auth::user()->can('ip restrict create')): ?>
                <div class="card-header d-flex justify-content-between">

                    <h5><?php echo e(__('IP Restriction Settings')); ?></h5>
                    <a data-url="<?php echo e(route('iprestrict.create')); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                        data-bs-original-title="<?php echo e(__('Create New IP')); ?>" data-bs-placement="top" data-size="md"
                        data-ajax-popup="true" data-title="<?php echo e(__('Create New IP')); ?>">
                        <i class="ti ti-plus"></i>
                    </a>
                </div>
            <?php endif; ?>
            <div class="table-border-style">
                <div class="card-body" style="max-height: 290px; overflow:auto">
                    <div class="table-responsive">
                        <table class="table" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th class="w-75"> <?php echo e(__('IP')); ?></th>
                                    <th width="200px"> <?php echo e('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $ips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="Action">
                                        <td class="sorting_1"><?php echo e($ip->ip); ?></td>
                                        <td class="">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ip restrict edit')): ?>
                                                <div class="action-btn bg-info ms-2">
                                                    <a class="mx-3 btn btn-sm  align-items-center"
                                                        data-url="<?php echo e(route('iprestrict.edit', $ip->id)); ?>" data-size="md"
                                                        data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Edit')); ?>"
                                                        data-bs-placement="top" data-ajax-popup="true"
                                                        data-title="<?php echo e(__('Edit IP')); ?>" class="edit-icon"
                                                        data-original-title="<?php echo e(__('Edit')); ?>"><i
                                                            class="ti ti-pencil text-white"></i></a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ip restrict delete')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo e(Form::open(['method' => 'DELETE', 'route' => ['iprestrict.destroy', $ip->id], 'class' => 'm-0'])); ?>


                                                    <a class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm"
                                                        data-bs-toggle="tooltip" title="" data-bs-original-title="Delete"
                                                        aria-label="Delete" data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                        data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                        data-confirm-yes="delete-form-<?php echo e($ip->id); ?>"><i
                                                            class="ti ti-trash text-white text-white"></i></a>
                                                    <?php echo e(Form::close()); ?>

                                                </div>
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

<?php endif; ?>
<?php if(module_is_active('Recruitment')): ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('letter offer manage')): ?>
        <div class="" id="offer-letter-settings">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5><?php echo e(__('Offer Letter Settings')); ?></h5>
                    <div class="d-flex justify-content-end drp-languages">
                            <?php if(module_is_active('AIAssistant')): ?>
                                <?php echo $__env->make('aiassistant::ai.generate_ai_btn',['template_module' => 'offer letter settings','module'=>'Recruitment'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>
                        <ul class="list-unstyled mb-0 m-2">
                            <li class="dropdown dash-h-item drp-language" style="margin-top: -19px;">
                                <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                                    role="button" aria-haspopup="false" aria-expanded="false" id="dropdownLanguage">
                                    <span class="drp-text hide-mob text-primary">
                                        <?php echo e(Str::upper($offerlang)); ?>

                                    </span>
                                    <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                                </a>
                                <div class="dropdown-menu dash-h-dropdown dropdown-menu-end"
                                    aria-labelledby="dropdownLanguage">
                                    <?php $__currentLoopData = languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $offerlangs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(route('settings.index', ['noclangs' => $noclang, 'explangs' => $explang, 'joininglangs' => $joininglang, 'offerlangs' => $key])); ?>"
                                            class="dropdown-item ms-1 <?php echo e($key == $offerlang ? 'text-primary' : ''); ?>"><?php echo e(Str::ucfirst($offerlangs)); ?></a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body ">
                    <h5 class="font-weight-bold pb-3"><?php echo e(__('Placeholders')); ?></h5>

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header card-body">
                                <div class="row text-xs">
                                    <div class="row">
                                        <p class="col-4"><?php echo e(__('Applicant Name')); ?> : <span
                                                class="pull-end text-primary">{applicant_name}</span></p>
                                        <p class="col-4"><?php echo e(__('Company Name')); ?> : <span
                                                class="pull-right text-primary">{app_name}</span></p>
                                        <p class="col-4"><?php echo e(__('Job title')); ?> : <span
                                                class="pull-right text-primary">{job_title}</span></p>
                                        <p class="col-4"><?php echo e(__('Job type')); ?> : <span
                                                class="pull-right text-primary">{job_type}</span></p>
                                        <p class="col-4"><?php echo e(__('Proposed Start Date')); ?> : <span
                                                class="pull-right text-primary">{start_date}</span></p>
                                        <p class="col-4"><?php echo e(__('Working Location')); ?> : <span
                                                class="pull-right text-primary">{workplace_location}</span></p>
                                        <p class="col-4"><?php echo e(__('Days Of Week')); ?> : <span
                                                class="pull-right text-primary">{days_of_week}</span></p>
                                        <p class="col-4"><?php echo e(__('Salary')); ?> : <span
                                                class="pull-right text-primary">{salary}</span></p>
                                        <p class="col-4"><?php echo e(__('Salary Type')); ?> : <span
                                                class="pull-right text-primary">{salary_type}</span></p>
                                        <p class="col-4"><?php echo e(__('Salary Duration')); ?> : <span
                                                class="pull-end text-primary">{salary_duration}</span></p>
                                        <p class="col-4"><?php echo e(__('Offer Expiration Date')); ?> : <span
                                                class="pull-right text-primary">{offer_expiration_date}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-border-style ">

                    <?php echo e(Form::open(['route' => ['offerlatter.update', $offerlang], 'method' => 'post'])); ?>

                    <div class="form-group col-12">
                        <?php echo e(Form::label('offer_content', __(' Format'), ['class' => 'form-label text-dark'])); ?>

                        <textarea name="offer_content" class="ckdescription" id="offer_content"><?php echo isset($currOfferletterLang->content) ? $currOfferletterLang->content : ''; ?></textarea>
                    </div>
                    <div class="card-footer text-end">

                        <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn  btn-primary'])); ?>

                    </div>

                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('letter joining manage')): ?>
    <div class="" id="joining-letter-settings">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5><?php echo e(__('Joining Letter Settings')); ?></h5>
                <div class="d-flex justify-content-end drp-languages">
                    <?php if(module_is_active('AIAssistant')): ?>
                        <?php echo $__env->make('aiassistant::ai.generate_ai_btn',['template_module' => 'joining letter settings','module'=>'Hrm'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                    <ul class="list-unstyled mb-0 m-2">
                        <li class="dropdown dash-h-item drp-language" style="margin-top: -19px;">
                            <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                                role="button" aria-haspopup="false" aria-expanded="false" id="dropdownLanguage1">
                                <span class="drp-text hide-mob text-primary">

                                    <?php echo e(Str::upper($joininglang)); ?>

                                </span>
                                <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                            </a>
                            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end"
                                aria-labelledby="dropdownLanguage1">
                                <?php $__currentLoopData = languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $joininglangs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('settings.index', ['noclangs' => $noclang, 'explangs' => $explang, 'joininglangs' => $key, 'offerlangs' => $offerlang])); ?>"
                                        class="dropdown-item <?php echo e($key == $joininglang ? 'text-primary' : ''); ?>"><?php echo e(Str::ucfirst($joininglangs)); ?></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </li>

                    </ul>
                </div>

            </div>
            <div class="card-body ">
                <h5 class="font-weight-bold pb-3"><?php echo e(__('Placeholders')); ?></h5>

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header card-body">
                            <div class="row text-xs">
                                <div class="row">
                                    <p class="col-4"><?php echo e(__('Applicant Name')); ?> : <span
                                            class="pull-end text-primary">{date}</span></p>
                                    <p class="col-4"><?php echo e(__('Company Name')); ?> : <span
                                            class="pull-right text-primary">{app_name}</span></p>
                                    <p class="col-4"><?php echo e(__('Employee Name')); ?> : <span
                                            class="pull-right text-primary">{employee_name}</span></p>
                                    <p class="col-4"><?php echo e(__('Address')); ?> : <span
                                            class="pull-right text-primary">{address}</span></p>
                                    <p class="col-4"><?php echo e(__('Designation')); ?> : <span
                                            class="pull-right text-primary">{designation}</span></p>
                                    <p class="col-4"><?php echo e(__('Start Date')); ?> : <span
                                            class="pull-right text-primary">{start_date}</span></p>
                                    <p class="col-4"><?php echo e(__('Branch')); ?> : <span
                                            class="pull-right text-primary">{branch}</span></p>
                                    <p class="col-4"><?php echo e(__('Start Time')); ?> : <span
                                            class="pull-end text-primary">{start_time}</span></p>
                                    <p class="col-4"><?php echo e(__('End Time')); ?> : <span
                                            class="pull-right text-primary">{end_time}</span></p>
                                    <p class="col-4"><?php echo e(__('Number of Hours')); ?> : <span
                                            class="pull-right text-primary">{total_hours}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-border-style ">
                <?php echo e(Form::open(['route' => ['joiningletter.update', $joininglang], 'method' => 'post'])); ?>

                <div class="form-group col-12">
                    <?php echo e(Form::label('joining_content', __(' Format'), ['class' => 'form-label text-dark'])); ?>

                    <textarea name="joining_content" class="ckdescription" id="joining_content" ><?php echo isset($currjoiningletterLang->content) ? $currjoiningletterLang->content : ''; ?></textarea>
                </div>
                <div class="card-footer text-end">
                    <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn  btn-primary'])); ?>

                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('letter certificate manage')): ?>
    <div class="" id="experience-certificate-settings">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5><?php echo e(__('Certificate of Experience Settings')); ?></h5>
                <div class="d-flex justify-content-end drp-languages">
                    <?php if(module_is_active('AIAssistant')): ?>
                        <?php echo $__env->make('aiassistant::ai.generate_ai_btn',['template_module' => 'experience certificate settings','module'=>'Hrm'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                    <ul class="list-unstyled mb-0 m-2">
                        <li class="dropdown dash-h-item drp-language" style="margin-top: -19px;">
                            <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                                role="button" aria-haspopup="false" aria-expanded="false" id="dropdownLanguage1">
                                <span class="drp-text hide-mob text-primary">

                                    <?php echo e(Str::upper($explang)); ?>

                                </span>
                                <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                            </a>
                            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end"
                                aria-labelledby="dropdownLanguage1">
                                <?php $__currentLoopData = languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $explangs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('settings.index', ['noclangs' => $noclang, 'explangs' => $key, 'joininglangs' => $joininglang, 'offerlangs' => $offerlang])); ?>"
                                        class="dropdown-item <?php echo e($key == $explang ? 'text-primary' : ''); ?>"><?php echo e(Str::ucfirst($explangs)); ?></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </li>

                    </ul>
                </div>

            </div>
            <div class="card-body ">
                <h5 class="font-weight-bold pb-3"><?php echo e(__('Placeholders')); ?></h5>

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header card-body">
                            <div class="row text-xs">
                                <div class="row">
                                    <p class="col-4"><?php echo e(__('Company Name')); ?> : <span
                                            class="pull-right text-primary">{app_name}</span></p>
                                    <p class="col-4"><?php echo e(__('Employee Name')); ?> : <span
                                            class="pull-right text-primary">{employee_name}</span></p>
                                    <p class="col-4"><?php echo e(__('Date of Issuance')); ?> : <span
                                            class="pull-right text-primary">{date}</span></p>
                                    <p class="col-4"><?php echo e(__('Designation')); ?> : <span
                                            class="pull-right text-primary">{designation}</span></p>
                                    <p class="col-4"><?php echo e(__('Start Date')); ?> : <span
                                            class="pull-right text-primary">{start_date}</span></p>
                                    <p class="col-4"><?php echo e(__('Branch')); ?> : <span
                                            class="pull-right text-primary">{branch}</span></p>
                                    <p class="col-4"><?php echo e(__('Start Time')); ?> : <span
                                            class="pull-end text-primary">{start_time}</span></p>
                                    <p class="col-4"><?php echo e(__('End Time')); ?> : <span
                                            class="pull-right text-primary">{end_time}</span></p>
                                    <p class="col-4"><?php echo e(__('Number of Hours')); ?> : <span
                                            class="pull-right text-primary">{total_hours}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-border-style ">

                <?php echo e(Form::open(['route' => ['experiencecertificate.update', $explang], 'method' => 'post'])); ?>

                <div class="form-group col-12">
                    <?php echo e(Form::label('experience_content', __(' Format'), ['class' => 'form-label text-dark'])); ?>

                    <textarea name="experience_content" class="ckdescription" id="experience_content"><?php echo isset($curr_exp_cetificate_Lang->content) ? $curr_exp_cetificate_Lang->content : ''; ?></textarea>


                </div>

                <div class="card-footer text-end">

                    <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn  btn-primary'])); ?>

                </div>

                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('letter noc manage')): ?>
    <div class="" id="noc-settings">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5><?php echo e(__('No Objection Certificate Settings')); ?></h5>
                <div class="d-flex justify-content-end drp-languages">
                    <?php if(module_is_active('AIAssistant')): ?>
                        <?php echo $__env->make('aiassistant::ai.generate_ai_btn',['template_module' => 'noc settings','module'=>'Hrm'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                    <ul class="list-unstyled mb-0 m-2">
                        <li class="dropdown dash-h-item drp-language" style="margin-top: -19px;">
                            <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                                role="button" aria-haspopup="false" aria-expanded="false" id="dropdownLanguage1">
                                <span class="drp-text hide-mob text-primary">

                                    <?php echo e(Str::upper($noclang)); ?>

                                </span>
                                <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                            </a>
                            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end"
                                aria-labelledby="dropdownLanguage1">
                                <?php $__currentLoopData = languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $noclangs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('settings.index', ['noclangs' => $key, 'explangs' => $explang, 'joininglangs' => $joininglang, 'offerlangs' => $offerlang])); ?>"
                                        class="dropdown-item <?php echo e($key == $noclang ? 'text-primary' : ''); ?>"><?php echo e(Str::ucfirst($noclangs)); ?></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </li>

                    </ul>
                </div>

            </div>
            <div class="card-body ">
                <h5 class="font-weight-bold pb-3"><?php echo e(__('Placeholders')); ?></h5>

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header card-body">
                            <div class="row text-xs">
                                <div class="row">
                                    <p class="col-4"><?php echo e(__('Date')); ?> : <span
                                            class="pull-end text-primary">{date}</span></p>
                                    <p class="col-4"><?php echo e(__('Company Name')); ?> : <span
                                            class="pull-right text-primary">{app_name}</span></p>
                                    <p class="col-4"><?php echo e(__('Employee Name')); ?> : <span
                                            class="pull-right text-primary">{employee_name}</span></p>
                                    <p class="col-4"><?php echo e(__('Designation')); ?> : <span
                                            class="pull-right text-primary">{designation}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-border-style ">
                <?php echo e(Form::open(['route' => ['noc.update', $noclang], 'method' => 'post'])); ?>

                <div class="form-group col-12">
                    <?php echo e(Form::label('noc_content', __(' Format'), ['class' => 'form-label text-dark'])); ?>

                    <textarea name="noc_content" class="ckdescription" id="noc_content"><?php echo isset($currnocLang->content) ? $currnocLang->content : ''; ?></textarea>

                </div>

                <div class="card-footer text-end">

                    <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn  btn-primary'])); ?>

                </div>

                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
<?php endif; ?>

<link rel="stylesheet" href="<?php echo e(asset('Modules/Hrm/Resources/assets/css/custom.css')); ?>">

<?php $__env->startPush('scripts'); ?>
<script src="//cdn.ckeditor.com/4.12.1/basic/ckeditor.js"></script>
<script src="<?php echo e(asset('Modules/Hrm/Resources/assets/js/editorplaceholder.js')); ?>"></script>

    <script>
        $(".hrm_setting_btn").click(function() {
            $("#hrm_setting_store").submit();
        });
    </script>
    <script>
        $(document).on('change', '#ip_restrict', function() {
            if ($(this).is(':checked')) {
                $('.ip_restrict_div').removeClass('d-none');

            } else {
                $('.ip_restrict_div').addClass('d-none');

            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $.each($('.ckdescription'), function(i, editor) {
                CKEDITOR.replace(editor, {
                    height: 300,
                    extraPlugins: 'editorplaceholder',
                    editorplaceholder: editor.placeholder
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /opt/lampp/htdocs/Koristu-latest/Modules/Hrm/Resources/views/setting/nav_containt_div.blade.php ENDPATH**/ ?>