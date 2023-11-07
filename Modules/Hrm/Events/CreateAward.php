<?php

namespace Modules\Hrm\Events;

use Illuminate\Queue\SerializesModels;

class CreateAward
{
    use SerializesModels;

    public $request;
    public $award;

    public function __construct($request ,$award)
    {
        $this->request = $request;
        $this->award = $award;
    }
}
