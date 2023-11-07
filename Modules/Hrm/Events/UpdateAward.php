<?php

namespace Modules\Hrm\Events;

use Illuminate\Queue\SerializesModels;

class UpdateAward
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $request;
    public $award;
    public function __construct($award,$request)
    {
        $this->request = $request;
        $this->award = $award;
    }
}
