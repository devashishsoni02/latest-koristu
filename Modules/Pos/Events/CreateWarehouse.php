<?php

namespace Modules\Pos\Events;

use Illuminate\Queue\SerializesModels;

class CreateWarehouse
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $request;
    public $warehouse;

    public function __construct($request ,$warehouse)
    {
        $this->request = $request;
        $this->warehouse = $warehouse;
    }

}
