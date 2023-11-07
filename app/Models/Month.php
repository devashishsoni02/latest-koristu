<?php

// namespace Modules\Taskly\Entities;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Month extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
    ];


}
