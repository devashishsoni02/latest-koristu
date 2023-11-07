<?php

namespace Modules\Hrm\Providers;

use App\Events\CreateUser;
use App\Events\UpdateUser;
use App\Events\DefaultData;
use Modules\Hrm\Listeners\DataDefault;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Hrm\Listeners\UserCreate;
use Modules\Hrm\Listeners\UserUpdate;
use App\Events\GivePermissionToRole;
use Modules\Hrm\Listeners\GiveRoleToPermission;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    protected $listen = [
        CreateUser::class =>[
            UserCreate::class
        ],
        UpdateUser::class =>[
            UserUpdate::class
        ],
        DefaultData::class =>[
            DataDefault::class
        ],
        GivePermissionToRole::class =>[
            GiveRoleToPermission::class
        ],
    ];
}
