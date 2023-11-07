<?php

namespace Modules\Hrm\Events;

use Illuminate\Queue\SerializesModels;

class UpdateLeave
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $request;
    public $leave;
    public function __construct($leave,$request)
    {
        $this->request = $request;
        $this->leave = $leave;
    }
}
