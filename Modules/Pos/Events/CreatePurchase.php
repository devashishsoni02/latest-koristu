<?php

namespace Modules\Pos\Events;

use Illuminate\Queue\SerializesModels;

class CreatePurchase
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $request;
    public $purchase;

    public function __construct($request ,$purchase)
    {
        $this->request = $request;
        $this->purchase = $purchase;
    }

}
