<?php

namespace Modules\Hrm\Events;

use Illuminate\Queue\SerializesModels;

class CreateEvent
{
    use SerializesModels;

    public $request;
    public $event;

    public function __construct($request ,$event)
    {
        $this->request = $request;
        $this->event = $event;
    }
}
