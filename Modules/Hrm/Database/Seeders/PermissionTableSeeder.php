<?php

namespace Modules\Hrm\Database\Seeders;

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
            'hrm manage',
            'hrm dashboard manage',
            'sidebar hrm report manage',
            'document manage',
            'document create',
            'document edit',
            'document delete',
            'attendance manage',
            'attendance create',
            'attendance edit',
            'attendance delete',
            'attendance import',
            'branch manage',
            'branch create',
            'branch edit',
            'branch delete',
            'department manage',
            'department create',
            'department edit',
            'department delete',
            'designation manage',
            'designation create',
            'designation edit',
            'designation delete',
            'employee manage',
            'employee create',
            'employee edit',
            'employee delete',
            'employee show',
            'employee profile manage',
            'employee profile show',
            'employee import',
            'documenttype manage',
            'documenttype create',
            'documenttype edit',
            'documenttype delete',
            'companypolicy manage',
            'companypolicy create',
            'companypolicy edit',
            'companypolicy delete',
            'leave manage',
            'leave create',
            'leave edit',
            'leave delete',
            'leave approver manage',
            'leavetype manage',
            'leavetype create',
            'leavetype edit',
            'leavetype delete',
            'award manage',
            'award create',
            'award edit',
            'award delete',
            'awardtype manage',
            'awardtype create',
            'awardtype edit',
            'awardtype delete',
            'transfer manage',
            'transfer create',
            'transfer edit',
            'transfer delete',
            'resignation manage',
            'resignation create',
            'resignation edit',
            'resignation delete',
            'travel manage',
            'travel create',
            'travel edit',
            'travel delete',
            'promotion manage',
            'promotion create',
            'promotion edit',
            'promotion delete',
            'complaint manage',
            'complaint create',
            'complaint edit',
            'complaint delete',
            'warning manage',
            'warning create',
            'warning edit',
            'warning delete',
            'termination manage',
            'termination create',
            'termination edit',
            'termination delete',
            'termination description',
            'terminationtype manage',
            'terminationtype create',
            'terminationtype edit',
            'terminationtype delete',
            'announcement manage',
            'announcement create',
            'announcement edit',
            'announcement delete',
            'holiday manage',
            'holiday create',
            'holiday edit',
            'holiday delete',
            'holiday import',
            'attendance report manage',
            'leave report manage',
            'paysliptype manage',
            'paysliptype create',
            'paysliptype edit',
            'paysliptype delete',
            'allowanceoption manage',
            'allowanceoption create',
            'allowanceoption edit',
            'allowanceoption delete',
            'loanoption manage',
            'loanoption create',
            'loanoption edit',
            'loanoption delete',
            'deductionoption manage',
            'deductionoption create',
            'deductionoption edit',
            'deductionoption delete',
            'setsalary manage',
            'setsalary pay slip manage',
            'setsalary create',
            'setsalary edit',
            'setsalary show',
            'allowance manage',
            'allowance create',
            'allowance edit',
            'allowance delete',
            'commission manage',
            'commission create',
            'commission edit',
            'commission delete',
            'loan manage',
            'loan create',
            'loan edit',
            'loan delete',
            'saturation deduction manage',
            'saturation deduction create',
            'saturation deduction edit',
            'saturation deduction delete',
            'other payment manage',
            'other payment create',
            'other payment edit',
            'other payment delete',
            'overtime manage',
            'overtime create',
            'overtime edit',
            'overtime delete',
            'branch name edit',
            'department name edit',
            'designation name edit',
            'event manage',
            'event create',
            'event edit',
            'event delete',
            'sidebar payroll manage',
            'sidebar hr admin  manage',
            'letter joining manage',
            'letter certificate manage',
            'letter noc manage',
            'ip restrict manage',
            'ip restrict create',
            'ip restrict edit',
            'ip restrict delete'
        ];

        $company_role = Role::where('name','company')->first();
        foreach ($permission as $key => $value)
        {
            $table = Permission::where('name',$value)->where('module','Hrm')->exists();
            if(!$table)
            {
                Permission::create(
                    [
                        'name' => $value,
                        'guard_name' => 'web',
                        'module' => 'Hrm',
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
