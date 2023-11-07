<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;


    public static function get_modules(){
        return Notification::groupBy('module')->pluck('module');
    }
}
