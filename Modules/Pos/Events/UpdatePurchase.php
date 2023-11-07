<?php

namespace Modules\Pos\Events;

use Illuminate\Queue\SerializesModels;

class UpdatePurchase
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $request;
    public $purchase;
    public function __construct($purchase,$request)
    {
        $this->request = $request;
        $this->purchase = $purchase;
    }
}
