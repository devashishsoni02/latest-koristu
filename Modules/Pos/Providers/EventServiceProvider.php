<?php

namespace Modules\Pos\Providers;

use App\Events\DeleteProductService;
use Modules\Pos\Listeners\ProductServiceDelete;
use App\Events\DefaultData;
use App\Events\GivePermissionToRole;
use Modules\Pos\Listeners\DataDefault;
use Modules\Pos\Listeners\GiveRoleToPermission;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    protected $listen = [
        DeleteProductService::class =>[
            ProductServiceDelete::class
        ],
        GivePermissionToRole::class =>[
            GiveRoleToPermission::class
        ],
        DefaultData::class =>[
            DataDefault::class
        ]
    ];
}
