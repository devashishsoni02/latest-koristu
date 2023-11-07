<?php

namespace Modules\Hrm\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Hrm\Entities\Branch;
use Modules\Hrm\Entities\Department;
use Modules\Hrm\Entities\Designation;
use Modules\Hrm\Entities\Employee;
use Modules\Hrm\Events\CreateDepartment;
use Modules\Hrm\Events\DestroyDepartment;
use Modules\Hrm\Events\UpdateDepartment;
use Nwidart\Modules\Facades\Module;
use Rawilk\Settings\Support\Context;


class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if(Auth::user()->can('department manage'))
        {
            $departments = Department::where('created_by', '=', creatorId())->where('workspace',getActiveWorkSpace())->get();
            return view('hrm::department.index', compact('departments'));
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
        if(Auth::user()->can('department create'))
        {
            $branch = Branch::where('created_by', '=', creatorId())->where('workspace',getActiveWorkSpace())->get()->pluck('name', 'id');
            return view('hrm::department.create', compact('branch'));
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
        if(Auth::user()->can('department create'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'branch_id' => 'required',
                                   'name' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $department             = new Department();
            $department->branch_id  = $request->branch_id;
            $department->name       = $request->name;
            $department->workspace  = getActiveWorkSpace();
            $department->created_by = creatorId();
            $department->save();

            event(new CreateDepartment($request, $department));

            return redirect()->route('department.index')->with('success', __('Department  successfully created.'));
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
    public function edit(Department $department)
    {
        if(Auth::user()->can('department edit'))
        {
            if($department->created_by == creatorId() &&  $department->workspace  == getActiveWorkSpace())
            {
                $branch = Branch::where('created_by', '=', creatorId())->where('workspace',getActiveWorkSpace())->get()->pluck('name', 'id');

                return view('hrm::department.edit', compact('department', 'branch'));
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
    public function update(Request $request, Department $department)
    {
        if(Auth::user()->can('department edit'))
        {
            if($department->created_by == creatorId() &&  $department->workspace  == getActiveWorkSpace())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'branch_id' => 'required',
                                       'name' => 'required|max:20',
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                // update Designation branch id
                Designation::where('department_id',$department->id)->where('created_by', '=', creatorId())->where('workspace',getActiveWorkSpace())->update(['branch_id' => $request->branch_id]);

                $department->branch_id = $request->branch_id;
                $department->name      = $request->name;
                $department->save();

                event(new UpdateDepartment($request, $department));

                return redirect()->route('department.index')->with('success', __('Department successfully updated.'));
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
    public function destroy(Department $department)
    {
        if(Auth::user()->can('department delete'))
        {
            if($department->created_by == creatorId() &&  $department->workspace  == getActiveWorkSpace())
            {
                $employee     = Employee::where('department_id',$department->id)->where('workspace',getActiveWorkSpace())->get();
                if(count($employee) == 0)
                {
                    Designation::where('department_id',$department->id)->delete();

                    event(new DestroyDepartment($department));

                    $department->delete();
                }
                else
                {
                    return redirect()->route('department.index')->with('error', __('This department has employees. Please remove the employee from this department.'));
                }
                return redirect()->route('department.index')->with('success', __('Department successfully deleted.'));
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
    public function DepartmentNameEdit()
    {
        if(Auth::user()->can('department name edit'))
        {
            return view('hrm::department.departmentnameedit');
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }
    public function saveDepartmentName(Request $request)
    {
        if(Auth::user()->can('department name edit'))
        {
            $validator = \Validator::make($request->all(),
            [
                'hrm_department_name' => 'required',
            ]);

            if($validator->fails()){
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            else
            {
                $userContext = new Context(['user_id' => creatorId(),'workspace_id'=>getActiveWorkSpace()]);
                \Settings::context($userContext)->set('hrm_department_name', $request->hrm_department_name);

                return redirect()->route('department.index')->with('success', __('Department Name successfully updated.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
