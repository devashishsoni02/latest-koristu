<?php

namespace Modules\Paypal\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposer extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */

    public function boot()
    {
        view()->composer(['plans*','settings*'], function ($view)
        {
            if(\Auth::check())
            {
                $active_module =  ActivatedModule();

                $dependency = explode(',','Paypal');
                if(\Auth::user()->type == 'super admin' || !empty(array_intersect($dependency,$active_module)))
                {
                    $view->getFactory()->startPush('payment_setting_sidebar', view('paypal::setting.sidebar'));
                    $view->getFactory()->startPush('payment_setting_sidebar_div', view('paypal::setting.nav_containt_div'));
                }
                if(admin_setting('paypal_payment_is_on') == 'on' && !empty(admin_setting('company_paypal_client_id')) && !empty(admin_setting('company_paypal_secret_key')))
                {
                    $view->getFactory()->startPush('company_plan_payment', view('paypal::payment.plan_payment'));
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
