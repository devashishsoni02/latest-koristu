<?php

namespace Modules\Hrm\Http\Controllers;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Hrm\Entities\Department;
use Modules\Hrm\Entities\Designation;
use Modules\Hrm\Entities\Employee;
use Modules\Hrm\Events\CreateDesignation;
use Modules\Hrm\Events\DestroyDesignation;
use Modules\Hrm\Events\UpdateDesignation;
use Rawilk\Settings\Support\Context;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if(Auth::user()->can('designation manage'))
        {
            $designations = Designation::where('created_by', '=', creatorId())->where('workspace',getActiveWorkSpace())->get();

            return view('hrm::designation.index', compact('designations'));
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
        if(\Auth::user()->can('designation create'))
        {
            $departments = Department::where('created_by', '=', creatorId())->where('workspace',getActiveWorkSpace())->get()->pluck('name', 'id');

            return view('hrm::designation.create', compact('departments'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if(\Auth::user()->can('designation create'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'department_id' => 'required',
                                   'name' => 'required|max:20',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            try
            {
                $branch = Department::where('id',$request->department_id)->where('created_by', '=', creatorId())->where('workspace',getActiveWorkSpace())->first()->branch->id;
            }
            catch(Exception $e)
            {
                $branch = null;
            }
            $designation                = new Designation();
            $designation->branch_id     = $branch;
            $designation->department_id = $request->department_id;
            $designation->name          = $request->name;
            $designation->workspace  = getActiveWorkSpace();
            $designation->created_by    = creatorId();
            $designation->save();
            
            event(new CreateDesignation($request, $designation));

            return redirect()->route('designation.index')->with('success', __('Designation  successfully created.'));
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
    public function edit(Designation $designation)
    {
        if(\Auth::user()->can('designation edit'))
        {
            if($designation->created_by == creatorId() &&  $designation->workspace  == getActiveWorkSpace())
            {
                $departments = Department::where('created_by', '=', creatorId())->where('workspace',getActiveWorkSpace())->get()->pluck('name', 'id');
                return view('hrm::designation.edit', compact('designation', 'departments'));
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
    public function update(Request $request, Designation $designation)
    {
        if(\Auth::user()->can('designation edit'))
        {
            if($designation->created_by == creatorId() &&  $designation->workspace  == getActiveWorkSpace())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'department_id' => 'required',
                                       'name' => 'required|max:20',
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }
                try
                {
                    $branch = Department::where('id',$request->department_id)->where('created_by', '=', creatorId())->where('workspace',getActiveWorkSpace())->first()->branch->id;
                }
                catch(Exception $e)
                {
                    $branch = null;
                }
                $designation->branch_id     = $branch;
                $designation->department_id = $request->department_id;
                $designation->name          = $request->name;
                $designation->save();

                event(new UpdateDesignation($request, $designation));

                return redirect()->route('designation.index')->with('success', __('Designation  successfully updated.'));
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
    public function destroy(Designation $designation)
    {
        if(\Auth::user()->can('designation delete'))
        {
            if($designation->created_by == creatorId() &&  $designation->workspace  == getActiveWorkSpace())
            {
                $employee     = Employee::where('designation_id',$designation->id)->where('workspace',getActiveWorkSpace())->get();
                if(count($employee) == 0)
                {
                    event(new DestroyDesignation($designation));

                    $designation->delete();
                }
                else
                {
                    return redirect()->route('designation.index')->with('error', __('This designation has employees. Please remove the employee from this designation.'));
                }
                return redirect()->route('designation.index')->with('success', __('Designation successfully deleted.'));
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
    public function DesignationNameEdit()
    {
        if(Auth::user()->can('designation name edit'))
        {
            return view('hrm::designation.designationnameedit');
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }
    public function saveDesignationName(Request $request)
    {
        if(Auth::user()->can('designation name edit'))
        {
            $validator = \Validator::make($request->all(),
            [
                'hrm_designation_name' => 'required',
            ]);

            if($validator->fails()){
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            else
            {
                $userContext = new Context(['user_id' => creatorId(),'workspace_id'=>getActiveWorkSpace()]);
                \Settings::context($userContext)->set('hrm_designation_name', $request->hrm_designation_name);

                return redirect()->route('designation.index')->with('success', __('Designation Name successfully updated.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
