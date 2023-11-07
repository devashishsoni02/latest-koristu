<?php

namespace Modules\Account\Database\Seeders;

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
                'account dashboard manage',
                'bank account manage',
                'bank account create',
                'bank account edit',
                'bank account delete',
                'bank transfer manage',
                'bank transfer create',
                'bank transfer edit',
                'bank transfer delete',
                'account manage',
                'customer manage',
                'customer create',
                'customer edit',
                'customer delete',
                'customer show',
                'customer import',
                'vendor manage',
                'vendor create',
                'vendor edit',
                'vendor delete',
                'vendor show',
                'vendor import',
                'creditnote manage',
                'creditnote create',
                'creditnote edit',
                'creditnote delete',
                'revenue manage',
                'revenue create',
                'revenue edit',
                'revenue delete',
                'report manage',
                'bill manage',
                'bill create',
                'bill edit',
                'bill delete',
                'bill payment manage',
                'bill payment create',
                'bill payment edit',
                'bill payment delete',
                'bill show',
                'bill duplicate',
                'bill product delete',
                'bill send',
                'debitnote manage',
                'debitnote create',
                'debitnote edit',
                'debitnote delete',
                'expense payment manage',
                'expense payment create',
                'expense payment edit',
                'expense payment delete',
                'report transaction manage',
                'report statement manage',
                'report income manage',
                'report expense',
                'report income vs expense manage',
                'report tax manage',
                'report loss & profit  manage',
                'report invoice manage',
                'report bill manage',
                'report stock manage',
                'sidebar income manage',
                'sidebar expanse manage',
                'sidebar banking manage',
        ];

        $company_role = Role::where('name','company')->first();
        foreach ($permission as $key => $value)
        {
            $table = Permission::where('name',$value)->where('module','Account')->exists();
            if(!$table)
            {
                $data = Permission::create(
                    [
                        'name' => $value,
                        'guard_name' => 'web',
                        'module' => 'Account',
                        'created_by' => 0,
                        "created_at" => date('Y-m-d H:i:s'),
                        "updated_at" => date('Y-m-d H:i:s')
                    ]
                );
                $company_role->givePermissionTo($data);
            }
        }

    }

}
