<?php

namespace Modules\Hrm\Events;

use Illuminate\Queue\SerializesModels;

class UpdateEvent
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $request;
    public $event;
    public function __construct($event,$request)
    {
        $this->request = $request;
        $this->event = $event;
    }
}
