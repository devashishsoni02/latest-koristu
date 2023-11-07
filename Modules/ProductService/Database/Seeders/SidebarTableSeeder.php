<?php

namespace Modules\ProductService\Database\Seeders;

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
        $check = Sidebar::where('title',__('Product & Service'))->where('type','company')->exists();
        if(!$check){
            Sidebar::create( [
                'title' => __('Product & Service'),
                'icon' => 'ti ti-shopping-cart',
                'parent_id' => 0,
                'sort_order' => 150,
                'route' => 'product-service.index',
                'module' => 'ProductService',
                'type' => 'company',
                'permissions' => 'product&service manage',
            ]);
        }
    }
}
