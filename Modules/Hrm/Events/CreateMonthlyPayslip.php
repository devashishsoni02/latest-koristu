<?php

namespace Modules\Hrm\Events;

use Illuminate\Queue\SerializesModels;

class CreateMonthlyPayslip
{
    use SerializesModels;

    public $request;
    public $payslipEmployee;

    public function __construct($request ,$payslipEmployee)
    {
        $this->request = $request;
        $this->payslipEmployee = $payslipEmployee;
    }
}
