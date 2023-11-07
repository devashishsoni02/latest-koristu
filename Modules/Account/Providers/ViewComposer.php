<?php

namespace Modules\Account\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposer extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */


    public function boot(){
        view()->composer(['settings*'], function ($view) {
            if(\Auth::check())
            {
                $active_module =  ActivatedModule();
                $dependency = explode(',','Account');
                if(!empty(array_intersect($dependency,$active_module)))
                {
                $view->getFactory()->startPush('account_setting_sidebar', view('account::setting.sidebar'));
                $view->getFactory()->startPush('account_setting_sidebar_div', view('account::setting.nav_containt_div'));
                }
            }
        });
    }
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

}
