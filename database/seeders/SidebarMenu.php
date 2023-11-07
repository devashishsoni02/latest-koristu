<?php

namespace Database\Seeders;

use App\Models\Sidebar;
use App\Models\sidebarMenuDependency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SidebarMenu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = [
            0 =>[
                'title'      => __('Dashboard'),
                'icon'       => 'ti ti-home',
                'parent_id'  => '0',
                'sort_order' => '0',
                'route'      => 'home',
                'is_visible' => 1,
                'type'       => 'super admin',
                'module'     => 'Base'
            ],
            1 => [
                'title'      => __('Customers'),
                'icon'       => 'ti ti-users',
                'parent_id'  => '0',
                'sort_order' => '100',
                'route'      => 'users.index',
                'is_visible' => 1,
                'permissions'=> 'user manage',
                'type'       => 'super admin',
                'module'     => 'Base'
            ],
            2 => [
                'title'      => __('Subscription'),
                'icon'       => 'ti ti-trophy',
                'parent_id'  => '0',
                'sort_order' => '200',
                'route'      => '',
                'is_visible' => 1,
                'permissions'=> '',
                'type'       => 'super admin',
                'module'     => 'Base'
            ],
            3 => [
                'title'      => __('Email Template'),
                'icon'       => 'ti ti-template',
                'parent_id'  => '0',
                'sort_order' => '300',
                'route'      => 'email-templates.index',
                'is_visible' => 1,
                'permissions'=> 'email template manage',
                'type'       => 'super admin',
                'module'     => 'Base'
            ],
            4 => [
                'title'      => __('Settings'),
                'icon'       => 'ti ti-settings',
                'parent_id'  => '0',
                'sort_order' => '700',
                'route'      => 'settings.index',
                'is_visible' => 1,
                'permissions'=> 'setting manage',
                'type'       => 'super admin',
                'module'     => 'Base'
            ],
            5 => [
                'title'      => __('Add-on Manager'),
                'icon'       => 'ti ti-layout-2',
                'parent_id'  => '0',
                'sort_order' => '800',
                'route'      => 'module.index',
                'is_visible' => 1,
                'permissions'=> 'module manage',
                'type'       => 'super admin',
                'module'     => 'Base'
            ],
        ];

        foreach($superadmin as $sm)
        {
            $check = Sidebar::where('title',$sm['title'])->where('parent_id',$sm['parent_id'])->where('type','super admin')->exists();
            if(!$check)
            {
                $sidebar             = new Sidebar();
                $sidebar->title      = $sm['title'];
                $sidebar->parent_id  = $sm['parent_id'];
                $sidebar->icon       = $sm['icon'];
                $sidebar->sort_order = $sm['sort_order'];
                $sidebar->route      = $sm['route'];
                $sidebar->is_visible = $sm['is_visible'];
                $sidebar->permissions= !empty($sm['permissions']) ? $sm['permissions'] : null;
                $sidebar->module     = $sm['module'];
                $sidebar->type       = $sm['type'];
                $sidebar->save();
            }
        }

        $superadmin_sub_menu = [
            0 =>[
                'title'      => __("Subscription Setting"),
                'icon'       => '',
                'parent'  => __('Subscription'),
                'sort_order' => '10',
                'route'      => 'plan.list',
                'is_visible' => 1,
                'permissions'=> 'plan manage',
                'module'     => 'Base'
            ],
            1 =>[
                'title'      => __("Coupon"),
                'icon'       => '',
                'parent'  => __('Subscription'),
                'sort_order' => '40',
                'route'      => 'coupons.index',
                'is_visible' => 1,
                'permissions'=> 'coupon manage',
                'module'     => 'Base'
            ],
            2 => [
                'title'      => __('Order'),
                'icon'       => '',
                'parent'  => __('Subscription'),
                'sort_order' => '20',
                'route'      => 'plan.order.index',
                'is_visible' => 1,
                'permissions'=> 'plan orders',
                'type'       => 'super admin',
                'module'     => 'Base'
            ],
            3 => [
                'title'      => __('Bank Transfer Request'),
                'icon'       => '',
                'parent'  => __('Subscription'),
                'sort_order' => '30',
                'route'      => 'bank-transfer-request.index',
                'is_visible' => 1,
                'permissions'=> 'plan orders',
                'type'       => 'super admin',
                'module'     => 'Base'
            ]
        ];
        foreach($superadmin_sub_menu as $csm)
        {
            $find = Sidebar::where('title', $csm['parent'])->where('type','super admin')->first();
            if($find)
            {
                $check = Sidebar::where('title',$csm['title'])->where('parent_id',$find->id)->where('type','super admin')->exists();
                if(!$check)
                {
                    $sidebar = new Sidebar();
                    $sidebar->title      = $csm['title'];
                    $sidebar->parent_id  = $find->id;
                    $sidebar->icon       = $csm['icon'];
                    $sidebar->sort_order = $csm['sort_order'];
                    $sidebar->route      = $csm['route'];
                    $sidebar->is_visible = $csm['is_visible'];
                    $sidebar->permissions= $csm['permissions'];
                    $sidebar->type       = 'super admin';
                    $sidebar->module     = $csm['module'];
                    $sidebar->save();
                }
            }
        }

        $company_menu = [
            0 =>[
                'title'      => __('Dashboard'),
                'icon'       => 'ti ti-home',
                'parent_id'  => '0',
                'sort_order' => '0',
                'route'      => '',
                'is_visible' => 1,
                'module'     => 'Base'
            ],
            1 => [
                'title'      => __('User Management'),
                'icon'       => 'ti ti-users',
                'parent_id'  => '0',
                'sort_order' => '100',
                'route'      => '',
                'is_visible' => 1,
                'permissions'=> 'user manage',
                'module'     => 'Base'
            ],

            2 => [
                'title'      => __('Proposal'),
                'icon'       => 'ti ti-replace',
                'parent_id'  => '0',
                'sort_order' => '200',
                'route'      => 'proposal.index',
                'is_visible' => 1,
                'permissions'=> 'proposal manage',
                'module'     => 'Base',
                'dependency' => 'Account,Taskly'
            ],
            3 => [
                'title'      => __('Invoice'),
                'icon'       => 'ti ti-file-invoice',
                'parent_id'  => '0',
                'sort_order' => '300',
                'route'      => 'invoice.index',
                'is_visible' => 1,
                'permissions'=> 'invoice manage',
                'module'     => 'Base',
                'dependency' => 'Account,Taskly'
            ],
            4 => [
                'title'      => __('Messenger'),
                'icon'       => 'ti ti-brand-hipchat',
                'parent_id'  => '0',
                'sort_order' => '500',
                'route'      => 'chatify',
                'is_visible' => 1,
                'permissions'=> 'user chat manage',
                'module'     => 'Base'
            ],
            5 => [
                'title'      => __('Settings'),
                'icon'       => 'ti ti-settings',
                'parent_id'  => '0',
                'sort_order' => '900',
                'route'      => '',
                'is_visible' => 1,
                'permissions'=> 'setting manage',
                'module'     => 'Base'
            ]
        ];


        foreach($company_menu as $cm)
                {
                    $check = Sidebar::where('title',$cm['title'])->where('parent_id',$cm['parent_id'])->where('type','company')->exists();
                    if(!$check)
                    {
                        $sidebar             = new Sidebar();
                        $sidebar->title      = $cm['title'];
                        $sidebar->parent_id  = $cm['parent_id'];
                        $sidebar->icon       = $cm['icon'];
                        $sidebar->sort_order = $cm['sort_order'];
                        $sidebar->route      = $cm['route'];
                        $sidebar->is_visible = $cm['is_visible'];
                        $sidebar->permissions= !empty($cm['permissions']) ? $cm['permissions'] : null;
                        $sidebar->type       = 'company';
                        $sidebar->module     = $cm['module'];
                        $sidebar->dependency = !empty($cm['dependency']) ? $cm['dependency'] : null ;
                        $sidebar->save();

                        // Sidebar Performance Changes

                        if(!empty($cm['dependency'])){
                            $depends = explode(',',$cm['dependency']);
                            $dependency = sidebarMenuDependency::whereIn('module',$depends)->where('sidebar_id',$sidebar->id)->first();
                            if(!$dependency){
                                foreach($depends as $depend){

                                    sidebarMenuDependency::create([
                                        'sidebar_id' => $sidebar->id,
                                        'module' => $depend,
                                    ]);
                                }
                            }
                        }
                    }
                }

        $comapny_sub_menu = [
            0 =>[
                'title'      => __('User'),
                'icon'       => '',
                'parent'  => __('User Management'),
                'sort_order' => '0',
                'route'      => 'users.index',
                'is_visible' => 1,
                'permissions'=> 'user manage',
                'module'     => 'Base'
            ],
            2 => [
                'title'      => __('Role'),
                'icon'       => '',
                'parent'     => __('User Management'),
                'sort_order' => '10',
                'route'      => 'roles.index',
                'is_visible' => 1,
                'permissions'=> 'roles manage',
                'module'     => 'Base'
            ],
            3 => [
                'title'      => __('System Settings'),
                'icon'       => '',
                'parent'     => __('Settings'),
                'sort_order' => '10',
                'route'      => 'settings.index',
                'is_visible' => 1,
                'permissions'=> 'setting manage',
                'module'     => 'Base'
            ],
            4 => [
                'title'      => __('Setup Subscription Plan'),
                'icon'       => '',
                'parent'     => __('Settings'),
                'sort_order' => '30',
                'route'      => 'plans.index',
                'is_visible' => 1,
                'permissions'=> 'plan manage',
                'module'     => 'Base'
            ],
            5 => [
                'title'      => __('Order'),
                'icon'       => '',
                'parent'     => __('Settings'),
                'sort_order' => '40',
                'route'      => 'plan.order.index',
                'is_visible' => 1,
                'permissions'=> 'plan orders',
                'module'     => 'Base'
            ],
        ];
        foreach($comapny_sub_menu as $csm)
        {
            $find = Sidebar::where('title', $csm['parent'])->where('type','company')->first();
            if($find)
            {
                $check = Sidebar::where('title',$csm['title'])->where('parent_id',$find->id)->where('type','company')->exists();
                if(!$check)
                {
                    $sidebar = new Sidebar();
                    $sidebar->title      = $csm['title'];
                    $sidebar->parent_id  = $find->id;
                    $sidebar->icon       = $csm['icon'];
                    $sidebar->sort_order = $csm['sort_order'];
                    $sidebar->route      = $csm['route'];
                    $sidebar->is_visible = $csm['is_visible'];
                    $sidebar->permissions= $csm['permissions'];
                    $sidebar->module     = $csm['module'];
                    $sidebar->type       = 'company';
                    $sidebar->save();
                }
            }
        }
    }
}
