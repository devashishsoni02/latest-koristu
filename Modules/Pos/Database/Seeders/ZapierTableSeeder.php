<?php

namespace Modules\Pos\Database\Seeders;

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
            'New Purchase','New Warehouse'
        ];

        foreach($sub_module as $sm){
            $check = \Modules\Zapier\Entities\ZapierModule::where('module','Pos')->where('submodule',$sm)->first();
            if(!$check){
                $new = new \Modules\Zapier\Entities\ZapierModule();
                $new->module = 'Pos';
                $new->submodule = $sm;
                $new->save();
            }
        }
    }
}
