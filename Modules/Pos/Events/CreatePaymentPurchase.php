<?php

namespace Modules\Pos\Events;

use Illuminate\Queue\SerializesModels;

class CreatePaymentPurchase
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $request;
    public $payment;
    public function __construct($payment,$request)
    {
        $this->request = $request;
        $this->payment = $payment;
    }
}
