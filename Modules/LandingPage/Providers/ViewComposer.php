<?php

namespace Modules\LandingPage\Providers;

use Illuminate\Support\Facades\Route;
// use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\ServiceProvider;
use \Modules\LandingPage\Entities\LandingPageSetting;

class ViewComposer extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public $settings;


    public function boot(){

        $routes = collect(\Route::getRoutes())->map(function ($route) {
            if ($route->getName() != null) {
                return $route->getName();
            }
        });
        
        view()->composer(['login','register'], function ($view) {
                $settings = LandingPageSetting::settings();
                $view->getFactory()->startPush('custom_page_links', view('landingpage::layouts.buttons',compact('settings')));
        });

        
    }

}
