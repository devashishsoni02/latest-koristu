<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseDebitNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase',
        'vendor',
        'amount',
        'date',
    ];
    
    protected static function newFactory()
    {
        return \Modules\Pos\Database\factories\PurchaseDebitNoteFactory::new();
    }
}
