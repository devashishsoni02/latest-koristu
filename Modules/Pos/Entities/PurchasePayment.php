<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchasePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_id',
        'date',
        'account_id',
        'payment_method',
        'reference',
        'description',
        'workspace',
    ];
    public function bankAccount()
    {
        return $this->hasOne(\Modules\Account\Entities\BankAccount::class, 'id', 'account_id');
    }
    protected static function newFactory()
    {
        return \Modules\Pos\Database\factories\PurchasePaymentFactory::new();
    }
}
