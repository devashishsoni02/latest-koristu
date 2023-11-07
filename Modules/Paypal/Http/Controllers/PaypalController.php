<?php

namespace Modules\Paypal\Http\Controllers;

use App\Models\EmailTemplate;
use App\Models\Plan;
use App\Models\Order;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Rawilk\Settings\Support\Context;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PayPal\Rest\ApiContext;
use Illuminate\Support\Facades\Session;
use Modules\Paypal\Entities\PaypalUtility;
use Modules\Paypal\Events\PaypalPaymentStatus;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Cookie;
use Modules\Holidayz\Entities\Hotels;
use Modules\Holidayz\Entities\RoomBookingCart;
use Modules\Holidayz\Entities\BookingCoupons;
use Modules\Holidayz\Entities\HotelCustomer;
use Modules\Holidayz\Entities\RoomBooking;
use Modules\Holidayz\Entities\RoomBookingOrder;
use Modules\Holidayz\Entities\UsedBookingCoupons;
use Modules\Holidayz\Events\CreateRoomBooking;

class PaypalController extends Controller
{


    // private $_api_context;
    protected $invoiceData;
    public $paypal_mode;
    public $paypal_client_id;
    public $paypal_secret_key;
    public $enable_paypal;
    public $currancy;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function setting(Request $request)
    {

        if (Auth::user()->can('paypal manage')) {
            if ($request->has('paypal_payment_is_on')) {
                $validator = Validator::make($request->all(),
                [
                    'company_paypal_mode' => 'required|string',
                    'company_paypal_client_id' => 'required|string',
                    'company_paypal_secret_key' => 'required|string',
                ]);
                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }
            }

            $userContext = new Context(['user_id' => Auth::user()->id,'workspace_id'=>getActiveWorkSpace()]);
            if($request->has('paypal_payment_is_on')){
                \Settings::context($userContext)->set('paypal_payment_is_on', $request->paypal_payment_is_on);
                \Settings::context($userContext)->set('company_paypal_mode', $request->company_paypal_mode);
                \Settings::context($userContext)->set('company_paypal_client_id', $request->company_paypal_client_id);
                \Settings::context($userContext)->set('company_paypal_secret_key', $request->company_paypal_secret_key);
            }else{
                \Settings::context($userContext)->set('paypal_payment_is_on', 'off');
            }

            return redirect()->back()->with('success', __('Paypal Setting save successfully'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    // get paypal payment setting
    public function paymentConfig($id=null, $workspace=Null)
    {
        if(!empty($id) && empty($workspace))
        {
            $this->currancy  = !empty(company_setting('defult_currancy',$id)) ? company_setting('defult_currancy',$id) : '$';
            $this->enable_paypal = !empty(company_setting('paypal_payment_is_on',$id)) ? company_setting('paypal_payment_is_on',$id) : 'off';

            if(company_setting('company_paypal_mode',$id) == 'live')
            {
                config(
                    [
                        'paypal.live.client_id' => !empty(company_setting('company_paypal_client_id',$id)) ? company_setting('company_paypal_client_id',$id) : '',
                        'paypal.live.client_secret' => !empty(company_setting('company_paypal_secret_key',$id)) ? company_setting('company_paypal_secret_key',$id) : '',
                        'paypal.mode' => !empty(company_setting('company_paypal_mode',$id)) ? company_setting('company_paypal_mode',$id) : '',
                    ]
                );
            }
            else{
                config(
                    [
                        'paypal.sandbox.client_id' => !empty(company_setting('company_paypal_client_id',$id)) ? company_setting('company_paypal_client_id',$id) : '',
                        'paypal.sandbox.client_secret' => !empty(company_setting('company_paypal_secret_key',$id)) ? company_setting('company_paypal_secret_key',$id) : '',
                        'paypal.mode' => !empty(company_setting('company_paypal_mode',$id)) ? company_setting('company_paypal_mode',$id) : '',
                    ]
                );
            }
        }elseif(!empty($id) && !empty($workspace)){
            $this->currancy  = !empty(company_setting('defult_currancy',$id,$workspace)) ? company_setting('defult_currancy',$id,$workspace) : '$';
            $this->enable_paypal = !empty(company_setting('paypal_payment_is_on',$id,$workspace)) ? company_setting('paypal_payment_is_on',$id,$workspace) : 'off';

            if(company_setting('company_paypal_mode',$id,$workspace) == 'live')
            {
                config(
                    [
                        'paypal.live.client_id' => !empty(company_setting('company_paypal_client_id',$id,$workspace)) ? company_setting('company_paypal_client_id',$id,$workspace) : '',
                        'paypal.live.client_secret' => !empty(company_setting('company_paypal_secret_key',$id,$workspace)) ? company_setting('company_paypal_secret_key',$id,$workspace) : '',
                        'paypal.mode' => !empty(company_setting('company_paypal_mode',$id,$workspace)) ? company_setting('company_paypal_mode',$id,$workspace) : '',
                    ]
                );
            }
            else{
                config(
                    [
                        'paypal.sandbox.client_id' => !empty(company_setting('company_paypal_client_id',$id,$workspace)) ? company_setting('company_paypal_client_id',$id,$workspace) : '',
                        'paypal.sandbox.client_secret' => !empty(company_setting('company_paypal_secret_key',$id,$workspace)) ? company_setting('company_paypal_secret_key',$id,$workspace) : '',
                        'paypal.mode' => !empty(company_setting('company_paypal_mode',$id,$workspace)) ? company_setting('company_paypal_mode',$id,$workspace) : '',
                    ]
                );
            }
        }
        else{
            $this->currancy  = !empty(company_setting('defult_currancy')) ? company_setting('defult_currancy') : '$';
            $this->enable_paypal = !empty(company_setting('paypal_payment_is_on')) ? company_setting('paypal_payment_is_on') : 'off';

            if(company_setting('company_paypal_mode') == 'live')
            {
                config(
                    [
                        'paypal.live.client_id' => !empty(company_setting('company_paypal_client_id')) ? company_setting('company_paypal_client_id') : '',
                        'paypal.live.client_secret' => !empty(company_setting('company_paypal_secret_key')) ? company_setting('company_paypal_secret_key') : '',
                        'paypal.mode' => !empty(company_setting('company_paypal_mode')) ? company_setting('company_paypal_mode') : '',
                    ]
                );
            }
            else{
                config(
                    [
                        'paypal.sandbox.client_id' => !empty(company_setting('company_paypal_client_id')) ? company_setting('company_paypal_client_id') : '',
                        'paypal.sandbox.client_secret' => !empty(company_setting('company_paypal_secret_key')) ? company_setting('company_paypal_secret_key') : '',
                        'paypal.mode' => !empty(company_setting('company_paypal_mode')) ? company_setting('company_paypal_mode') : '',
                    ]
                );
            }
        }
    }

    public function invoicePayWithPaypal(Request $request)
    {
        $user    = Auth::user();
        $validator = Validator::make(
            $request->all(),
            ['amount' => 'required|numeric', 'invoice_id' => 'required']
        );
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
        $invoice_id = $request->input('invoice_id');
        $type = $request->type;
        if($type == 'invoice')
        {
            $invoice = \App\Models\Invoice::find($invoice_id);
            $user_id = $invoice->created_by;
            $workspace = $invoice->workspace;
            $payment_id = $invoice->id;
        }
        elseif($type == 'salesinvoice') {

            $invoice = \Modules\Sales\Entities\SalesInvoice::find($invoice_id);
            $user_id = $invoice->created_by;
            $workspace = $invoice->workspace;
            $payment_id = $invoice->id;

        }
        elseif($type == 'retainer') {

            $invoice = \Modules\Retainer\Entities\Retainer::find($invoice_id);
            $user_id = $invoice->created_by;
            $workspace = $invoice->workspace;
            $payment_id = $invoice->id;
        }

        $this->invoiceData  = $invoice;
        $this->paymentConfig($user_id,$workspace);
        $get_amount = $request->amount;
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));

        if ($invoice) {
            if ($get_amount > $invoice->getDue()) {
                return redirect()->back()->with('error', __('Invalid amount.'));
            } else {
                $orderID = strtoupper(str_replace('.', '', uniqid('', true)));

                $name = isset($user->name)?$user->name:'public' . " - " . $invoice_id;
                $paypalToken = $provider->getAccessToken();
                $response = $provider->createOrder([
                    "intent" => "CAPTURE",
                    "application_context" => [
                        "return_url" => route('invoice.paypal',[$payment_id,$get_amount, $type]),
                        "cancel_url" =>  route('invoice.paypal',[$payment_id,$get_amount, $type]),
                    ],
                    "purchase_units" => [
                        0 => [
                            "amount" => [
                                "currency_code" => $this->currancy = company_setting('defult_currancy', $user_id),

                                "value" => $get_amount
                            ]
                        ]
                    ]
                ]);

                if (isset($response['id']) && $response['id'] != null) {
                    // redirect to approve href
                    foreach ($response['links'] as $links) {
                        if ($links['rel'] == 'approve') {
                            return redirect()->away($links['href']);
                        }
                    }
                    return redirect()->back()->with('error', 'Something went wrong.');
                }
                else {
                    if($request->type == 'invoice'){
                        return redirect()->route('invoice.show', $invoice_id)->with('error', $response['message'] ?? 'Something went wrong.');
                    }
                    elseif($request->type == 'salesinvoice'){
                        return redirect()->route('salesinvoice.show', $invoice_id)->with('error', $response['message'] ?? 'Something went wrong.');
                    }
                    elseif($request->type == 'retainer'){
                        return redirect()->route('retainer.show', $invoice_id)->with('error', $response['message'] ?? 'Something went wrong.');
                    }
                }

                return redirect()->back()->with('error', __('Unknown error occurred'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function getInvoicePaymentStatus(Request $request, $invoice_id, $amount,$type)
    {
        if($type == 'invoice')
        {
            $invoice = \App\Models\Invoice::find($invoice_id);
            $this->paymentConfig($invoice->created_by,$invoice->workspace);
            $this->invoiceData  = $invoice;

            if ($invoice) {
                $payment_id = Session::get('paypal_payment_id');
                Session::forget('paypal_payment_id');
                if (empty($request->PayerID || empty($request->token))) {
                    return redirect()->route('invoice.show', $invoice_id)->with('error', __('Payment failed'));
                }
                $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
                try {
                    $invoice_payment                 = new \App\Models\InvoicePayment();
                    $invoice_payment->invoice_id     = $invoice_id;
                    $invoice_payment->date           = Date('Y-m-d');
                    $invoice_payment->account_id     = 0;
                    $invoice_payment->payment_method = 0;
                    $invoice_payment->amount         = $amount;
                    $invoice_payment->order_id       = $orderID;
                    $invoice_payment->currency       = $this->currancy;
                    $invoice_payment->payment_type = 'PAYPAL';
                    $invoice_payment->save();

                    $due     = $invoice->getDue();
                    if ($due <= 0) {
                        $invoice->status = 4;
                        $invoice->save();
                    } else {
                        $invoice->status = 3;
                        $invoice->save();
                    }
                    if(module_is_active('Account'))
                    {
                        //for customer balance update
                        \Modules\Account\Entities\AccountUtility::updateUserBalance('customer', $invoice->customer_id, $invoice_payment->amount, 'debit');
                    }
                    event(new PaypalPaymentStatus($invoice,$type,$invoice_payment));

                    return redirect()->route('pay.invoice',\Illuminate\Support\Facades\Crypt::encrypt($invoice_id))->with('success', __('Invoice paid Successfully!'));

                } catch (\Exception $e) {
                    return redirect()->route('pay.invoice', \Illuminate\Support\Facades\Crypt::encrypt($invoice_id))->with('success',$e->getMessage());
                }
            } else {
                return redirect()->route('pay.invoice', \Illuminate\Support\Facades\Crypt::encrypt($invoice_id))->with('success', __('Invoice not found.'));
            }

        }
        elseif($type == 'salesinvoice')
        {
            $salesinvoice = \Modules\Sales\Entities\SalesInvoice::find($invoice_id);
            $this->paymentConfig($salesinvoice->created_by,$salesinvoice->workspace);

            $this->invoiceData  = $salesinvoice;
            if ($salesinvoice)
            {
                $payment_id = Session::get('paypal_payment_id');
                Session::forget('paypal_payment_id');
                if (empty($request->PayerID || empty($request->token))) {
                    return redirect()->route('salesinvoice.show', $invoice_id)->with('error', __('Payment failed'));
                }

                try {
                    $salesinvoice_payment                 = new \Modules\Sales\Entities\SalesInvoicePayment();
                    $salesinvoice_payment->invoice_id     = $invoice_id;
                    $salesinvoice_payment->transaction_id = app('Modules\Sales\Http\Controllers\SalesInvoiceController')->transactionNumber($salesinvoice->created_by);
                    $salesinvoice_payment->date           = Date('Y-m-d');
                    $salesinvoice_payment->amount         = $amount;
                    $salesinvoice_payment->client_id      = 0;
                    $salesinvoice_payment->payment_type   = 'PAYPAL';
                    $salesinvoice_payment->save();
                    $due     = $salesinvoice->getDue();
                    if ($due <= 0) {
                        $salesinvoice->status = 3;
                        $salesinvoice->save();
                    } else {
                        $salesinvoice->status = 2;
                        $salesinvoice->save();
                    }

                    event(new PaypalPaymentStatus($salesinvoice,$type,$salesinvoice_payment));

                    return redirect()->route('pay.salesinvoice', \Illuminate\Support\Facades\Crypt::encrypt($invoice_id))->with('success', __('Sales Invoice paid Successfully!'));

                } catch (\Exception $e) {

                    return redirect()->route('pay.salesinvoice',  \Illuminate\Support\Facades\Crypt::encrypt($invoice_id))->with('success',$e->getMessage());
                }
            } else {

                return redirect()->route('pay.salesinvoice',  \Illuminate\Support\Facades\Crypt::encrypt($invoice_id))->with('success', __('Sales Invoice not found.'));
            }
        }


        elseif($type == 'retainer')
        {
            $retainer = \Modules\Retainer\Entities\Retainer::find($invoice_id);
            $this->paymentConfig($retainer->created_by,$retainer->workspace);

            $this->invoiceData  = $retainer;
            if ($retainer)
            {
                $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
                $payment_id = Session::get('paypal_payment_id');
                Session::forget('paypal_payment_id');
                if (empty($request->PayerID || empty($request->token))) {
                    return redirect()->route('retainer.show', $invoice_id)->with('error', __('Payment failed'));
                }

                try {
                    $retainer_payment                 = new \Modules\Retainer\Entities\RetainerPayment();
                    $retainer_payment->retainer_id     = $invoice_id;
                    $retainer_payment->date           = Date('Y-m-d');
                    $retainer_payment->account_id     = 0;
                    $retainer_payment->payment_method = 0;
                    $retainer_payment->amount         = $amount;
                    $retainer_payment->order_id       = $orderID;
                    $retainer_payment->currency       = $this->currancy;
                    $retainer_payment->payment_type = 'PAYPAL';
                    $retainer_payment->save();
                    $due     = $retainer->getDue();
                    if ($due <= 0) {
                        $retainer->status = 3;
                        $retainer->save();
                    } else {
                        $retainer->status = 2;
                        $retainer->save();
                    }
                    //for customer balance update
                    \Modules\Retainer\Entities\RetainerUtility::updateUserBalance('customer', $retainer->customer_id, $retainer_payment->amount, 'debit');

                    event(new PaypalPaymentStatus($retainer,$type,$retainer_payment));

                    return redirect()->route('pay.retainer', \Illuminate\Support\Facades\Crypt::encrypt($invoice_id))->with('success', __('Retainer paid Successfully!'));

                } catch (\Exception $e) {
                    return redirect()->route('pay.retainer',  \Illuminate\Support\Facades\Crypt::encrypt($invoice_id))->with('success',$e->getMessage());
                }
            } else {

                return redirect()->route('pay.retainer',  \Illuminate\Support\Facades\Crypt::encrypt($invoice_id))->with('success', __('Retainer not found.'));
            }
        }
    }

    public function planPayWithPaypal(Request $request)
    {
        $plan = Plan::find($request->plan_id);
        $user_counter = !empty($request->user_counter_input) ? $request->user_counter_input : 0;
        $workspace_counter = !empty($request->workspace_counter_input) ? $request->workspace_counter_input : 0;
        $user_module = !empty($request->user_module_input) ? $request->user_module_input : '0';
        $duration = !empty($request->time_period) ? $request->time_period : 'Month';
        $user_module_price = 0;
        if(!empty($user_module) && $plan->custom_plan == 1)
        {
            $user_module_array =    explode(',',$user_module);
            foreach ($user_module_array as $key => $value)
            {
                $temp = ($duration == 'Year') ? ModulePriceByName($value)['yearly_price'] : ModulePriceByName($value)['monthly_price'];
                $user_module_price = $user_module_price + $temp;
            }
        }
        $user_price = 0;
        $temp = ($duration == 'Year') ? $plan->price_per_user_yearly : $plan->price_per_user_monthly;
        if($user_counter > 0)
        {

            $user_price = $user_counter * $temp;
        }
        $workspace_price = 0;
        if($workspace_counter > 0)
        {
            $workspace_price = $workspace_counter * $temp;
        }
        $plan_price = ($duration == 'Year') ? $plan->package_price_yearly : $plan->package_price_monthly;
        $counter = [
            'user_counter'=>$user_counter,
            'workspace_counter'=>$workspace_counter,
        ];
        if(admin_setting('company_paypal_mode') == 'live')
        {
            config(
                [
                    'paypal.live.client_id' => !empty(admin_setting('company_paypal_client_id')) ? admin_setting('company_paypal_client_id') : '',
                    'paypal.live.client_secret' => !empty(admin_setting('company_paypal_secret_key')) ? admin_setting('company_paypal_secret_key') : '',
                    'paypal.mode' => !empty(admin_setting('company_paypal_mode')) ? admin_setting('company_paypal_mode') : '',
                ]
            );
        }
        else{
            config(
                [
                    'paypal.sandbox.client_id' => !empty(admin_setting('company_paypal_client_id')) ? admin_setting('company_paypal_client_id') : '',
                    'paypal.sandbox.client_secret' => !empty(admin_setting('company_paypal_secret_key')) ? admin_setting('company_paypal_secret_key') : '',
                    'paypal.mode' => !empty(admin_setting('company_paypal_mode')) ? admin_setting('company_paypal_mode') : '',
                ]
            );
        }
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        if ($plan) {
            try {
                if($request->coupon_code)
                {
                    $plan_price = CheckCoupon($request->coupon_code,$plan_price);
                }
                $price     = $plan_price + $user_module_price + $user_price + $workspace_price;

                if($price <= 0){
                    $assignPlan= DirectAssignPlan($plan->id,$duration,$user_module,$counter,'PAYPAL');
                    if($assignPlan['is_success']){
                       return redirect()->route('plans.index')->with('success', __('Plan activated Successfully!'));
                    }else{
                       return redirect()->route('plans.index')->with('error', __('Something went wrong, Please try again,'));
                    }
                }
                $paypalToken = $provider->getAccessToken();
                $response = $provider->createOrder([
                    "intent" => "CAPTURE",
                    "application_context" => [
                        "return_url" => route('plan.get.paypal.status', [
                                    $plan->id,
                                    'amount' => $price,
                                    'user_module' => $user_module,
                                    'counter' => $counter,
                                    'duration' => $duration,
                                    'coupon_code' => $request->coupon_code,
                    ]),
                        "cancel_url" =>  route('plan.get.paypal.status', [
                            $plan->id,
                                    'amount' => $price,
                                    'user_module' => $user_module,
                                    'counter' => $counter,
                                    'duration' => $duration,
                                    'coupon_code' => $request->coupon_code,

                        ]),
                    ],
                    "purchase_units" => [
                        0 => [
                            "amount" => [
                                "currency_code" => admin_setting('defult_currancy'),
                                "value" => $price,

                            ]
                        ]
                    ]
                ]);
                if (isset($response['id']) && $response['id'] != null) {
                    // redirect to approve href
                    foreach ($response['links'] as $links) {
                        if ($links['rel'] == 'approve') {
                            return redirect()->away($links['href']);
                        }
                    }
                    return redirect()
                        ->route('plans.index', \Illuminate\Support\Facades\Crypt::encrypt($plan->id))
                        ->with('error', 'Something went wrong. OR Unknown error occurred');
                } else {
                    return redirect()
                        ->route('plans.index', \Illuminate\Support\Facades\Crypt::encrypt($plan->id))
                        ->with('error', $response['message'] ?? 'Something went wrong.');
                }

            } catch (\Exception $e) {
                return redirect()->route('plans.index')->with('error', __($e->getMessage()));
            }
        } else {
            return redirect()->route('plans.index')->with('error', __('Plan is deleted.'));
        }
    }

    public function planGetPaypalStatus(Request $request, $plan_id)
    {
        $user = Auth::user();
        $plan = Plan::find($plan_id);
        if ($plan)
        {
            if(admin_setting('company_paypal_mode') == 'live')
            {
                config(
                    [
                        'paypal.live.client_id' => !empty(admin_setting('company_paypal_client_id')) ? admin_setting('company_paypal_client_id') : '',
                        'paypal.live.client_secret' => !empty(admin_setting('company_paypal_secret_key')) ? admin_setting('company_paypal_secret_key') : '',
                        'paypal.mode' => !empty(admin_setting('company_paypal_mode')) ? admin_setting('company_paypal_mode') : '',
                    ]
                );
            }
            else{
                config(
                    [
                        'paypal.sandbox.client_id' => !empty(admin_setting('company_paypal_client_id')) ? admin_setting('company_paypal_client_id') : '',
                        'paypal.sandbox.client_secret' => !empty(admin_setting('company_paypal_secret_key')) ? admin_setting('company_paypal_secret_key') : '',
                        'paypal.mode' => !empty(admin_setting('company_paypal_mode')) ? admin_setting('company_paypal_mode') : '',
                    ]
                );
            }

            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();
            $response = $provider->capturePaymentOrder($request['token']);
            $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
            try {
                if (isset($response['status']) && $response['status'] == 'COMPLETED')
                {
                    if ($response['status'] == 'COMPLETED') {
                        $statuses = __('succeeded');
                    }

                    $order = Order::create(
                        [
                            'order_id' => $orderID,
                            'name' => null,
                            'email' => null,
                            'card_number' => null,
                            'card_exp_month' => null,
                            'card_exp_year' => null,
                            'plan_name' =>  !empty($plan->name) ? $plan->name :'Basic Package',
                            'plan_id' => $plan->id,
                            'price' => !empty($request->amount)?$request->amount:0,
                            'price_currency' => admin_setting('defult_currancy'),
                            'txn_id' => '',
                            'payment_type' => __('PAYPAL'),
                            'payment_status' =>$statuses,
                            'receipt' => null,
                            'user_id' => $user->id,
                        ]
                    );
                    $type = 'Subscription';
                    $user = User::find($user->id);
                    $assignPlan = $user->assignPlan($plan->id,$request->duration,$request->user_module,$request->counter);
                    if($request->coupon_code){

                        UserCoupon($request->coupon_code,$order->order_id);
                    }
                    $value = Session::get('user-module-selection');

                    event(new PaypalPaymentStatus($plan,$type,$order));

                    if(!empty($value))
                    {
                        Session::forget('user-module-selection');
                    }

                    if ($assignPlan['is_success']) {
                        return redirect()->route('plans.index')->with('success', __('Plan activated Successfully.'));
                    } else {
                        return redirect()->route('plans.index')->with('error', __($assignPlan['error']));
                    }

                } else {
                    return redirect()->route('plans.index')->with('error', __('Plan is deleted.'));
                }

            } catch (\Exception $e) {
                return redirect()->route('plans.index')->with('error', __('Transaction has been failed.'));
            }

        } else {
            return redirect()->route('plans.index')->with('error', __('Plan is deleted.'));
        }
    }

    public function coursePayWithPaypal(Request $request, $slug)
    {
        $cart     = session()->get($slug);
        $products = $cart['products'];

        $store = \Modules\LMS\Entities\Store::where('slug', $slug)->first();

        $this->paymentConfig($store->created_by,$store->workspace_id);

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        Session::put('paypal_payment_id', $paypalToken['access_token']);
        $objUser = Auth::user();

        $total_price    = 0;
        $sub_totalprice = 0;
        $product_name   = [];
        $product_id     = [];

        foreach ($products as $key => $product) {
            $product_name[] = $product['product_name'];
            $product_id[]   = $product['id'];
            $sub_totalprice += $product['price'];
            $total_price    += $product['price'];
        }

        if ($products) {
            try {
                $coupon_id = null;
                if (isset($cart['coupon']) && isset($cart['coupon'])) {
                    if ($cart['coupon']['coupon']['enable_flat'] == 'off') {
                        $discount_value = ($sub_totalprice / 100) * $cart['coupon']['coupon']['discount'];
                        $total_price    = $sub_totalprice - $discount_value;
                    } else {
                        $discount_value = $cart['coupon']['coupon']['flat_discount'];
                        $total_price    = $sub_totalprice - $discount_value;
                    }
                }
                if($total_price <= 0){
                    $assignCourse= \Modules\LMS\Entities\LmsUtility::DirectAssignCourse($store,'Coingate');
                    if($assignCourse['is_success']){
                        return redirect()->route(
                            'store-complete.complete',
                            [
                                $store->slug,
                                \Illuminate\Support\Facades\Crypt::encrypt($assignCourse['courseorder_id']),
                            ]
                        )->with('success', __('Transaction has been success'));
                    }else{
                       return redirect()->route('store.cart',$store->slug)->with('error', __('Something went wrong, Please try again,'));
                    }
                }
                $response = $provider->createOrder([
                    "intent" => "CAPTURE",
                    "application_context" => [
                        "return_url" => route('course.paypal', $store->slug),
                        "cancel_url" => route('course.paypal', $store->slug),
                    ],
                    "purchase_units" => [
                        0 => [
                            "amount" => [
                                "currency_code" => !empty(company_setting('defult_currancy',$store->created_by,$store->workspace_id)) ? company_setting('defult_currancy',$store->created_by,$store->workspace_id) : 'INR',
                                "value" => $total_price,
                            ],
                        ],
                    ],
                ]);
                if (isset($response['id']) && $response['id'] != null) {
                    // redirect to approve href
                    foreach ($response['links'] as $links) {
                        if ($links['rel'] == 'approve') {
                            return redirect()->away($links['href']);
                        }
                    }
                    return redirect()
                        -> route('store.slug',[$store->slug])
                        ->with('error', 'Something went wrong.');
                } else {
                    return redirect()
                        -> route('store.slug',[$store->slug])
                        ->with('error', $response['message'] ?? 'Something went wrong.');
                }
                Session::put('paypal_payment_id', $paypalToken->id);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', __('Unknown error occurred'));
            }
        } else {
            return redirect()->back()->with('error', __('is deleted.'));
        }
    }


    public function GetCoursePaymentStatus(Request $request, $slug)
    {
        $store = \Modules\LMS\Entities\Store::where('slug', $slug)->first();

        $cart = session()->get($slug);
        if (isset($cart['coupon'])) {
            $coupon = $cart['coupon']['coupon'];
        }
        $products       = $cart['products'];
        $sub_totalprice = 0;
        $product_name   = [];
        $product_id     = [];

        foreach ($products as $key => $product) {
            $product_name[] = $product['product_name'];
            $product_id[]   = $product['id'];
            $sub_totalprice += $product['price'];
        }
        if (!empty($coupon)) {
            if ($coupon['enable_flat'] == 'off') {
                $discount_value = ($sub_totalprice / 100) * $coupon['discount'];
                $totalprice     = $sub_totalprice - $discount_value;
            } else {
                $discount_value = $coupon['flat_discount'];
                $totalprice     = $sub_totalprice - $discount_value;
            }
        }
        if ($products) {
            $this->paymentConfig($store->created_by,$store->workspace_id);
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();
            $response = $provider->capturePaymentOrder($request['token']);
            $payment_id = Session::get('paypal_payment_id');
            try {
                $order       = new \Modules\LMS\Entities\CourseOrder();
                $latestOrder = \Modules\LMS\Entities\CourseOrder::orderBy('created_at', 'DESC')->first();
                if (!empty($latestOrder)) {
                    $order->order_nr = '#' . str_pad($latestOrder->id + 1, 4, "100", STR_PAD_LEFT);
                } else {
                    $order->order_nr = '#' . str_pad(1, 4, "100", STR_PAD_LEFT);
                }

                $statuses = '';
                if (isset($response['status']) && $response['status'] == 'COMPLETED')
                {
                    if ($response['status'] == 'COMPLETED') {
                        $statuses = __('successful');
                    }

                    $student               = Auth::guard('students')->user();
                    $course_order                 = new \Modules\LMS\Entities\CourseOrder();
                    $course_order->order_id       =  '#' .time();
                    $course_order->name           = $student->name;
                    $course_order->card_number    = '';
                    $course_order->card_exp_month = '';
                    $course_order->card_exp_year  = '';
                    $course_order->student_id     = $student->id;
                    $course_order->course         = json_encode($products);
                    $course_order->price          = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
                    $course_order->coupon         = !empty($cart['coupon']['coupon']['id']) ? $cart['coupon']['coupon']['id'] : '';
                    $course_order->coupon_json    = json_encode(!empty($coupon) ? $coupon : '');
                    $course_order->discount_price = !empty($cart['coupon']['discount_price']) ? $cart['coupon']['discount_price'] : '';
                    $course_order->price_currency = !empty(company_setting('defult_currancy',$store->created_by,$store->workspace_id)) ? company_setting('defult_currancy',$store->created_by,$store->workspace_id) : 'USD';
                    $course_order->txn_id         = $payment_id;
                    $course_order->payment_type   = __('PAYPAL');
                    $course_order->payment_status = $statuses;
                    $course_order->receipt        = '';
                    $course_order->store_id       = $store['id'];
                    $course_order->save();

                    foreach ($products as $course_id) {
                        $purchased_course = new \Modules\LMS\Entities\PurchasedCourse();
                        $purchased_course->course_id  = $course_id['product_id'];
                        $purchased_course->student_id = $student->id;
                        $purchased_course->order_id   = $course_order->id;
                        $purchased_course->save();

                        $student = \Modules\LMS\Entities\Student::where('id', $purchased_course->student_id)->first();
                        $student->courses_id = $purchased_course->course_id;
                        $student->save();
                    }

                    $type = 'coursepayment';

                    if (!empty(company_setting('New Course Order',$store->created_by,$store->workspace_id)) && company_setting('New Course Order',$store->created_by,$store->workspace_id)  == true) {
                        $course = \Modules\LMS\Entities\Course::whereIn('id',$product_id)->get()->pluck('title');
                        $course_name = implode(', ', $course->toArray());
                        $user = User::where('id',$store->created_by)->where('workspace_id',$store->workspace_id)->first();
                        $uArr    = [
                            'student_name' => $student->name,
                            'course_name' => $course_name,
                            'store_name' => $store->name,
                            'order_url' => route('user.order',[$store->slug,\Illuminate\Support\Facades\Crypt::encrypt($course_order->id),]),
                        ];
                        try
                        {
                            // Send Email
                            $resp = EmailTemplate::sendEmailTemplate('New Course Order', [$user->id => $user->email], $uArr,$store->created_by);
                        }
                        catch(\Exception $e)
                        {
                            $resp['error'] = $e->getMessage();
                        }
                    }

                    event(new PaypalPaymentStatus($store,$type,$course_order));
                    session()->forget($slug);

                    return redirect()->route(
                        'store-complete.complete',
                        [
                            $store->slug,
                            \Illuminate\Support\Facades\Crypt::encrypt($course_order->id),
                        ]
                    )->with('success', __('Transaction has been') .' '. $statuses);
                } else {
                    return redirect()->back()->with('error', __('Transaction has been') .' '.$statuses);
                }
            } catch (\Exception $e) {
                return redirect()->back()->with('error', __('Transaction has been failed.'));
            }
        } else {
            return redirect()->back()->with('error', __('is deleted.'));
        }
    }
    // Holidayz

    public function BookingPayWithPaypal(Request $request, $slug)
    {
        $hotel = Hotels::where('slug', $slug)->first();
        if ($hotel) {
            $grandTotal = 0;
            if (!auth()->guard('holiday')->user()) {
                $Carts = Cookie::get('cart');
                $Carts = json_decode($Carts, true);
                foreach ($Carts as $key => $value) {
                    //
                    $toDate = \Carbon\Carbon::parse($value['check_in']);
                    $fromDate = \Carbon\Carbon::parse($value['check_out']);

                    $days = $toDate->diffInDays($fromDate);
                    //
                    $grandTotal += $value['price'] * $value['room'] * $days;
                    $grandTotal += ($value['serviceCharge']) ? $value['serviceCharge'] : 0;
                }
            } else {
                $Carts = RoomBookingCart::where(['customer_id' => auth()->guard('holiday')->user()->id])->get();
                foreach ($Carts as $key => $value) {
                    $grandTotal += $value->price;   // * $value->room
                    $grandTotal += ($value->service_charge) ? $value->service_charge : 0;
                }
            }

            try {
                $this->paymentConfig($hotel->created_by,$hotel->workspace);
                $provider = new PayPalClient;
                $provider->setApiCredentials(config('paypal'));
                $coupon_id = null;
                $get_amount     = $grandTotal;
                if (!empty($request->coupon)) {
                    $coupons = BookingCoupons::where('code', strtoupper($request->coupon))->where('is_active', '1')->first();
                    if (!empty($coupons)) {
                        $usedCoupun     = $coupons->used_coupon();
                        if ($coupons->limit == $usedCoupun) {
                            return redirect()->back()->with('error', __('This coupon code has expired.'));
                        }
                        $discount_value = ($get_amount / 100) * $coupons->discount;
                        $get_amount         = $get_amount - $discount_value;
                        $coupon_id = $coupons->id;
                    } else {
                        return redirect()->back()->with('error', __('This coupon code is invalid or has expired.'));
                    }
                }
                $get_amount = number_format((float)$get_amount, 2, '.', '');
                session()->put('guestInfo', $request->only(['firstname','email','address','country','lastname','phone','city','zipcode']));
                if ($get_amount <= 0) {
                    return $this->GetBookingPaymentStatus($request, $slug, $get_amount, $coupon_id);
                }

                $paypalToken = $provider->getAccessToken();


                $data = [$slug, $get_amount, 0];
                if ($coupon_id) {
                    $data = [$slug, $get_amount, $coupon_id];
                }

                $response = $provider->createOrder([
                    "intent" => "CAPTURE",
                    "application_context" => [
                        "return_url" => route('booking.get.payment.status', $data),
                        "cancel_url" =>  route('booking.get.payment.status', $data),
                    ],
                    "purchase_units" => [
                        0 => [
                            "amount" => [
                                "currency_code" => !empty(company_setting('defult_currancy',$hotel->created_by,$hotel->workspace)) ? company_setting('defult_currancy',$hotel->created_by,$hotel->workspace) : '$',
                                "value" => $get_amount
                            ]
                        ]
                    ]
                ]);

                if (isset($response['id']) && $response['id'] != null) {
                    foreach ($response['links'] as $links) {
                        if ($links['rel'] == 'approve') {
                            return redirect()->away($links['href']);
                        }
                    }
                    return redirect()->back()->with('error', $response['message'] ?? 'Something went wrong.');
                } else {
                    return redirect()->back()->with('error', $response['message'] ?? 'Something went wrong.');
                }
            } catch (\Exception $e) {
                return redirect()->back()->with('error', __($e->getMessage()));
            }
        } else {
            return redirect()->back()->with('error', __('Hotel Not found.'));
        }
    }

    public function GetBookingPaymentStatus(Request $request, $slug, $price, $coupon_id = 0)
    {
        $hotel = Hotels::where(['slug' => $slug, 'is_active' => 1])->first();
        if ($hotel) {
            $guestDetails = session()->get('guestInfo');
            $this->paymentConfig($hotel->created_by,$hotel->workspace);
            if (!auth()->guard('holiday')->user()) {
                try{
                    $Carts = Cookie::get('cart');
                    $Carts = json_decode($Carts, true);
                    $coupons = BookingCoupons::find($coupon_id);
                    if (!empty($coupons)) {
                        $userCoupon         = new UsedBookingCoupons();
                        $userCoupon->customer_id   = isset(auth()->guard('holiday')->user()->id) ? auth()->guard('holiday')->user()->id : 0;
                        $userCoupon->coupon_id = $coupons->id;
                        $userCoupon->save();
                    }
                    if ($price <= 0) {
                            $booking_number = \Modules\Holidayz\Entities\Utility::getLastId('room_booking', 'booking_number');
                            $booking = RoomBooking::create([
                                'booking_number' => $booking_number,
                                'user_id' => isset(auth()->guard('holiday')->user()->id) ? auth()->guard('holiday')->user()->id : 0,
                                'payment_method' => __('PAYPAL'),
                                'payment_status' => 1,
                                'invoice' => null,
                                'workspace' => $hotel->workspace,
                                'first_name' => $guestDetails['firstname'],
                                'last_name' => $guestDetails['lastname'],
                                'email' =>  $guestDetails['email'],
                                'phone' => $guestDetails['phone'],
                                'address' => $guestDetails['address'],
                                'city' => $guestDetails['city'],
                                'country' => ($guestDetails['country']) ? $guestDetails['country'] : 'india',
                                'zipcode' => $guestDetails['zipcode'],
                                'total' => $price,
                                'coupon_id' => ($coupon_id) ? $coupon_id : 0,
                            ]);
                            foreach($Carts as $key => $value){
                                //
                                $toDate = \Carbon\Carbon::parse($value['check_in']);
                                $fromDate = \Carbon\Carbon::parse($value['check_out']);

                                $days = $toDate->diffInDays($fromDate);
                                //
                                $bookingOrder = RoomBookingOrder::create([
                                    'booking_id' => $booking->id,
                                    'customer_id' => isset(auth()->guard('holiday')->user()->id) ? auth()->guard('holiday')->user()->id : 0,
                                    'room_id' => $value['room_id'],
                                    'workspace' => $value['workspace'],
                                    'check_in' => $value['check_in'],
                                    'check_out' => $value['check_out'],
                                    'price' => $value['price'] * $value['room'] * $days,
                                    'room' => $value['room'],
                                    'service_charge' => $value['serviceCharge'],
                                    'services' => $value['serviceIds'],
                                ]);
                                unset($Carts[$key]);

                            }
                            $cart_json = json_encode($Carts);
                            Cookie::queue('cart', $cart_json, 1440);
                            session()->forget('guestInfo');

                            event(new CreateRoomBooking($request,$booking));
                            $type = "roombookinginvoice";
                            event(new PaypalPaymentStatus($hotel,$type,$booking));

                            //Email notification
                            if(!empty(company_setting('New Room Booking By Hotel Customer',$hotel->created_by,$hotel->workspace)) && company_setting('New Room Booking By Hotel Customer',$hotel->created_by,$hotel->workspace)  == true)
                            {
                                $user = User::where('id',$hotel->created_by)->first();
                                $customer = HotelCustomer::find($booking->user_id);
                                $room = \Modules\Holidayz\Entities\Rooms::find($bookingOrder->room_id);
                                $uArr = [
                                    'hotel_customer_name' => isset($customer->name) ? $customer->name : $booking->first_name,
                                    'invoice_number' => $booking->booking_number,
                                    'check_in_date' => $bookingOrder->check_in,
                                    'check_out_date' => $bookingOrder->check_out,
                                    'room_type' => $room->type,
                                    'hotel_name' => $hotel->name,
                                ];

                                try
                                {
                                    $resp = EmailTemplate::sendEmailTemplate('New Room Booking By Hotel Customer', [$user->email],$uArr);
                                }
                                catch(\Exception $e)
                                {
                                    $resp['error'] = $e->getMessage();
                                }

                                return redirect()->route('hotel.home', $slug)->with('success', __('Booking Successfully.') . ((isset($resp['error'])) ? '<br> <span class="text-danger" style="color:red">' . $resp['error'] . '</span>' : ''));
                            }
                            return redirect()->route('hotel.home', $slug)->with('success', 'Booking Successfully. email notification is off.');
                            return redirect()->route('hotel.home',$slug)->with('success', __('Transaction Complete.'));
                    } else {
                        $provider = new PayPalClient;
                        $provider->setApiCredentials(config('paypal'));
                        $provider->getAccessToken();
                        $response = $provider->capturePaymentOrder($request['token']);
                        $payment_id = Session::get('paypal_payment_id');
                        $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
                        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
                            $booking_number = \Modules\Holidayz\Entities\Utility::getLastId('room_booking', 'booking_number');
                            $booking = RoomBooking::create([
                                'booking_number' => $booking_number,
                                'user_id' => isset(auth()->guard('holiday')->user()->id) ? auth()->guard('holiday')->user()->id : 0,
                                'payment_method' => __('PAYPAL'),
                                'payment_status' => 1,
                                'invoice' => null,
                                'workspace' => $hotel->workspace,
                                'first_name' => $guestDetails['firstname'],
                                'last_name' => $guestDetails['lastname'],
                                'email' =>  $guestDetails['email'],
                                'phone' => $guestDetails['phone'],
                                'address' => $guestDetails['address'],
                                'city' => $guestDetails['city'],
                                'country' => ($guestDetails['country']) ? $guestDetails['country'] : 'india',
                                'zipcode' => $guestDetails['zipcode'],
                                'total' => $price,
                                'coupon_id' => ($coupon_id) ? $coupon_id : 0,
                            ]);
                            foreach($Carts as $key => $value){
                                //
                                $toDate = \Carbon\Carbon::parse($value['check_in']);
                                $fromDate = \Carbon\Carbon::parse($value['check_out']);

                                $days = $toDate->diffInDays($fromDate);
                                //
                                $bookingOrder = RoomBookingOrder::create([
                                    'booking_id' => $booking->id,
                                    'customer_id' => isset(auth()->guard('holiday')->user()->id) ? auth()->guard('holiday')->user()->id : 0,
                                    'room_id' => $value['room_id'],
                                    'workspace' => $value['workspace'],
                                    'check_in' => $value['check_in'],
                                    'check_out' => $value['check_out'],
                                    'price' => $value['price'] * $value['room'] * $days,
                                    'room' => $value['room'],
                                    'service_charge' => $value['serviceCharge'],
                                    'services' => $value['serviceIds'],
                                ]);
                                unset($Carts[$key]);
                            }
                            $cart_json = json_encode($Carts);
                            Cookie::queue('cart', $cart_json, 1440);
                            session()->forget('guestInfo');

                            event(new CreateRoomBooking($request,$booking));
                            $type = "roombookinginvoice";
                            event(new PaypalPaymentStatus($hotel,$type,$booking));

                            //Email notification
                            if(!empty(company_setting('New Room Booking By Hotel Customer',$hotel->created_by,$hotel->workspace)) && company_setting('New Room Booking By Hotel Customer',$hotel->created_by,$hotel->workspace)  == true)
                            {
                                $user = User::where('id',$hotel->created_by)->first();
                                $customer = HotelCustomer::find($booking->user_id);
                                $room = \Modules\Holidayz\Entities\Rooms::find($bookingOrder->room_id);
                                $uArr = [
                                    'hotel_customer_name' => isset($customer->name) ? $customer->name : $booking->first_name,
                                    'invoice_number' => $booking->booking_number,
                                    'check_in_date' => $bookingOrder->check_in,
                                    'check_out_date' => $bookingOrder->check_out,
                                    'room_type' => $room->type,
                                    'hotel_name' => $hotel->name,
                                ];

                                try
                                {
                                    $resp = EmailTemplate::sendEmailTemplate('New Room Booking By Hotel Customer', [$user->email],$uArr);
                                }
                                catch(\Exception $e)
                                {
                                    $resp['error'] = $e->getMessage();
                                }

                                return redirect()->route('hotel.home', $slug)->with('success', __('Booking Successfully.') . ((isset($resp['error'])) ? '<br> <span class="text-danger" style="color:red">' . $resp['error'] . '</span>' : ''));
                            }
                            return redirect()->route('hotel.home', $slug)->with('success', 'Booking Successfully. email notification is off.');
                            return redirect()->route('hotel.home',$slug)->with('success', __('Transaction Complete.'));
                        } else {
                            return redirect()->back()->with('error', __('Transaction Fail Please try again.'));
                        }
                    }
                }catch(\Exception $e){
                    return redirect()->route('hotel.home',$slug)->with('error', __('Transaction Fail.'));
                }
            } else {
                $Carts = RoomBookingCart::where(['customer_id' => auth()->guard('holiday')->user()->id])->get();
                $coupons = BookingCoupons::find($coupon_id);

                if (!empty($coupons)) {
                    $userCoupon         = new UsedBookingCoupons();
                    $userCoupon->customer_id   = isset(auth()->guard('holiday')->user()->id) ? auth()->guard('holiday')->user()->id : 0;
                    $userCoupon->coupon_id = $coupons->id;
                    $userCoupon->save();
                }
                if ($price <= 0) {
                    $booking_number = \Modules\Holidayz\Entities\Utility::getLastId('room_booking', 'booking_number');
                    $booking = RoomBooking::create([
                        'booking_number' => $booking_number,
                        'user_id' => auth()->guard('holiday')->user()->id,
                        'payment_method' => __('PAYPAL'),
                        'payment_status' => 1,
                        'invoice' => null,
                        'workspace' => $hotel->workspace,
                        'total' => $price,
                        'coupon_id' => ($coupon_id) ? $coupon_id : 0,
                    ]);
                    foreach($Carts as $key => $value){
                        $bookingOrder = RoomBookingOrder::create([
                            'booking_id' => $booking->id,
                            'customer_id' => auth()->guard('holiday')->user()->id,
                            'room_id' => $value->room_id,
                            'workspace' => $value->workspace,
                            'check_in' => $value->check_in,
                            'check_out' => $value->check_out,
                            'price' => $value->price,   // * $value->room
                            'room' => $value->room,
                            'service_charge' => $value->service_charge,
                            'services' => $value->services,
                        ]);
                    }
                    RoomBookingCart::where(['customer_id' => auth()->guard('holiday')->user()->id])->delete();

                    event(new CreateRoomBooking($request,$booking));
                    $type = "roombookinginvoice";
                    event(new PaypalPaymentStatus($hotel,$type,$booking));

                    //Email notification
                    if(!empty(company_setting('New Room Booking By Hotel Customer',$hotel->created_by,$hotel->workspace)) && company_setting('New Room Booking By Hotel Customer',$hotel->created_by,$hotel->workspace)  == true)
                    {
                        $user = User::where('id',$hotel->created_by)->first();
                        $customer = HotelCustomer::find($booking->user_id);
                        $room = \Modules\Holidayz\Entities\Rooms::find($bookingOrder->room_id);
                        $uArr = [
                            'hotel_customer_name' => isset($customer->name) ? $customer->name : $booking->first_name,
                            'invoice_number' => $booking->booking_number,
                            'check_in_date' => $bookingOrder->check_in,
                            'check_out_date' => $bookingOrder->check_out,
                            'room_type' => $room->type,
                            'hotel_name' => $hotel->name,
                        ];

                        try
                        {
                            $resp = EmailTemplate::sendEmailTemplate('New Room Booking By Hotel Customer', [$user->email],$uArr);
                        }
                        catch(\Exception $e)
                        {
                            $resp['error'] = $e->getMessage();
                        }

                        return redirect()->route('hotel.home', $slug)->with('success', __('Booking Successfully.') . ((isset($resp['error'])) ? '<br> <span class="text-danger" style="color:red">' . $resp['error'] . '</span>' : ''));
                    }
                    return redirect()->route('hotel.home', $slug)->with('success', 'Booking Successfully. email notification is off.');
                    return redirect()->route('hotel.home',$slug)->with('success', __('Transaction Complete.'));
                } else {
                    $provider = new PayPalClient;
                    $provider->setApiCredentials(config('paypal'));
                    $provider->getAccessToken();
                    $response = $provider->capturePaymentOrder($request['token']);
                    $payment_id = Session::get('paypal_payment_id');
                    $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
                    if (isset($response['status']) && $response['status'] == 'COMPLETED') {
                        $booking_number = \Modules\Holidayz\Entities\Utility::getLastId('room_booking', 'booking_number');
                        $booking = RoomBooking::create([
                            'booking_number' => $booking_number,
                            'user_id' => auth()->guard('holiday')->user()->id,
                            'payment_method' => __('PAYPAL'),
                            'payment_status' => 1,
                            'invoice' => null,
                            'workspace' => $hotel->workspace,
                            'total' => $price,
                            'coupon_id' => ($coupon_id) ? $coupon_id : 0,
                        ]);
                        foreach($Carts as $key => $value){
                            $bookingOrder = RoomBookingOrder::create([
                                'booking_id' => $booking->id,
                                'customer_id' => auth()->guard('holiday')->user()->id,
                                'room_id' => $value->room_id,
                                'workspace' => $value->workspace,
                                'check_in' => $value->check_in,
                                'check_out' => $value->check_out,
                                'price' => $value->price,   // * $value->room
                                'room' => $value->room,
                                'service_charge' => $value->service_charge,
                                'services' => $value->services,
                            ]);
                        }
                        RoomBookingCart::where(['customer_id' => auth()->guard('holiday')->user()->id])->delete();

                        event(new CreateRoomBooking($request,$booking));
                        $type = "roombookinginvoice";
                        event(new PaypalPaymentStatus($hotel,$type,$booking));

                        //Email notification
                        if(!empty(company_setting('New Room Booking By Hotel Customer',$hotel->created_by,$hotel->workspace)) && company_setting('New Room Booking By Hotel Customer',$hotel->created_by,$hotel->workspace)  == true)
                        {
                            $user = User::where('id',$hotel->created_by)->first();
                            $customer = HotelCustomer::find($booking->user_id);
                            $room = \Modules\Holidayz\Entities\Rooms::find($bookingOrder->room_id);
                            $uArr = [
                                'hotel_customer_name' => isset($customer->name) ? $customer->name : $booking->first_name,
                                'invoice_number' => $booking->booking_number,
                                'check_in_date' => $bookingOrder->check_in,
                                'check_out_date' => $bookingOrder->check_out,
                                'room_type' => $room->type,
                                'hotel_name' => $hotel->name,
                            ];

                            try
                            {
                                $resp = EmailTemplate::sendEmailTemplate('New Room Booking By Hotel Customer', [$user->email],$uArr);
                            }
                            catch(\Exception $e)
                            {
                                $resp['error'] = $e->getMessage();
                            }

                            return redirect()->route('hotel.home', $slug)->with('success', __('Booking Successfully.') . ((isset($resp['error'])) ? '<br> <span class="text-danger" style="color:red">' . $resp['error'] . '</span>' : ''));
                        }
                        return redirect()->route('hotel.home', $slug)->with('success', 'Booking Successfully. email notification is off.');
                        return redirect()->route('hotel.home',$slug)->with('success', __('Transaction Complete.'));
                    } else {
                        return redirect()->back()->with('error', __('Transaction Fail Please try again.'));
                    }
                }
            }
        }
    }
}
