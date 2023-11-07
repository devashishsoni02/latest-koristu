<?php

namespace Modules\Taskly\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'due_date',
        'task_id',
        'user_type',
        'created_by',
        'status',
    ];

    protected static function newFactory()
    {
        return \Modules\Taskly\Database\factories\SubTaskFactory::new();
    }
}
