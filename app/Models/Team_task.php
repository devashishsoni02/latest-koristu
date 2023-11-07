<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use App\Events\DefaultData;
use App\Events\GivePermissionToRole;
use Carbon\Carbon;
use App\Models\WorkSpace;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Rawilk\Settings\Support\Context;
use Lab404\Impersonate\Models\Impersonate;
use Laravel\Paddle\Billable;


class Team_task extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles,Impersonate, Billable;

    protected $fillable = [
        'title',
        'priority',
        'description',
        'start_date',
        'due_date',
        'assign_to',       
        'status',
        'order',
        'workspace',
        'days',
        'months',
        'dates'
    ];
}