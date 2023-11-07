<?php

namespace Modules\Stripe\Database\Seeders;

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
            'stripe manage',
        ];

        $company_role = Role::where('name','company')->first();
        $super_admin = Role::where('name','super admin')->first();
        foreach ($permission as $key => $value)
        {
            $table = Permission::where('name',$value)->where('module','Stripe')->exists();
            if(!$table)
            {
                $data = Permission::create(
                    [
                        'name' => $value,
                        'guard_name' => 'web',
                        'module' => 'Stripe',
                        'created_by' => 0,
                        "created_at" => date('Y-m-d H:i:s'),
                        "updated_at" => date('Y-m-d H:i:s')
                    ]
                );
                $company_role->givePermissionTo($data);
                $super_admin->givePermissionTo($data);
            }
        }
    }
}
