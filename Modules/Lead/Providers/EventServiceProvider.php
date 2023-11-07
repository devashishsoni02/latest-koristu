<?php

namespace Modules\Lead\Providers;

use App\Events\DefaultData;
use App\Events\GivePermissionToRole;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Lead\Listeners\DataDefault;
use Modules\Lead\Listeners\GiveRoleToPermission;

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
