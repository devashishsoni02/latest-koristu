<?php

namespace Modules\ProductService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [];
    public static $categoryType = [
        'Product & Service',
        'Income',
        'Expense',
    ];
    protected static function newFactory()
    {
        return \Modules\ProductService\Database\factories\CategoryFactory::new();
    }
}

