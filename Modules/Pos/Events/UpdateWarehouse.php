<?php

namespace Modules\Pos\Events;

use Illuminate\Queue\SerializesModels;

class UpdateWarehouse
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $request;
    public $warehouse;
    public function __construct($warehouse,$request)
    {
        $this->request = $request;
        $this->warehouse = $warehouse;
    }
}
