<?php

namespace Modules\Paypal\Providers;

use Illuminate\Support\ServiceProvider;

class CoursePayment extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['lms::storefront.*.checkout'], function ($view)
        {
            try {
                $ids = \Request::segment(1);
                if(!empty($ids))
                {
                    try {
                        $store = \Modules\LMS\Entities\Store::where('slug',$ids)->first();
                        if(module_is_active('Paypal', $store->created_by) && (company_setting('paypal_payment_is_on', $store->created_by,$store->workspace)  == 'on') && (company_setting('company_paypal_client_id', $store->created_by,$store->workspace)) && (company_setting('company_paypal_secret_key', $store->created_by,$store->workspace)))
                        {
                            $view->getFactory()->startPush('course_payment', view('paypal::payment.course_payment',compact('store')));
                        }
                    } catch (\Throwable $th)
                    {

                    }
                }
            } catch (\Throwable $th) {

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
