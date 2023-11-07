<?php

namespace Modules\Hrm\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\WorkSpace;
use Rawilk\Settings\Support\Context;
use Symfony\Component\Mailer\Transport\Dsn;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'dob',
        'gender',
        'phone',
        'address',
        'email',
        'password',
        'employee_id',
        'branch_id',
        'department_id',
        'designation_id',
        'company_doj',
        'documents',
        'account_holder_name',
        'account_number',
        'bank_name',
        'bank_identifier_code',
        'branch_location',
        'tax_payer_id',
        'salary_type',
        'salary',
        'is_active',
        'workspace',
        'created_by',
    ];

    protected static function newFactory()
    {
        return \Modules\Hrm\Database\factories\EmployeeFactory::new();
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function branch()
    {
        return $this->hasOne(Branch::class, 'id', 'branch_id');
    }
    public static function Branchs($id)
    {
        return Branch::where('id', $id)->first();
    }
    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }
    public static function Departments($id)
    {
        return Department::where('id', $id)->first();
    }
    public function designation()
    {
        return $this->hasOne(Designation::class, 'id', 'designation_id');
    }
    public static function Designations($id)
    {
        return Designation::where('id', $id)->first();
    }

    public static function employeeIdFormat($number)
    {
        $employee_prefix = !empty(company_setting('employee_prefix')) ? company_setting('employee_prefix') : '#EMP000';
        return $employee_prefix . sprintf("%05d", $number);
    }
    public static function present_status($employee_id, $data)
    {
        return Attendance::where('employee_id', $employee_id)->where('date', $data)->first();
    }
    public function documents()
    {
        return $this->hasOne(EmployeeDocument::class, 'employee_id', 'employee_id');
    }
    public static function getEmployee($employee)
    {
        $employee = User::where('id', '=', $employee)->first();
        $employee = !empty($employee) ? $employee : null;
        return $employee;
    }
    public static function GetEmployeeByEmp($employee)
    {
        $employee = Employee::where('id', '=', $employee)->first();
        $employee = !empty($employee) ? $employee : null;
        return $employee;
    }
    public function salary_type()
    {
        return $this->hasOne(PayslipType::class, 'id', 'salary_type')->pluck('name')->first();
    }
    public function get_net_salary()
    {

        //allowance

        $allowances      = Allowance::where('employee_id', '=', $this->id)->get();
        $total_allowance = 0;
        foreach ($allowances as $allowance) {
            if ($allowance->type == 'percentage') {
                $employee          = Employee::find($allowance->employee_id);
                $total_allowance  = $allowance->amount * $employee->salary / 100  + $total_allowance;
            } else {
                $total_allowance = $allowance->amount + $total_allowance;
            }
        }

        //commission
        $commissions      = Commission::where('employee_id', '=', $this->id)->get();

        $total_commission = 0;
        foreach ($commissions as $commission) {
            if ($commission->type == 'percentage') {
                $employee          = Employee::find($commission->employee_id);
                $total_commission  = $commission->amount * $employee->salary / 100 + $total_commission;
            } else {
                $total_commission = $commission->amount + $total_commission;
            }
        }



        //Loan
        $loans      = Loan::where('employee_id', '=', $this->id)->get();
        $total_loan = 0;
        foreach ($loans as $loan) {
            if ($loan->type == 'percentage') {
                $employee = Employee::find($loan->employee_id);
                $total_loan  = $loan->amount * $employee->salary / 100   + $total_loan;
            } else {
                $total_loan = $loan->amount + $total_loan;
            }
        }

        //Saturation Deduction
        $saturation_deductions      = SaturationDeduction::where('employee_id', '=', $this->id)->get();
        $total_saturation_deduction = 0;
        foreach ($saturation_deductions as $saturation_deduction) {
            if ($saturation_deduction->type == 'percentage') {
                $employee          = Employee::find($saturation_deduction->employee_id);
                $total_saturation_deduction  = $saturation_deduction->amount * $employee->salary / 100 + $total_saturation_deduction;
            } else {
                $total_saturation_deduction = $saturation_deduction->amount + $total_saturation_deduction;
            }
        }

        //OtherPayment
        $other_payments      = OtherPayment::where('employee_id', '=', $this->id)->get();
        $total_other_payment = 0;
        foreach ($other_payments as $other_payment) {
            if ($other_payment->type == 'percentage') {
                $employee          = Employee::find($other_payment->employee_id);
                $total_other_payment  = $other_payment->amount * $employee->salary / 100  + $total_other_payment;
            } else {
                $total_other_payment = $other_payment->amount + $total_other_payment;
            }
        }

        //Overtime
        $over_times      = Overtime::where('employee_id', '=', $this->id)->get();
        $total_over_time = 0;
        foreach ($over_times as $over_time) {
            $total_work      = $over_time->number_of_days * $over_time->hours;
            $amount          = $total_work * $over_time->rate;
            $total_over_time = $amount + $total_over_time;
        }


        //Net Salary Calculate
        $advance_salary = $total_allowance + $total_commission - $total_loan - $total_saturation_deduction + $total_other_payment + $total_over_time;

        $employee       = Employee::where('id', '=', $this->id)->first();

        $net_salary     = (!empty($employee->salary) ? $employee->salary : 0) + $advance_salary;

        return $net_salary;
    }
    public static function allowance($id)
    {
        //allowance
        $allowances      = Allowance::where('employee_id', '=', $id)->get();
        $total_allowance = 0;
        foreach ($allowances as $allowance) {
            $total_allowance = $allowance->amount + $total_allowance;
        }

        $allowance_json = json_encode($allowances);

        return $allowance_json;
    }

    public static function commission($id)
    {
        //commission
        $commissions      = Commission::where('employee_id', '=', $id)->get();
        $total_commission = 0;

        foreach ($commissions as $commission) {
            $total_commission = $commission->amount + $total_commission;
        }
        $commission_json = json_encode($commissions);

        return $commission_json;
    }

    public static function loan($id)
    {
        //Loan
        $loans      = Loan::where('employee_id', '=', $id)->get();
        $total_loan = 0;
        foreach ($loans as $loan) {
            $total_loan = $loan->amount + $total_loan;
        }
        $loan_json = json_encode($loans);

        return $loan_json;
    }

    public static function saturation_deduction($id)
    {
        //Saturation Deduction
        $saturation_deductions      = SaturationDeduction::where('employee_id', '=', $id)->get();
        $total_saturation_deduction = 0;
        foreach ($saturation_deductions as $saturation_deduction) {
            $total_saturation_deduction = $saturation_deduction->amount + $total_saturation_deduction;
        }
        $saturation_deduction_json = json_encode($saturation_deductions);

        return $saturation_deduction_json;
    }

    public static function other_payment($id)
    {
        //OtherPayment
        $other_payments      = OtherPayment::where('employee_id', '=', $id)->get();
        $total_other_payment = 0;
        foreach ($other_payments as $other_payment) {
            $total_other_payment = $other_payment->amount + $total_other_payment;
        }
        $other_payment_json = json_encode($other_payments);

        return $other_payment_json;
    }

    public static function overtime($id)
    {
        //Overtime
        $over_times      = Overtime::where('employee_id', '=', $id)->get();
        $total_over_time = 0;
        foreach ($over_times as $over_time) {
            $total_work      = $over_time->number_of_days * $over_time->hours;
            $amount          = $total_work * $over_time->rate;
            $total_over_time = $amount + $total_over_time;
        }
        $over_time_json = json_encode($over_times);

        return $over_time_json;
    }
    public static function employeePayslipDetail($employeeId, $month)
    {

        $payslip_data = PaySlip::where('employee_id', $employeeId)->where('salary_month', $month)->first();
        $totalAllowance = 0;
        $totalCommission = 0;
        $totalotherpayment = 0;
        $ot = 0;
        $totalloan = 0;
        $totaldeduction = 0;
        // allowance

       if(!empty($payslip_data))
       {
        $allowances = json_decode($payslip_data->allowance);
        foreach ($allowances as $allowance) {
            if ($allowance->type == 'percentage') {
                $empall  = $allowance->amount * $payslip_data->basic_salary / 100;
            } else {
                $empall = $allowance->amount;
            }
            $totalAllowance += $empall;
        }
        // commission

        $commissions = json_decode($payslip_data->commission);
        foreach ($commissions as $commission) {

            if ($commission->type == 'percentage') {
                $empcom  = $commission->amount * $payslip_data->basic_salary / 100;
            } else {
                $empcom = $commission->amount;
            }
            $totalCommission += $empcom;
        }

        // otherpayment


        $otherpayments = json_decode($payslip_data->other_payment);
        foreach ($otherpayments as $otherpayment) {
            if ($otherpayment->type == 'percentage') {
                $empotherpay  = $otherpayment->amount * $payslip_data->basic_salary / 100;
            } else {
                $empotherpay = $otherpayment->amount;
            }
            $totalotherpayment += $empotherpay;
        }
        //overtime

        $overtimes = json_decode($payslip_data->overtime);
        foreach ($overtimes as $overtime) {
            $OverTime = $overtime->number_of_days * $overtime->hours * $overtime->rate;
            $ot += $OverTime;
        }

        // loan


        $loans = json_decode($payslip_data->loan);

        foreach ($loans as $loan)
        {
            if ($loan->type == 'percentage') {
                $emploan  = $loan->amount * $payslip_data->basic_salary / 100;
            } else {
                $emploan = $loan->amount;
            }
            $totalloan += $emploan;
        }

        // saturation_deduction

        $deductions = json_decode($payslip_data->saturation_deduction);
        foreach ($deductions as $deduction)
        {
            if ($deduction->type == 'percentage')
            {
                $empdeduction  = $deduction->amount * $payslip_data->basic_salary / 100;
            }
            else
            {
                $empdeduction = $deduction->amount;
            }
            $totaldeduction += $empdeduction;
        }

       }

        $payslip['payslip']        = $payslip_data;
        $payslip['totalEarning']   = $totalAllowance + $totalCommission + $totalotherpayment + $ot;
        $payslip['totalDeduction'] = $totalloan + $totaldeduction;

        $payslip['allowance'] = $totalAllowance;
        $payslip['commission'] = $totalCommission;
        $payslip['other_payment'] = $totalotherpayment;
        $payslip['overtime'] = $ot;
        $payslip['loan'] = $totalloan;
        $payslip['saturation_deduction'] = $totaldeduction;
        return $payslip;
    }
    public static function countEmployees($id = null)
    {
        if ($id == null) {
            $id = \Auth::user()->id;
        }
        return Employee::where('created_by', '=', $id)->count();
    }
    public static function defaultJoiningLetterRegister($user_id)
    {

        foreach ($defaultTemplate as $lang => $content) {
            JoiningLetter::create(
                [
                    'lang' => $lang,
                    'content' => $content,
                    'created_by' => $user_id,

                ]
            );
        }
    }
    public static function defaultdata($company_id = null, $workspace_id = null)
    {
        $company_setting = [
            "employee_prefix" => "#EMP",
            "company_start_time" => "09:00",
            "company_end_time" => "18:00",
        ];

        if ($company_id == Null) {
            $companys = User::where('type', 'company')->get();
            foreach ($companys as $company) {
                $WorkSpaces = WorkSpace::where('created_by', $company->id)->get();
                foreach ($WorkSpaces as $WorkSpace) {
                    JoiningLetter::defaultJoiningLetter($company->id, $WorkSpace->id);
                    ExperienceCertificate::defaultExpCertificat($company->id, $WorkSpace->id);
                    NOC::defaultNocCertificate($company->id, $WorkSpace->id);

                    $userContext = new Context(['user_id' => $company->id, 'workspace_id' => !empty($WorkSpace->id) ? $WorkSpace->id : 0]);
                    foreach ($company_setting as $key =>  $p) {
                        \Settings::context($userContext)->set($key, $p);
                    }
                }
            }
        } elseif ($workspace_id == Null) {
            $company = User::where('type', 'company')->where('id', $company_id)->first();
            $WorkSpaces = WorkSpace::where('created_by', $company->id)->get();
            foreach ($WorkSpaces as $WorkSpace) {
                JoiningLetter::defaultJoiningLetter($company->id, $WorkSpace->id);
                ExperienceCertificate::defaultExpCertificat($company->id, $WorkSpace->id);
                NOC::defaultNocCertificate($company->id, $WorkSpace->id);
                $userContext = new Context(['user_id' => $company->id, 'workspace_id' => !empty($WorkSpace->id) ? $WorkSpace->id : 0]);
                foreach ($company_setting as $key =>  $p) {
                    \Settings::context($userContext)->set($key, $p);
                }
            }
        } else {
            $company = User::where('type', 'company')->where('id', $company_id)->first();
            $WorkSpace = WorkSpace::where('created_by', $company->id)->where('id', $workspace_id)->first();
            $userContext = new Context(['user_id' => $company->id, 'workspace_id' => !empty($WorkSpace->id) ? $WorkSpace->id : 0]);
            foreach ($company_setting as $key =>  $p) {
                JoiningLetter::defaultJoiningLetter($company->id, $WorkSpace->id);
                ExperienceCertificate::defaultExpCertificat($company->id, $WorkSpace->id);
                NOC::defaultNocCertificate($company->id, $WorkSpace->id);
                \Settings::context($userContext)->set($key, $p);
            }
        }
    }
    public static function GivePermissionToRoles($role_id = null, $rolename = null)
    {
        $staff_permission = [
            'hrm dashboard manage',
            'document manage',
            'attendance manage',
            'employee profile manage',
            'employee profile show',
            'hrm manage',
            'companypolicy manage',
            'leave manage',
            'leave create',
            'leave edit',
            'award manage',
            'transfer manage',
            'resignation manage',
            'travel manage',
            'promotion manage',
            'complaint manage',
            'complaint create',
            'complaint edit',
            'complaint delete',
            'warning manage',
            'termination manage',
            'announcement manage',
            'holiday manage',
            'attendance report manage',
            'leave report manage',
            'setsalary show',
            'setsalary manage',
            'setsalary pay slip manage',
            'allowance manage',
            'commission manage',
            'loan manage',
            'saturation deduction manage',
            'other payment manage',
            'overtime manage',
            'sidebar hr admin  manage',
            'sidebar payroll manage',
            'employee manage',
            'employee show',



        ];

        if ($role_id == Null) {

            // staff
            $roles_v = Role::where('name', 'staff')->get();

            foreach ($roles_v as $role) {
                foreach ($staff_permission as $permission_v) {
                    $permission = Permission::where('name', $permission_v)->first();
                    $role->givePermissionTo($permission);
                }
            }
        } else {
            if ($rolename == 'staff') {
                $roles_v = Role::where('name', 'staff')->where('id', $role_id)->first();
                foreach ($staff_permission as $permission_v) {
                    $permission = Permission::where('name', $permission_v)->first();
                    $roles_v->givePermissionTo($permission);
                }
            }
        }
    }
    public static function PayrollCalculation($EmpID = null,$months = null,$type = null)
    {
        if(!empty($EmpID) && !empty($type) && count($months) > 0)
        {
            $data = [];
            foreach ($months as $key => $month)
            {
                $payslip_data = Employee::employeePayslipDetail($EmpID,$month);
                $data[] = $payslip_data[$type];
            }
            $data[] = array_sum($data);
            return $data;
        }
        else
        {
            return [];
        }
    }
}
