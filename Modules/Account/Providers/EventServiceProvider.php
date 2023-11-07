<?php

namespace Modules\Account\Providers;

use App\Events\DefaultData;
use App\Events\GivePermissionToRole;
use Modules\Account\Listeners\DataDefault;
use App\Events\DeleteProductService;
use Modules\Account\Listeners\ProductServiceDelete;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Account\Listeners\GiveRoleToPermission;


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
        ],
        DeleteProductService::class =>[
            ProductServiceDelete::class
        ],
    ];

}


