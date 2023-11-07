<?php

namespace Modules\Account\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ProductService\Entities\Category;


class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'amount',
        'account_id',
        'vendor_id',
        'description',
        'category_id',
        'recurring',
        'payment_method',
        'reference',
        'add_receipt',
        'workspace',
        'created_by'
    ];

    protected static function newFactory()
    {
        return \Modules\Account\Database\factories\PaymentFactory::new();
    }
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function vendor()
    {
        return $this->hasOne(Vender::class, 'id', 'vendor_id');
    }

    public function bankAccount()
    {
        return $this->hasOne(BankAccount::class, 'id', 'account_id');
    }
}
