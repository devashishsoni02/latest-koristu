<?php

namespace Modules\Taskly\Events;

use Illuminate\Queue\SerializesModels;

class BugStageSystemSetup
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $request;
    
    public function __construct($request)
    {
        $this->request = $request;

    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
