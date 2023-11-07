<?php

namespace Modules\Account\Events;

use Illuminate\Queue\SerializesModels;

class CreatePayment
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $request;
    public $payment;

    public function __construct($request ,$payment)
    {
        $this->request = $request;
        $this->payment = $payment;
    }

}
