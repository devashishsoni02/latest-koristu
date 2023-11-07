<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_type',
        'product_id',
        'invoice_id',
        'quantity',
        'tax',
        'discount',
        'description',
        'total',
    ];
    public function product()
    {
        $invoice =  $this->hasMany(Invoice::class, 'id', 'invoice_id')->first();
        if(!empty($invoice) && $invoice->invoice_module == "account")
        {
            if(module_is_active('ProductService'))
            {
                return $this->hasOne(\Modules\ProductService\Entities\ProductService::class, 'id', 'product_id')->first();
            }
            else
            {
                return [];
            }
        }
        elseif(!empty($invoice) && $invoice->invoice_module == "taskly")
        {
            if(module_is_active('Taskly'))
            {
                return  $this->hasOne(\Modules\Taskly\Entities\Task::class, 'id', 'product_id')->first();
            }
            else
            {
                return [];
            }
        }

    }
}
