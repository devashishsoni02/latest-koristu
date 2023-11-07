<?php

namespace Modules\Taskly\Providers;

use App\Events\DefaultData;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Taskly\Listeners\DataDefault;
use Modules\Taskly\Listeners\GiveRoleToPermission;
use App\Events\GivePermissionToRole;


class EventServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    protected $listen = [
        GivePermissionToRole::class =>[
            GiveRoleToPermission::class
        ],
        DefaultData::class =>[
            DataDefault::class
        ]
    ];

}
