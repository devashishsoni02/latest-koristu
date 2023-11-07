<header class="dash-header <?php echo e(empty(company_setting('site_transparent')) || company_setting('site_transparent') =='on'?'transprent-bg':''); ?>">
    <div class="header-wrapper">
       <div class="me-auto dash-mob-drp">
          <ul class="list-unstyled">
             <li class="dash-h-item mob-hamburger">
                <a href="#!" class="dash-head-link" id="mobile-collapse">
                   <div class="hamburger hamburger--arrowturn">
                      <div class="hamburger-box">
                         <div class="hamburger-inner"></div>
                      </div>
                   </div>
                </a>
             </li>

             <li class="dropdown dash-h-item drp-company">
                <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"aria-expanded="false">
                    <?php if(!empty(Auth::user()->avatar)): ?>
                        <span class="theme-avtar">
                            <img alt="#" src="<?php echo e(check_file(Auth::user()->avatar) ?  get_file(Auth::user()->avatar) : ''); ?>" class="img-fluid rounded-circle" style="width: 100%">
                        </span>
                    <?php else: ?>
                        <span class="theme-avtar"><?php echo e(substr(Auth::user()->name, 0, 1)); ?></span>
                    <?php endif; ?>
                    <span class="hide-mob ms-2"><?php echo e(Auth::user()->name); ?></span>
                    <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                </a>
                <div class="dropdown-menu dash-h-dropdown">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user profile manage')): ?>
                        <a href="<?php echo e(route('profile')); ?>" class="dropdown-item">
                            <i class="ti ti-user"></i>
                            <span><?php echo e(__('Profile')); ?></span>
                        </a>
                    <?php endif; ?>
                    <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="dropdown-item">
                        <i class="ti ti-power"></i>
                        <span><?php echo e(__('Logout')); ?></span>
                    </a>
                    <form id="frm-logout" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                       <?php echo e(csrf_field()); ?>

                    </form>
                </div>
             </li>

          </ul>
       </div>
       <div class="ms-auto">
          <ul class="list-unstyled">
            <?php if (is_impersonating($guard = null)) : ?>
                    <li class="dropdown dash-h-item drp-company">
                        <a class="btn btn-danger btn-sm me-3"
                            href="<?php echo e(route('exit.company')); ?>"><i class="ti ti-ban"></i>
                            <?php echo e(__('Exit Company Login')); ?>

                        </a>
                    </li>
            <?php endif; ?>
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user chat manage')): ?>
                <?php
                        $unseenCounter = App\Models\ChMessage::where('to_id', Auth::user()->id)
                            ->where('seen', 0)
                            ->count();
                    ?>
                <li class="dash-h-item">
                    <a class="dash-head-link me-0" href="<?php echo e(url('/chatify')); ?>">
                        <i class="ti ti-message-circle"></i>
                        <span
                            class="bg-danger dash-h-badge message-counter custom_messanger_counter"><?php echo e($unseenCounter); ?><span
                                class="sr-only"></span>
                    </a>
                </li>
              <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('workspace create')): ?>
                    <?php if(PlanCheck('Workspace',Auth::user()->id) == true): ?>
                        <li class="dash-h-item">
                            <a href="#!" class="dash-head-link dropdown-toggle arrow-none me-0 cust-btn" data-url="<?php echo e(route('workspace.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Workspace')); ?>">
                                <i class="ti ti-circle-plus"></i>
                                <span class="hide-mob"><?php echo e(__('Create Workspace')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('workspace manage')): ?>
                    <li class="dropdown dash-h-item drp-language">
                        <a class="dash-head-link dropdown-toggle arrow-none me-0 cust-btn" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false" data-bs-placement="bottom" data-bs-original-title="Select your bussiness">
                            <i class="ti ti-apps"></i>
                            <span class="hide-mob"><?php echo e(Auth::user()->ActiveWorkspaceName()); ?></span>
                            <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                        </a>
                        <div class="dropdown-menu dash-h-dropdown dropdown-menu-end" style="">
                            <?php $__currentLoopData = getWorkspace(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $workspace): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($workspace->id == getActiveWorkSpace()): ?>
                                <div class="d-flex justify-content-between bd-highlight">
                                    <a href=" # " class="dropdown-item ">
                                            <i class="ti ti-checks text-primary"></i>
                                            <span><?php echo e($workspace->name); ?></span>
                                            <?php if($workspace->created_by == Auth::user()->id): ?>
                                                <span class="badge bg-dark"> <?php echo e(Auth::user()->getRoleNames()[0]); ?></span>
                                            <?php else: ?>
                                                <span class="badge bg-dark"> <?php echo e(__('Shared')); ?></span>
                                            <?php endif; ?>
                                    </a>
                                    <?php if($workspace->created_by == Auth::user()->id): ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('workspace edit')): ?>
                                            <div class="action-btn mt-2">
                                                <a data-url="<?php echo e(route('workspace.edit', $workspace->id)); ?>" class="mx-3 btn"
                                                    data-ajax-popup="true" data-title="<?php echo e(__('Edit Workspace Name')); ?>"
                                                    data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                    <i class="ti ti-pencil text-success"></i>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                  </div>
                                <?php else: ?>
                                    <a href="<?php echo e(route('workspace.change',$workspace->id)); ?>" class="dropdown-item" >
                                        <span><?php echo e($workspace->name); ?></span>
                                        <?php if($workspace->created_by == Auth::user()->id): ?>
                                            <span class="badge bg-dark"> <?php echo e(Auth::user()->getRoleNames()[0]); ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-dark"> <?php echo e(__('Shared')); ?></span>
                                        <?php endif; ?>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if(getWorkspace()->count() > 1): ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('workspace delete')): ?>
                                <hr class="dropdown-divider" />
                                <form id="remove-workspace-form" action="<?php echo e(route('workspace.destroy',getActiveWorkSpace())); ?>" method="POST" >
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <a href="#!" class="dropdown-item remove_workspace">
                                        <i class="ti ti-circle-x"></i>
                                        <span><?php echo e(__('Remove')); ?></span> <br>
                                        <small class="text-danger"><?php echo e(__('Active Workspace Will Consider')); ?></small>
                                    </a>
                                </form>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endif; ?>

             <li class="dropdown dash-h-item drp-language">
                <a
                   class="dash-head-link dropdown-toggle arrow-none me-0"
                   data-bs-toggle="dropdown"
                   href="#"
                   role="button"
                   aria-haspopup="false"
                   aria-expanded="false"
                   >
                <i class="ti ti-world nocolor"></i>
                <span class="drp-text hide-mob"><?php echo e(Str::upper(getActiveLanguage())); ?></span>
                <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                </a>
                <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">

                    <?php $__currentLoopData = languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('lang.change',$key)); ?>" class="dropdown-item <?php if($key == getActiveLanguage()): ?> text-danger <?php endif; ?>">
                            <span><?php echo e(Str::ucfirst($language)); ?></span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if(Auth::user()->type == "super admin"): ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('language create')): ?>
                            <a href="#" data-url="<?php echo e(route('create.language')); ?>" class="dropdown-item border-top pt-3 text-primary" data-ajax-popup="true" data-title="<?php echo e(__('Create New Language')); ?>">
                                <span><?php echo e(__('Create Language')); ?></span>
                            </a>

                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('language manage')): ?>
                            <a href="<?php echo e(route('lang.index',[Auth::user()->lang])); ?>" class="dropdown-item  pt-3 text-primary">
                                <span><?php echo e(__('Manage Languages')); ?></span>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
             </li>
          </ul>
       </div>
    </div>
 </header>
<?php /**PATH /opt/lampp/htdocs/Koristu-latest/resources/views/partials/header.blade.php ENDPATH**/ ?>