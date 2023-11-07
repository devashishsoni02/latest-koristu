<?php

namespace Modules\ProductService\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class WebhookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $sub_module = [
            'New Product'
        ];

        foreach($sub_module as $sm){
            $check = \Modules\Webhook\Entities\WebhookModule::where('module','ProductService')->where('submodule',$sm)->first();
            if(!$check){
                $new = new \Modules\Webhook\Entities\WebhookModule();
                $new->module = 'ProductService';
                $new->submodule = $sm;
                $new->save();
            }
        }
    }
}
