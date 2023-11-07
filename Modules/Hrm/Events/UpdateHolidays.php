<?php

namespace Modules\Hrm\Events;

use Illuminate\Queue\SerializesModels;

class UpdateHolidays
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $request;
    public $holiday;
    public function __construct($holiday,$request)
    {
        $this->request = $request;
        $this->holiday = $holiday;
    }
}
