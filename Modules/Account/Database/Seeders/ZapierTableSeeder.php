<?php

namespace Modules\Account\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ZapierTableSeeder extends Seeder
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
            'New Customer','New Bill','New Vendor','New Revenue','New Payment'
        ];

        foreach($sub_module as $sm){
            $check = \Modules\Zapier\Entities\ZapierModule::where('module','Account')->where('submodule',$sm)->first();
            if(!$check){
                $new = new \Modules\Zapier\Entities\ZapierModule();
                $new->module = 'Account';
                $new->submodule = $sm;
                $new->save();
            }
        }
        // $this->call("OthersTableSeeder");
    }
}
