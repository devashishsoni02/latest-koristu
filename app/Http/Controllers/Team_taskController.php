<?php

namespace App\Http\Controllers;

use App\Models\Team_task;
use App\Models\Day;
use App\Models\Month;
use App\Models\User;
use App\Models\Date;
use Illuminate\Http\Request;

class Team_taskController extends Controller
{

    public function index()
    {
        if(\Auth::user()->can('coupon manage'))
        {
            $team_tasks = Team_task::get();
            return view('team_tasks.index', compact('team_tasks'));

        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function create()
    {

       
        if(\Auth::user()->can('coupon create'))
        {
            $dates = Date::select('dates.*')->get();
            $days = Day::select('days.*')->orderby('id')->first()->get();
            $months = Month::select('months.*')->get();
            $users = User::select('users.*')->get();
            return view('team_tasks.create', compact('dates', 'days', 'months','users'));

        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


   public function store(Request $request)
    {
        if(\Auth::user()->can('coupon create'))
        {
            $validator = \Validator::make(
                $request->all(), [

                                'title' => 'required',
                                'priority' => 'required',   
                                'description' => 'required', 
                                'dates' => 'required',   
                                'days' => 'required',
                                'months' => 'required',
                                'start_date' => 'required',
                                'due_date' => 'required',
                                'assign_to' => 'required',
                            ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
          
            $team_task           = new Team_task();
            $team_task->title     = $request->title;  
            $team_task->priority     = $request->priority;  
            $team_task->description     = $request->description;
            // $team_task->dates     = $request->dates;
            $team_task['dates'] = implode(",", $request->dates);
            $team_task['days'] = implode(",", $request->days);
            $team_task['months'] = implode(",", $request->months);
            $team_task['assign_to'] = implode(",", $request->assign_to);
            $team_task['start_date']  = $request->start_date;
            $team_task['due_date']  = $request->due_date ;

            try{
                $team_task->save();

            }catch(PDOExeption $e){

                return $e->getMessage();
            }
           

           
            return redirect()->route('team_tasks.index')->with('success', __('Team_task successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function show(Team_task $team_task)
    {
        $team_tasks = Team_task::where('id', $team_task->id)->get();

        return view('team_tasks.view', compact('team_tasks'));
    }


    public function edit(Team_task $team_task)
    {
        if(\Auth::user()->can('coupon edit'))
        {
            $users = User::select('users.*')->get();
            $days = Day::select('days.*')->get();
            $months = Month::select('months.*')->get();
            $dates = Date::select('dates.*')->get();

            $team_task->assign_to = explode(",", $team_task->assign_to);
            $team_task->days = explode(",", $team_task->days);
            $team_task->months = explode(",", $team_task->months);
            $team_task->dates = explode(",", $team_task->dates);

            return view('team_tasks.edit', compact('team_task', 'days', 'users', 'months', 'dates'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function update(Request $request, Team_task $team_task)
    {
        if(\Auth::user()->can('coupon edit'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'title' => 'required',
                                   'description' => 'required', 
                                   'assign_to' => 'required',  
                                   'days' => 'required',     
                                   'months' => 'required',     
                                   'dates' => 'required',     

                                 
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $team_task           = Team_task::find($team_task->id);
          
            $team_task->title     = $request->title;  
            $team_task->description     = $request->description;   
            $team_task->assign_to     = $request->assign_to; 
            $team_task->days     = $request->days ; 
            $team_task->months     = $request->months ; 
            $team_task->dates     = $request->dates ; 
       
            $team_task->save();

            return redirect()->route('team_tasks.index')->with('success', __('Team_task Name successfully updated.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function destroy(Team_task $team_task)
    {
        if(\Auth::user()->can('coupon delete'))
        {
            $team_task->delete();

            return redirect()->route('team_tasks.index')->with('success', __('Team_task successfully deleted.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function applyCoupon(Request $request)
    {
        $plan = Plan::find($request->plan_id);
        if($plan && $request->coupon != '')
        {
            $price = ($request->duration == 'Year') ? $plan->package_price_yearly : $plan->package_price_monthly;
            $coupons  = Coupon::where('code', strtoupper($request->coupon))->where('is_active', '1')->first();
            if(!empty($coupons) && intval($price) > 0)
            {
                $usedCoupun = $coupons->used_coupon();
                if($coupons->limit == $usedCoupun)
                {
                    return response()->json(
                        [
                            'is_success' => false,
                            'price' => $price,
                            'message' => __('This coupon code has expired.'),
                        ]
                    );
                }
                else
                {

                    $discount_value = ($price / 100) * $coupons->discount;
                    $plan_price     = $price - $discount_value;
                    return response()->json(
                        [
                            'is_success' => true,
                            'final_price' => $plan_price,
                            'price' => $price,
                            'message' => __('Coupon code has applied successfully.'),
                        ]
                    );
                }
            }
            else
            {
                return response()->json(
                    [
                        'is_success' => false,
                        'price' => $price,
                        'message' => __('This coupon code is invalid or has expired.'),
                    ]
                );
            }
        }
    }
}
