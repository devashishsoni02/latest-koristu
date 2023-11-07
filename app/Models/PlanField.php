<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanField extends Model
{
    use HasFactory;
    public $except_keys = ['id','plan_id','created_at','updated_at'];

    public function getTableColumns() {
        $columns = $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
        $columns = array_diff($columns, $this->except_keys);
        return $columns;
    }


}
