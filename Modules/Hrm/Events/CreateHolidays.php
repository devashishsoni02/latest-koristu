<?php

namespace Modules\Hrm\Events;

use Illuminate\Queue\SerializesModels;

class CreateHolidays
{
    use SerializesModels;

    public $request;
    public $holiday;

    public function __construct($request ,$holiday)
    {
        $this->request = $request;
        $this->holiday = $holiday;
    }
}
