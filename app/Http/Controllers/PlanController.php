<?php

namespace App\Http\Controllers;

use App\Models\AddOn;
use App\Models\Order;
use App\Models\Plan;
use App\Models\PlanField;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Nwidart\Modules\Facades\Module;
use PDO;
use Rawilk\Settings\Support\Context;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if(Auth::user()->can('plan manage'))
        {
            $plan = Plan::where('custom_plan',1)->first();

            if(Auth::user()->type == 'super admin')
            {
                $modules = Module::getByStatus(1);
                return view('plans.index',compact('modules','plan'));
            }
            else
            {
                $subscription = Session::get('Subscription');
                if(admin_setting('plan_package') == 'on'  && $request['type'] != 'subscription' && $subscription != 'custom_subscription')
                {
                    return redirect()->route('active.plans');
                }
                // Pre selected module, user,and time period on pricing page
                $session = Session::get('user-module-selection');
                $modules = Module::getByStatus(1);
                $purchaseds = [];
                $active_module = ActivatedModule();
                if(count($active_module) > 0)
                {
                    foreach ($active_module as $key => $value)
                    {
                        if(array_key_exists($value,$modules) == true)
                        {
                            $module = Module::find($value);
                            $path = $module->getPath() . '/module.json';
                            $json = json_decode(file_get_contents($path), true);
                            if (!isset($json['display']) || $json['display'] == true)
                            {
                                array_push($purchaseds,$modules[$value]);
                            }
                            unset($modules[$value]);
                        }
                    }
                }

                if((admin_setting('custome_package') == 'on' && $request['type'] == 'subscription') || (admin_setting('custome_package') == 'on' && empty($request->all())))
                {
                    return view('plans.marketplace',compact('plan','modules','purchaseds','session'));
                }
                else
                {
                    return redirect()->back()->with('error', __('Something went wrong please try again.'));
                }
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function PlanList()
    {
        if(Auth::user()->can('plan manage'))
        {
            if(admin_setting('plan_package') != 'on')
            {
                return redirect()->route('plans.index');
            }
            $plan = Plan::where('custom_plan',0)->get();
            $modules = Module::getByStatus(1);
            return view('plans.planslist',compact('plan','modules'));
        }
        else
        {
            return redirect()->back()->with('error', __('Something went wrong please try again.'));
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->can('plan create'))
        {
            if(Auth::user()->type == 'super admin')
            {
                // $modules = Module::all();
                $plan_type = Plan::$plan_type;
                $modules = Module::getByStatus(1);
                return view('plans.create',compact('modules','plan_type'));
            }
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->can('plan create'))
        {
            $validator = \Validator::make(
                $request->all(), [
                    'package_price_monthly' => 'required|min:0',
                    'package_price_yearly' => 'required|min:0',
                    'price_per_user_monthly' => 'required|min:0',
                    'price_per_user_yearly' => 'required|min:0',
                    'price_per_workspace_monthly' => 'required|min:0',
                    'price_per_workspace_yearly' => 'required|min:0',
                ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $plan = Plan::where('custom_plan',1)->first();
            $plan->package_price_monthly = !empty($request->package_price_monthly) ? $request->package_price_monthly : 0;
            $plan->package_price_yearly = !empty($request->package_price_yearly) ? $request->package_price_yearly : 0;
            $plan->price_per_user_monthly = !empty($request->price_per_user_monthly) ? $request->price_per_user_monthly : 0;
            $plan->price_per_user_yearly = !empty($request->price_per_user_yearly) ? $request->price_per_user_yearly : 0;
            $plan->price_per_workspace_monthly = !empty($request->price_per_workspace_monthly) ? $request->price_per_workspace_monthly : 0;
            $plan->price_per_workspace_yearly = !empty($request->price_per_workspace_yearly) ? $request->price_per_workspace_yearly : 0;
            $plan->save();

            return redirect()->route('plans.index')->with('success', 'Details Saved Successfully.');

        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        return redirect()->route('plans.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        if(Auth::user()->can('plan edit'))
        {
            $plan_type = Plan::$plan_type;
            $modules = Module::getByStatus(1);
            return view('plans.edit',compact('plan','modules','plan_type'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        if(Auth::user()->can('plan edit'))
        {
            $validator = \Validator::make(
                $request->all(), [
                    'name' => 'required',
                    'number_of_user' => 'required|not_in:0',
                    'number_of_workspace' => 'required|not_in:0',
                    'modules' => 'required',
                ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $plan = Plan::find($plan->id);
            $plan->name = !empty($request->name) ? $request->name : '';
            $plan->is_free_plan = !empty($request->is_free_plan) ? $request->is_free_plan : 0;
            $plan->number_of_user = !empty($request->number_of_user) ? $request->number_of_user : 0;
            $plan->number_of_workspace = !empty($request->number_of_workspace) ? $request->number_of_workspace : 0;
            if (!empty($request->is_free_plan)){

                $plan->package_price_monthly =  0;
                $plan->package_price_yearly =  0;
            }else{
                $plan->package_price_monthly = !empty($request->package_price_monthly) ? $request->package_price_monthly : 0;
                $plan->package_price_yearly = !empty($request->package_price_yearly) ? $request->package_price_yearly : 0;
            }
            $plan->trial = !empty($request->trial) ? $request->trial : 0;
            if($request->trial == 1){

                $plan->trial_days = !empty($request->trial_days) ? $request->trial_days : 0;
            }
            $plan->modules = !empty($request->modules) ? implode(',',$request->modules) : '';
            $plan->save();
            return redirect()->back()->with('success', 'Plan Update Successfully.');

        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        //
    }

    public function PlanStore(Request $request)
    {
        if(Auth::user()->can('plan create'))
        {
            $validator = \Validator::make(
                $request->all(), [
                    'name' => 'required',
                    'number_of_user' => 'required|not_in:0',
                    'number_of_workspace' => 'required|not_in:0',
                    'modules' => 'required',
                ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $plan = new Plan();
            $plan->name = !empty($request->name) ? $request->name : '';
            $plan->is_free_plan = !empty($request->is_free_plan) ? $request->is_free_plan : 0;
            $plan->number_of_user = !empty($request->number_of_user) ? $request->number_of_user : 0;
            $plan->number_of_workspace = !empty($request->number_of_workspace) ? $request->number_of_workspace : 0;
            $plan->package_price_monthly = !empty($request->package_price_monthly) ? $request->package_price_monthly : 0;
            $plan->package_price_yearly = !empty($request->package_price_yearly) ? $request->package_price_yearly : 0;
            $plan->trial = !empty($request->trial) ? $request->trial : 0;
            if($request->trial == 1)
            {
                $plan->trial_days = !empty($request->trial_days) ? $request->trial_days : 0;
            }
            $plan->modules = !empty($request->modules) ? implode(',',$request->modules) : '';
            $plan->save();

            return redirect()->back()->with('success', 'Plan Saved Successfully.');

        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function payment($plan_id)
    {
        if(Auth::user()->can('plan purchase'))
        {
            $plan_id = decrypt($plan_id);
            $plan = Plan::find($plan_id);
            return view('plans.payment',compact('plan'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function orders()
    {
        if(Auth::user()->can('plan orders'))
        {
            $user                       = \Auth::user();
            $orders = Order::select(
                    [
                        'orders.*',
                        'users.name as user_name',
                    ]
                )->join('users', 'orders.user_id', '=', 'users.id')->where(function($query) use ($user)
                {
                    if($user->type != 'super admin')
                    {
                        $query->where('orders.user_id', $user->id);
                    }
                })->orderBy('orders.created_at', 'DESC')->get();

            return view('plan_order.index', compact('orders'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function AddOneDetail($module = null)
    {
        if(Auth::user()->can('module edit') && !empty($module))
        {
            $addon = AddOn::where('module',$module)->first();
            if(!empty($addon))
            {
                return view('plans.module_detail',compact('addon'));
            }
            else
            {
                return response()->json(['error' => __('Something went wrong, Data not found.')], 401);
            }
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }
    public function AddOneDetailSave(Request $request,$id = null)
    {
        if(Auth::user()->can('module edit') && !empty($id))
        {
            $addon = AddOn::find($id);

            $validator = \Validator::make(
                $request->all(), [
                    'name' => 'required|unique:add_ons,name,'.$addon->id,
                    'monthly_price' => 'required|min:0',
                    'yearly_price' => 'required|min:0',
                    'module_logo' => 'mimes:jpg,jpeg,png',
                ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $addon->name = $request->name;
            $addon->monthly_price = $request->monthly_price;
            $addon->yearly_price = $request->yearly_price;
            $addon->save();

            if (!empty($request->module_logo))
            {
                $module = Module::find($addon->module);
                if(!empty($module))
                {
                    $module->getPath();
                    $fileNameToStore = 'favicon.png';
                    $dir             = $module->getPath();
                    $request->module_logo->move($dir, $fileNameToStore);
                }

            }
            return redirect()->back()->with('success', 'Module Setting Save Successfully.');
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function PackageData(Request $request)
    {
        $userContext = new Context(['user_id' => \Auth::user()->id,'workspace_id'=>getActiveWorkSpace()]);
        if($request->has('plan_package')  && $request->plan_package != null && ($request->plan_package == "on" || admin_setting('custome_package') == "on"))
        {
            \Settings::context($userContext)->set('plan_package', $request->plan_package);
            return response()->json(['plan_package' => admin_setting('plan_package')]);

        }elseif($request->has('custome_package')  && $request->custome_package != null && ($request->custome_package == "on" || admin_setting('plan_package') == "on"))
        {
            \Settings::context($userContext)->set('custome_package', $request->custome_package);
            return response()->json(['custome_package' => admin_setting('custome_package')]);
        }
        elseif($request->plan_package == null || $request->custome_package == null){
            return response()->json('error');
        }
    }

    public function ActivePlans(Request $request)
    {
        if(Auth::user()->can('plan manage') && Auth::user()->type != 'super admin' )
        {
            $plan = Plan::where('custom_plan',0)->get();
            $modules = Module::getByStatus(1);

            return view('plans.activeplans',compact('plan','modules'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function PlanBuy(Request $request,$id)
    {
        if(Auth::user()->can('plan manage') && Auth::user()->type != 'super admin')
        {
            try {
                $id       = Crypt::decrypt($id);
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', __('Plan Not Found.'));
            }
            $plan = Plan::find($id);
            $user = User::where('id', Auth::user()->id)->first();
            if(Auth::user()->active_plan != $plan->id)
            {
                $session = Session::get('user-module-selection');
                $modules = Module::getByStatus(1);
                $active_module = ActivatedModule();
                // if($plan->is_free_plan == 1)
                // {
                //     $assignPlan = $user->assignPlan($plan->id,'Month',$plan->modules,0,$user->id);
                //     if($assignPlan['is_success']){

                //         return redirect()->back()->with('success', __('Plan activated Successfully!'));
                //     }
                // }
                return view('plans.planpayment',compact('plan','modules'));
            }else{
                return redirect()->route('active.plans')->with('error', __('Plan is already assign.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function PlanTrial($id)
    {
        if(Auth::user()->can('plan manage') && Auth::user()->type != 'super admin')
        {
            try {
                $id       = Crypt::decrypt($id);
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', __('Plan Not Found.'));
            }
            $plan = Plan::find($id);
            $user = User::where('id', Auth::user()->id)->first();
            if(!empty($plan->trial) == 1){

                $user->assignPlan($plan->id,'Trial',$plan->modules,0,$user->id);
                $user->is_trial_done = 1;
                $user->save();
            }
            return redirect()->back()->with('success', 'Your trial has been started.');
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }
}
