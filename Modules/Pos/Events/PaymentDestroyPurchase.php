<?php

namespace Modules\Pos\Events;

use Illuminate\Queue\SerializesModels;

class PaymentDestroyPurchase
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $payment;
    public function __construct($payment)
    {
        $this->payment = $payment;
    }
}
