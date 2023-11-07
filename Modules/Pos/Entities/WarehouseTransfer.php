<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WarehouseTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_warehouse',
        'to_warehouse',
        'product_id',
        'quantity',
        'date',
        'created_by',
    ];

    protected static function newFactory()
    {
        return \Modules\Pos\Database\factories\WarehouseTransferFactory::new();
    }

    public function product()
    {
        if(module_is_active('ProductService'))
        {
            return $this->hasOne(\Modules\ProductService\Entities\ProductService::class, 'id', 'product_id')->first();
        }
    }


    public function fromWarehouse()
    {
        return $this->hasOne(Warehouse::class, 'id', 'from_warehouse')->first();
    }
    public function toWarehouse()
    {
        return $this->hasOne(Warehouse::class, 'id', 'to_warehouse')->first();
    }



}
