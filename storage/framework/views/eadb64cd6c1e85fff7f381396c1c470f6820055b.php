
<nav
    class="dash-sidebar light-sidebar <?php echo e(empty(company_setting('site_transparent')) || company_setting('site_transparent') == 'on' ? 'transprent-bg' : ''); ?>">
    <div class="navbar-wrapper">
        <div class="m-header main-logo">
            <a href="<?php echo e(url('/')); ?>" class="b-brand">
                <!-- ========   change your logo hear   ============ -->
                <img src="<?php echo e(get_file(sidebar_logo())); ?><?php echo e('?' . time()); ?>" alt="" class="logo logo-lg" />
                <img src="<?php echo e(get_file(sidebar_logo())); ?><?php echo e('?' . time()); ?>" alt="" class="logo logo-sm" />
            </a>
        </div>
        <div class="navbar-content">
            <ul class="dash-navbar">

                <?php $__currentLoopData = getSideMenu(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($menu->permissions)): ?>
                        <?php
                            $route = '#!';
                            if (!empty($menu->route)) {
                                $route = route($menu->route);
                            }
                            if (count($menu->childs) == 1) {
                                if (!empty($menu->childs[0]->route)) {
                                    $route = route($menu->childs[0]->route);
                                }
                            }

                        ?>

                        <li class="dash-item dash-hasmenu">
                            <a href="<?php echo e($route); ?>" class="dash-link <?php echo e($menu->permissions); ?>">
                                <span class="dash-micon"><i class="<?php echo e($menu->icon); ?>"></i></span>
                                <span class="dash-mtext"><?php echo e(__($menu->title)); ?></span>
                                <?php if(count($menu->childs) > 1): ?>
                                    <span class="dash-arrow">
                                        <i data-feather="chevron-right"></i>
                                    </span>
                                <?php endif; ?>
                            </a>

                            <?php if(count($menu->childs) > 1): ?>
                                <?php echo $__env->make('partials.submenu', [
                                    'childs' => $menu->childs,
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>
                        </li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->yieldPushContent('custom_side_menu'); ?>
            </ul>
        </div>
    </div>
</nav>
<?php /**PATH /opt/lampp/htdocs/Koristu-latest/resources/views/partials/sidebar.blade.php ENDPATH**/ ?>