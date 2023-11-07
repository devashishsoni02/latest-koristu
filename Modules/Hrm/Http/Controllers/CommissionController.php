<?php

namespace Modules\Hrm\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Hrm\Entities\Commission;
use Modules\Hrm\Entities\Employee;
use Modules\Hrm\Events\CreateCommission;
use Modules\Hrm\Events\DestroyCommission;
use Modules\Hrm\Events\UpdateCommission;

class CommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function commissionCreate($id)
    {
        if(\Auth::user()->can('commission create'))
        {
            $employee = Employee::find($id);
            $commissions =Commission::$commissiontype;
            return view('hrm::commission.create', compact('employee','commissions'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('hrm::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if(\Auth::user()->can('commission create'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'employee_id' => 'required',
                                   'title' => 'required',
                                   'amount' => 'required|numeric|min:0',
                                   'type' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $commission              = new Commission();
            $commission->employee_id = $request->employee_id;
            $commission->title       = $request->title;
            $commission->type        = $request->type;
            $commission->amount      = $request->amount;
            $commission->workspace   = getActiveWorkSpace();
            $commission->created_by  = creatorId();
            $commission->save();

            event(new CreateCommission($request, $commission));

            return redirect()->back()->with('success', __('Commission successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return redirect()->back();
        return view('hrm::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Commission $commission)
    {
        if(\Auth::user()->can('commission edit'))
        {
            if($commission->created_by == creatorId() && $commission->workspace == getActiveWorkSpace())
            {
                $commissions =Commission::$commissiontype;
                return view('hrm::commission.edit', compact('commission','commissions'));
            }
            else
            {
                return response()->json(['error' => __('Permission denied.')], 401);
            }
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Commission $commission)
    {
        if(\Auth::user()->can('commission edit'))
        {
            if($commission->created_by == creatorId() && $commission->workspace == getActiveWorkSpace())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                        'title' => 'required',
                                        'amount' => 'required|numeric|min:0',
                                        'type' => 'required',
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                $commission->title  = $request->title;
                $commission->type  = $request->type;
                $commission->amount = $request->amount;
                $commission->save();

                event(new UpdateCommission($request, $commission));

                return redirect()->back()->with('success', __('Commission successfully updated.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Commission $commission)
    {
        if(Auth::user()->can('commission delete'))
        {
            if($commission->created_by == creatorId() && $commission->workspace == getActiveWorkSpace())
            {
                event(new DestroyCommission($commission));

                $commission->delete();

                return redirect()->back()->with('success', __('Commission successfully deleted.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
