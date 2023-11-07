<?php

namespace Modules\Hrm\Events;

use Illuminate\Queue\SerializesModels;

class CreateAnnouncement
{
    use SerializesModels;

    public $request;
    public $announcement;

    public function __construct($request ,$announcement)
    {
        $this->request = $request;
        $this->announcement = $announcement;
    }
}
