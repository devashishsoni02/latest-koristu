<?php

namespace Modules\Pos\Events;

use Illuminate\Queue\SerializesModels;

class DestroyWarehouse
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $warehouse;
    public function __construct($warehouse)
    {
        $this->warehouse = $warehouse;
    }
}
