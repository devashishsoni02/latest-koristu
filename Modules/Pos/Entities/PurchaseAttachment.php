<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_id',
        'file_name',
        'file_path',
        'file_size',
    ];
    
    protected static function newFactory()
    {
        return \Modules\Pos\Database\factories\PurchaseAttachmentFactory::new();
    }
}
