<?php

namespace Modules\Paypal\Providers;

use Illuminate\Support\ServiceProvider;

class SalesInvoicePayment extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */

    public function boot(){
        view()->composer(['sales::salesinvoice.invoicepay'], function ($view)
        {
            $route = \Request::route()->getName();
            if($route =='pay.salesinvoice')
            {
                try {
                    $ids = \Request::segment(3);
                    if(!empty($ids))
                    {
                        $id = \Illuminate\Support\Facades\Crypt::decrypt($ids);

                        $invoice = \Modules\Sales\Entities\SalesInvoice::where('id',$id)->first();
                        $type = 'salesinvoice';
                        if(module_is_active('Paypal', $invoice->created_by) && (company_setting('paypal_payment_is_on', $invoice->created_by,$invoice->workspace)  == 'on') && (company_setting('company_paypal_client_id', $invoice->created_by,$invoice->workspace)) && (company_setting('company_paypal_secret_key', $invoice->created_by,$invoice->workspace)))
                        {
                            $view->getFactory()->startPush('salesinvoice_payment_tab', view('paypal::payment.sidebar'));
                            $view->getFactory()->startPush('salesinvoice_payment_div', view('paypal::payment.nav_containt_div',compact('type','invoice')));
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
