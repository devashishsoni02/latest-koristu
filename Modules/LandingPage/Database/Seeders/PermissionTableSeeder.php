<?php

namespace Modules\LandingPage\Database\Seeders;

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
            'landingpage manage',
            'landingpage create',
            'landingpage edit',
            'landingpage store',
            'landingpage update',
            'landingpage delete',
            'marketplace manage',
            'marketplace create',
            'marketplace edit',
            'marketplace store',
            'marketplace update',
            'marketplace delete',
        ];

        $super_admin = Role::where('name','super admin')->first();

        foreach ($permission as $key => $value) {
            $table = Permission::where('name', $value)->where('module', 'LandingPage')->exists();
            if (!$table) {
                $data = Permission::create(
                    [
                        'name' => $value,
                        'guard_name' => 'web',
                        'module' => 'LandingPage',
                        'created_by' => 0,
                        "created_at" => date('Y-m-d H:i:s'),
                        "updated_at" => date('Y-m-d H:i:s')
                    ]
                );
                $super_admin->givePermissionTo($data);
            }
        }
        // $this->call("OthersTableSeeder");
    }
}
