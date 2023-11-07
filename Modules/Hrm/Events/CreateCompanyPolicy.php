<?php

namespace Modules\Hrm\Events;

use Illuminate\Queue\SerializesModels;

class CreateCompanyPolicy
{
    use SerializesModels;

    public $request;
    public $policy;

    public function __construct($request ,$policy)
    {
        $this->request = $request;
        $this->policy = $policy;
    }
}
