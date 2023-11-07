<?php

namespace Modules\Taskly\Events;

use Illuminate\Queue\SerializesModels;

class Updateproject
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $request;
    public $project;

    public function __construct($request,$project)
    {
        $this->request = $request;
        $this->project = $project;
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
