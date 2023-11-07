<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Nwidart\Modules\Facades\Module;


class CustomFieldListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sub_module = [
            'Proposal',
            'Invoice',
        ];
        $module = Module::find('CustomField');
        if(!empty($module))
        {
            foreach($sub_module as $sm){
                $check = \Modules\CustomField\Entities\CustomFieldsModuleList::where('module','Base')->where('sub_module',$sm)->first();
                if(!$check){
                    $new = new \Modules\CustomField\Entities\CustomFieldsModuleList();
                    $new->module = 'Base';
                    $new->sub_module = $sm;
                    $new->save();
                }
            }
        }
    }
}
