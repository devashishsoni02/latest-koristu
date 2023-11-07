<?php

namespace Modules\Hrm\Events;

use Illuminate\Queue\SerializesModels;

class DestroyEvent
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $event;
    public function __construct($event)
    {
        $this->event = $event;
    }
}
