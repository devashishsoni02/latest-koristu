<?php

namespace Modules\Pos\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class PermissionTableSeeder extends Seeder
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
            'pos manage',
            'pos show',
            'pos dashboard manage',
            'pos add manage',
            'pos cart manage',
            'warehouse manage',
            'warehouse create',
            'warehouse edit',
            'warehouse delete',
            'warehouse show',
            'warehouse import',
            'purchase manage',
            'purchase create',
            'purchase edit',
            'purchase delete',
            'purchase show',
            'purchase send',
            'purchase payment create',
            'purchase payment delete',
            'purchase product delete',
            'report warehouse',
            'report purchase',
            'report pos',
            'report pos vs expense',
        ];

        $company_role = Role::where('name','company')->first();
        foreach ($permission as $key => $value)
        {
            $table = Permission::where('name',$value)->where('module','Pos')->exists();
            if(!$table)
            {
                Permission::create(
                    [
                        'name' => $value,
                        'guard_name' => 'web',
                        'module' => 'Pos',
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
