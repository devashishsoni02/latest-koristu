<?php

namespace Modules\Hrm\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return \Modules\Hrm\Database\factories\DocumentFactory::new();
    }
    protected $fillable = [
        'name',
        'role',
        'document',
        'description',
        'workspace',
        'created_by',
    ];
}
