<?php

namespace Modules\ProductService\Providers;

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
                if(\Auth::user()->can('category manage'))
                {
                     $categories = \Modules\ProductService\Entities\Category::where('created_by', '=', creatorId())->where('workspace_id',getActiveWorkSpace())->get();
                     $view->getFactory()->startPush('company_system_setup_sidebar', view('productservice::category.sidenav'));
                     $view->getFactory()->startPush('company_system_setup_sidebar_div', view('productservice::category.sidenav_div',compact('categories')));
                }
                if(\Auth::user()->can('tax manage'))
                {
                     $taxes = \Modules\ProductService\Entities\Tax::where('created_by',creatorId())->where('workspace_id',getActiveWorkSpace())->get();

                     $view->getFactory()->startPush('company_system_setup_sidebar', view('productservice::taxes.sidenav'));
                     $view->getFactory()->startPush('company_system_setup_sidebar_div', view('productservice::taxes.sidenav_div',compact('taxes')));
                }
                if(\Auth::user()->can('unit manage'))
                {
                     $units = \Modules\ProductService\Entities\Unit::where('created_by',creatorId())->where('workspace_id',getActiveWorkSpace())->get();

                     $view->getFactory()->startPush('company_system_setup_sidebar', view('productservice::units.sidenav'));
                     $view->getFactory()->startPush('company_system_setup_sidebar_div', view('productservice::units.sidenav_div',compact('units')));
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
