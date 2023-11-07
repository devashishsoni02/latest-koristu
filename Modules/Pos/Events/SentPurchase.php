<?php

namespace Modules\Pos\Events;

use Illuminate\Queue\SerializesModels;

class SentPurchase
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $purchase;
    public function __construct($purchase)
    {
        $this->purchase = $purchase;
    }
}
