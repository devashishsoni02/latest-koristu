<?php

namespace Modules\Lead\Database\Seeders;

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
            'New Lead','New Deal','Lead Moved','Deal Moved'
        ];

        foreach($sub_module as $sm){
            $check = \Modules\Webhook\Entities\WebhookModule::where('module','Lead')->where('submodule',$sm)->first();
            if(!$check){
                $new = new \Modules\Webhook\Entities\WebhookModule();
                $new->module = 'Lead';
                $new->submodule = $sm;
                $new->save();
            }
        }
    }
}
