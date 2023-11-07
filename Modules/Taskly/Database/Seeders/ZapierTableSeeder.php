<?php

namespace Modules\Taskly\Database\Seeders;

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
            'New Project','New Milestone','New Task','Task Stage Update','New Task Comment','New Bug'
        ];

        foreach($sub_module as $sm){
            $check = \Modules\Zapier\Entities\ZapierModule::where('module','Taskly')->where('submodule',$sm)->first();
            if(!$check){
                $new = new \Modules\Zapier\Entities\ZapierModule();
                $new->module = 'Taskly';
                $new->submodule = $sm;
                $new->save();
            }
        }
    }
}
