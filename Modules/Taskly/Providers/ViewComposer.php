<?php

namespace Modules\Taskly\Providers;

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
        view()->composer(['account::customer.show'], function ($view)
        {
            if(\Auth::check())
            {
                try {
                    $ids = \Request::segment(2);
                    if(!empty($ids))
                    {
                        try {
                            $id = \Illuminate\Support\Facades\Crypt::decrypt($ids);
                            $customer = \Modules\Account\Entities\Customer::where('user_id',$id)->where('created_by', '=', creatorId())->where('workspace', getActiveWorkSpace())->first();
                            if(module_is_active('Taskly', $customer->created_by))
                            {
                                $view->getFactory()->startPush('customer_project_tab', view('taskly::setting.sidebar'));
                                $view->getFactory()->startPush('customer_project_div', view('taskly::setting.nav_containt_div',compact('customer')));
                            }
                        } catch (\Throwable $th)
                        {
                        }
                    }
                } catch (\Throwable $th) {

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
