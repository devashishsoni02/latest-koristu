<?php

namespace Modules\Hrm\Events;

use Illuminate\Queue\SerializesModels;

class DestroyMonthlyPayslip
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $payslip;
    public function __construct($payslip)
    {
        $this->payslip = $payslip;
    }
}
