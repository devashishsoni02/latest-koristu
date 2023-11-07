<?php

namespace Modules\Hrm\Events;

use Illuminate\Queue\SerializesModels;

class UpdateAnnouncement
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $request;
    public $announcement;
    public function __construct($announcement,$request)
    {
        $this->request = $request;
        $this->announcement = $announcement;
    }
}
