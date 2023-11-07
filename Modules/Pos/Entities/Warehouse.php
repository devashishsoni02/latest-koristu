<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use DB;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'city',
        'city_zip',
        'workspace',
        'created_by',
    ];
    
    protected static function newFactory()
    {
        return \Modules\Pos\Database\factories\WarehouseFactory::new();
    }
    public static function warehouse_id($warehouse_name)
    {
        $warehouse = Warehouse::where(['id'=>$warehouse_name, 'created_by'=> creatorId(), 'workspace' => getActiveWorkSpace() ])->first();
        return $warehouse->id;
    }
}
