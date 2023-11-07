<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Plan;
use App\Models\UserCoupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    public function index()
    {
        if(\Auth::user()->can('coupon manage'))
        {
            $coupons = Coupon::get();

            return view('coupon.index', compact('coupons'));
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
            return view('coupon.create');
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
                                'name' => 'required',
                                'discount' => 'required|numeric',
                                'limit' => 'required|numeric',
                                // 'manualCode' => 'required|code|unique:coupons',
                            ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            if(Coupon::where('code', $request->manualCode)->exists())
            {
                    return redirect()->back()->with('error','Coupon code has already been taken.');
            }
            if(empty($request->manualCode) && empty($request->autoCode))
            {
                return redirect()->back()->with('error', 'Coupon code is required');
            }
            $coupon           = new Coupon();
            $coupon->name     = $request->name;
            $coupon->discount = $request->discount;
            $coupon->limit    = $request->limit;

            if(!empty($request->manualCode))
            {
                $coupon->code = strtoupper($request->manualCode);
            }

            if(!empty($request->autoCode))
            {
                $coupon->code = $request->autoCode;
            }

            $coupon->save();

            return redirect()->route('coupons.index')->with('success', __('Coupon successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function show(Coupon $coupon)
    {
        $userCoupons = UserCoupon::where('coupon', $coupon->id)->get();

        return view('coupon.view', compact('userCoupons'));
    }


    public function edit(Coupon $coupon)
    {
        if(\Auth::user()->can('coupon edit'))
        {
            return view('coupon.edit', compact('coupon'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function update(Request $request, Coupon $coupon)
    {
        if(\Auth::user()->can('coupon edit'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'name' => 'required',
                                   'discount' => 'required|numeric',
                                   'limit' => 'required|numeric',
                                   'code' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $coupon           = Coupon::find($coupon->id);
            $coupon->name     = $request->name;
            $coupon->discount = $request->discount;
            if($coupon->limit < $request->limit)
            {
                $coupon->is_active = 1;
            }
            $coupon->limit    = $request->limit;
            $coupon->code     = $request->code;
            $coupon->save();

            return redirect()->route('coupons.index')->with('success', __('Coupon successfully updated.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function destroy(Coupon $coupon)
    {
        if(\Auth::user()->can('coupon delete'))
        {
            $coupon->delete();

            return redirect()->route('coupons.index')->with('success', __('Coupon successfully deleted.'));
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
