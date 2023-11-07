<?php

namespace Modules\Hrm\Events;

use Illuminate\Queue\SerializesModels;

class CreateTrip
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $request;
    public $travel;
    public function __construct($travel,$request)
    {
        $this->request = $request;
        $this->travel = $travel;
    }
}
