<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Roles')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-action'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('roles create')): ?>
    <div>
        <a href="#" class="btn btn-sm btn-primary" data-url="<?php echo e(route('roles.create')); ?>" data-size="xl" data-bs-toggle="tooltip"  data-bs-original-title="<?php echo e(__('Create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Role')); ?>">
            <i class="ti ti-plus"></i>
        </a>
    </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table mb-0 pc-dt-simple" id="assets">
                        <thead>
                            <tr>
                                <tr>
                                    <th> <?php echo e(__('Role')); ?></th>
                                    <th> <?php echo e(__('Permissions')); ?></th>
                                    <th class="text-end" width="200px"> <?php echo e(__('Action')); ?></th>
                                </tr>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $permissions = $role->permissions()->get();
                            ?>
                            <tr>
                                <td width="150px"><?php echo e($role->name); ?></td>
                                <td class="permission">
                                    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(module_is_active($permission->module) || $permission->module == 'General'): ?>
                                            <span class="badge rounded p-2 m-1 px-3 bg-primary"> <?php echo e($permission->name); ?></span>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <td class="text-end">
                                    <span>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('roles edit')): ?>
                                        <div class="action-btn bg-info ms-2">
                                            <a  data-url="<?php echo e(route('roles.edit',$role->id)); ?>" data-size="xl" data-ajax-popup="true" data-title="<?php echo e(__('Update permission')); ?>" class="btn btn-outline btn-xs blue-madison" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                <i class="ti ti-pencil text-white"></i>
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                        <?php if(!in_array($role->name,\App\Models\User::$not_edit_role)): ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('roles delete')): ?>
                                                <div class="action-btn bg-danger ms-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-describedby="tooltip434956">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id],'id'=>'delete-form-'.$role->id]); ?>


                                                    <a type="submit" class="mx-3 btn btn-sm align-items-center show_confirm" data-toggle="tooltip" title="" data-original-title="Delete">
                                                        <i class="ti ti-trash text-white"></i>
                                                    </a>
                                                    <?php echo Form::close(); ?>

                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </span>
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
<?php $__env->startPush('scripts'); ?>
    <script>
        function Checkall(module = null) {
            var ischecked = $("#checkall-"+module).prop('checked');
            if(ischecked == true)
            {
                $('.checkbox-'+module).prop('checked',true);
            }
            else
            {
                $('.checkbox-'+module).prop('checked',false);
            }
        }
    </script>
    <script type="text/javascript">
        function CheckModule(cl = null)
        {
            var ischecked = $("#"+cl).prop('checked');
            if(ischecked == true)
            {
                $('.'+cl).find("input[type=checkbox]").prop('checked',true);
            }
            else
            {
                $('.'+cl).find("input[type=checkbox]").prop('checked',false);
            }
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Koristu-latest/resources/views/role/index.blade.php ENDPATH**/ ?>