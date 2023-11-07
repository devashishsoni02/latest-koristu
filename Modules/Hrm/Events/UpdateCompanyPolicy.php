<?php

namespace Modules\Hrm\Events;

use Illuminate\Queue\SerializesModels;

class UpdateCompanyPolicy
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $request;
    public $companyPolicy;
    public function __construct($companyPolicy,$request)
    {
        $this->request = $request;
        $this->companyPolicy = $companyPolicy;
    }
}
