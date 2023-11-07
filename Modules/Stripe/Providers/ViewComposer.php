<?php

namespace Modules\Stripe\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposer extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */


    public function boot(){
        view()->composer(['plans*','settings*'], function ($view)
        {
            if(\Auth::check())
            {
                $active_module =  ActivatedModule();
                $dependency = explode(',','Stripe');
                if(\Auth::user()->type == 'super admin' || !empty(array_intersect($dependency,$active_module)))
                {
                    $view->getFactory()->startPush('payment_setting_sidebar', view('stripe::setting.sidebar'));
                    $view->getFactory()->startPush('payment_setting_sidebar_div', view('stripe::setting.nav_containt_div'));
                }

                if(admin_setting('stripe_is_on') == 'on' && !empty(admin_setting('stripe_key')) && !empty(admin_setting('stripe_secret')))
                {
                    $view->getFactory()->startPush('company_plan_payment', view('stripe::payment.plan_payment'));
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
