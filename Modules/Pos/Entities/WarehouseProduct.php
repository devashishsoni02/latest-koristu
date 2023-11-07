<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WarehouseProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'warehouse_id',
        'product_id',
        'quantity',
        'created_by',
        'workspace',
    ];
    
    public function product()
    {
      if(module_is_active('ProductService'))
      {
        return $this->hasOne(\Modules\ProductService\Entities\ProductService::class, 'id', 'product_id')->first();
      }
    }
    public function warehouse()
    {
        return $this->hasOne(Warehouse::class, 'id', 'warehouse_id')->first();
    }
    protected static function newFactory()
    {
        return \Modules\Pos\Database\factories\WarehouseProductFactory::new();
    }
}
