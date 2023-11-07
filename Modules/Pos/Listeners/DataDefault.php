<?php

namespace Modules\Pos\Listeners;

use App\Events\DefaultData;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Pos\Entities\Pos;


class DataDefault
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(DefaultData $event)
    {
        $company_id = $event->company_id;
        $workspace_id = $event->workspace_id;
        $user_module = $event->user_module;
        if(!empty($user_module))
        {
            if (in_array("Pos", $user_module))
            {
                Pos::defaultdata($company_id,$workspace_id);
            }
        }
    }
}
