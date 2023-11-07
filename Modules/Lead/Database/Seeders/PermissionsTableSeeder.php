<?php

namespace Modules\Lead\Database\Seeders;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Artisan::call('cache:clear');
        $permission  = [
            'crm manage',
            'crm dashboard manage',
            'crm setup manage',
            'crm report manage',
            'lead manage',
            'lead create',
            'lead edit',
            'lead delete',
            'lead show',
            'lead move',
            'lead import',
            'lead call create',
            'lead call edit',
            'lead call delete',
            'lead email create',
            'lead to deal convert',
            'lead report',
            'deal report',
            'deal manage',
            'deal create',
            'deal edit',
            'deal delete',
            'deal show',
            'deal move',
            'deal import',
            'deal task create',
            'deal task edit',
            'deal task delete',
            'deal task show',
            'deal call create',
            'deal call edit',
            'deal call delete',
            'deal email create',
            'pipeline manage',
            'pipeline create',
            'pipeline edit',
            'pipeline delete',
            'dealstages manage',
            'dealstages create',
            'dealstages edit',
            'dealstages delete',
            'leadstages manage',
            'leadstages create',
            'leadstages edit',
            'leadstages delete',
            'labels manage',
            'labels create',
            'labels edit',
            'labels delete',
            'source manage',
            'source create',
            'source edit',
            'source delete',
            'lead task create',
            'lead task edit',
            'lead task delete',
        ];

        $company_role = Role::where('name','company')->first();
        foreach ($permission as $key => $value)
        {
            $table = Permission::where('name',$value)->where('module','Lead')->exists();
            if(!$table)
            {
                Permission::create(
                    [
                        'name' => $value,
                        'guard_name' => 'web',
                        'module' => 'Lead',
                        'created_by' => 0,
                        "created_at" => date('Y-m-d H:i:s'),
                        "updated_at" => date('Y-m-d H:i:s')
                    ]
                );
                $permission = Permission::findByName($value);
                $company_role->givePermissionTo($permission);
            }
        }
    }
}
