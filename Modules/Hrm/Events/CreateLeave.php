<?php

namespace Modules\Hrm\Events;

use Illuminate\Queue\SerializesModels;

class CreateLeave
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $request;
    public $leave;
    public function __construct($request,$leave)
    {
        $this->request = $request;
        $this->leave = $leave;
    }
}
