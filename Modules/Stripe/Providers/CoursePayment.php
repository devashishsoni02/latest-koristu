<?php

namespace Modules\Stripe\Providers;

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
                        if(module_is_active('Stripe', $store->created_by) && (company_setting('stripe_is_on', $store->created_by,$store->workspace)  == 'on') && (company_setting('stripe_key', $store->created_by,$store->workspace)) && (company_setting('stripe_secret', $store->created_by,$store->workspace)))
                        {
                            $view->getFactory()->startPush('course_payment', view('stripe::payment.course_payment',compact('store')));
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
