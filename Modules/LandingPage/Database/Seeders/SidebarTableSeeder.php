<?php

namespace Modules\LandingPage\Database\Seeders;

use App\Models\Sidebar;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SidebarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $check = Sidebar::where('title',__('CMS'))->where('parent_id',0)->where('type','super admin')->exists();
        if(!$check)
        {
            $sidebar = Sidebar::create( [
                'title' => 'CMS',
                'icon' => 'ti ti-package',
                'parent_id' => 0,
                'sort_order' => 430,
                'route' => '',
                'permissions' => 'landingpage manage',
                'type'   => 'super admin',
                'module' => 'LandingPage',
            ]);
        }

        if(isset($sidebar)){

            $landingpage = Sidebar::where('title',__('Landing Page'))->where('parent_id',$sidebar->id)->where('type','super admin')->exists();

            if(!$landingpage)
            {
                Sidebar::create( [
                    'title' => 'Landing Page',
                    'icon' => 'ti ti-settings',
                    'parent_id' => $sidebar->id,
                    'sort_order' => 10,
                    'route' => 'landingpage.index',
                    'permissions' => 'landingpage manage',
                    'type'   => 'super admin',
                    'module' => 'LandingPage',
                ]);
            }

            $marketplace = Sidebar::where('title',__('Marketplace'))->where('parent_id',$sidebar->id)->where('type','super admin')->exists();

            if(!$marketplace)
            {
                Sidebar::create( [
                    'title' => 'Marketplace',
                    'icon' => 'ti ti-settings',
                    'parent_id' => $sidebar->id,
                    'sort_order' => 20,
                    'route' => 'marketplace.index',
                    'permissions' => 'landingpage manage',
                    'type'   => 'super admin',
                    'module' => 'LandingPage',
                ]);
            }
        }
    }
}
