<?php

namespace Modules\Hrm\Events;

use Illuminate\Queue\SerializesModels;

class DestroyLeave
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $leave;
    public function __construct($leave)
    {
        $this->leave = $leave;
    }
}
