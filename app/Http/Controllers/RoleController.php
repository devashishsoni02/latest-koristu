<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        if(Auth::user()->can('roles manage'))
        {
            $roles = Role::where('created_by', '=', \Auth::user()->id)->get();
            $modules = array_merge(['General'],getModuleList());
            return view('role.index',compact('modules','roles'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function create()
    {
        if(Auth::user()->can('roles create'))
        {
            $user = \Auth::user();
            if($user->type == 'super admin')
            {
                $permissions = Permission::all()->pluck('name', 'id')->toArray();
            }
            else
            {
                $permissions = new Collection();
                foreach($user->roles as $role)
                {
                    $permissions = $permissions->merge($role->permissions);
                }
                $permissions = $permissions->pluck('name', 'id')->toArray();
            }
            $modules = array_merge(['General','ProductService'],getshowModuleList());
            return view('role.create', compact('permissions','modules'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }

    }


    public function store(Request $request)
    {
        if(Auth::user()->can('roles create'))
        {

            $validator = \Validator::make(
                $request->all(), [
                    'name' => 'required|max:100|unique:roles,name,NULL,id,created_by,' . \Auth::user()->id,
                    'permissions' => 'required',
                ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $name             = $request['name'];
            $role             = new Role();
            $role->name       = $name;
            $role->created_by = \Auth::user()->id;
            $permissions      = $request['permissions'];
            $role->save();

            foreach($permissions as $permission)
            {
                $p = Permission::where('id', '=', $permission)->firstOrFail();
                $role->givePermissionTo($p);
            }

             return redirect()->route('roles.index')->with('success','Role ' . $role->name .' successfully created.'
            );
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }

    public function show(Request $request)
    {
        return redirect()->back();
    }

    public function edit(Role $role)
    {
        if(Auth::user()->can('roles edit'))
        {
            $user = \Auth::user();
            $permissions = Permission::all()->pluck('name', 'id')->toArray();
            $modules = array_merge(['General','ProductService'],getshowModuleList());
            return view('role.edit', compact('role', 'permissions','modules'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }

    }

    public function update(Request $request, Role $role)
    {
        if(Auth::user()->can('roles edit'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                    'name' => 'required|max:100|unique:roles,name,' . $role['id'] . ',id,created_by,' . \Auth::user()->id,
                                    'permissions' => 'required',
                                ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $input       = $request->except(['permissions']);
            $permissions = $request['permissions'];
            $role->fill($input)->save();

            $p_all = Permission::all();

            foreach($p_all as $p)
            {
                $role->revokePermissionTo($p);
            }

            foreach($permissions as $permission)
            {
                $p = Permission::where('id', '=', $permission)->firstOrFail();
                $role->givePermissionTo($p);
            }

            $users = User::where('type', $role->name)->get();

            // Sidebar Performance Changes
            foreach ($users as $user) {
                Cache::forget('cached_menu_auth' . $user->id);
            }
            return redirect()->route('roles.index')->with('success','Role ' . $role->name .' successfully updated.');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function destroy(Role $role)
    {
        if(Auth::user()->can('roles delete'))
        {
            $role->delete();
            return redirect()->route('roles.index')->with(
                'success', 'Role successfully deleted.'
            );

        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
