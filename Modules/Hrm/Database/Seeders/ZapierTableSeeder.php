<?php

namespace Modules\Hrm\Database\Seeders;

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
            'New Award','New Announcement','New Holidays','New Monthly Payslip','New Event','New Company Policy'
        ];

        foreach($sub_module as $sm){
            $check = \Modules\Zapier\Entities\ZapierModule::where('module','Hrm')->where('submodule',$sm)->first();
            if(!$check){
                $new = new \Modules\Zapier\Entities\ZapierModule();
                $new->module = 'Hrm';
                $new->submodule = $sm;
                $new->save();
            }
        }
        // $this->call("OthersTableSeeder");
    }
}
