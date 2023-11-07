<?php

namespace App\Http\Controllers;

use App\Events\CancelSubscription;
use App\Models\AddOn;
use App\Models\Sidebar;
use App\Models\User;
use App\Models\userActiveModule;
use Nwidart\Modules\Facades\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Permission as ModelsPermission;
use ZipArchive;

class ModuleController extends Controller
{
    public function index(){
        if(Auth::user()->can('module manage'))
        {
            $modules = Module::all();
            $module_path = Module::getPath();
            return view('module.index',compact('modules','module_path'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function add(){
        if(Auth::user()->can('module add'))
        {
            return view('module.add');
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function enable(Request $request)
    {
        $module = Module::find($request->name);
        if(!empty($module))
        {
            // Sidebar Performance Changes
            Cache::flush();

            \App::setLocale('en');

            if($module->isEnabled())
            {
                $check_child_module = $this->Check_Child_Module($module);
                if($check_child_module == true)
                {
                    Sidebar::where('module',$request->name)->update(['is_visible'=>0]);
                    $module->disable();
                    return redirect()->back()->with('success', __('Module Disable Successfully!'));
                }
                else
                {
                    return redirect()->back()->with('error', __($check_child_module['msg']));
                }

            }
            else
            {
                $check_parent_module = $this->Check_Parent_Module($module);
                if($check_parent_module['status'] == true)
                {
                    Sidebar::where('module',$request->name)->update(['is_visible'=>1]);
                    Artisan::call('module:migrate '.$request->name);
                    Artisan::call('module:seed '.$request->name);

                    $addon = AddOn::where('module',$request->name)->first();
                    if(empty($addon))
                    {
                        $addon = new AddOn;
                        $addon->module = $request->name;
                        $addon->name = Module_Alias_Name($request->name);
                        $addon->monthly_price = 0;
                        $addon->yearly_price = 0;

                        $addon->save();
                    }
                    $module->enable();
                    // Artisan::call('module:migrate-rollback '.$module);
                    return redirect()->back()->with('success', __('Module Enable Successfully!'));
                }
                else
                {
                    return redirect()->back()->with('error', __($check_parent_module['msg']));
                }

            }
        }else{
            return redirect()->back()->with('error', __('oops something wren wrong!'));
        }
    }
    // public function enable(Request $request){
    //     $module = Module::find($request->name);
    //     if(!empty($module))
    //     {
    //         if($module->isEnabled()){
    //             $module->disable();
    //             Sidebar::where('module',$request->name)->update(['is_visible'=>0]);
    //             return redirect()->back()->with('success', __('Module Disable Successfully!'));
    //         }else{
    //             $module->enable();
    //             Artisan::call('module:migrate '.$request->name);
    //             Artisan::call('module:seed '.$request->name);
    //             Sidebar::where('module',$request->name)->update(['is_visible'=>1]);
    //             return redirect()->back()->with('success', __('Module Enable Successfully!'));
    //         }
    //     }else{

    //     }
    // }
    public function install(Request $request){
        $zip = new ZipArchive;
        try {
                $res = $zip->open($request->file);
          } catch (\Exception $e) {
                return error_res($e->getMessage());
          }
        if ($res === TRUE)
        {
            $zip->extractTo('Modules/');
            $zip->close();
            return success_res('Install successfully.');
        } else {
            return error_res('oops something wren wrong');
        }
        return error_res('oops something wren wrong');
    }

    public function remove($module)
    {
        if(Auth::user()->can('module remove'))
        {
            $module = Module::find($module);
            if($module)
            {
                $module->disable();
                $module->delete();
                Sidebar::where('module',$module)->delete();
                ModelsPermission::where('module',$module)->delete();
                Artisan::call('module:migrate-refresh '.$module);
                AddOn::where('module',$module)->delete();

                // Sidebar Performance Changes
                Cache::flush();
                return redirect()->back()->with('success', __('Module delete successfully!'));
            }
            else
            {
                return redirect()->back()->with('error', __('oops something wren wrong!'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function Check_Parent_Module($module)
    {
        $path =$module->getPath().'/module.json';
        $json = json_decode(file_get_contents($path), true);
        $data['status'] = true;
        $data['msg'] = '';

        if(isset($json['parent_module']) && !empty($json['parent_module']))
        {
            foreach ($json['parent_module'] as $key => $value) {
                $modules = implode(',',$json['parent_module']);
                $parent_module = module_is_active($value);
                if($parent_module == true)
                {
                    $module = Module::find($value);
                    if($module)
                    {
                         $this->Check_Parent_Module($module);
                    }
                }
                else
                {
                    $data['status'] = false;
                    $data['msg'] = 'please activate this module '.$modules;
                    return $data;
                }
            }
            return $data;
        }
        else
        {
            return $data;
        }
    }
    public function Check_Child_Module($module)
    {
        $path =$module->getPath().'/module.json';
        $json = json_decode(file_get_contents($path), true);
        $status = true;
        if(isset($json['child_module']) && !empty($json['child_module']))
        {
            foreach ($json['child_module'] as $key => $value)
            {
                $child_module = module_is_active($value);
                if($child_module == true)
                {
                    $module = Module::find($value);
                    Sidebar::where('module',$value)->update(['is_visible'=>0]);
                    $module->disable();
                    if($module)
                    {
                        $this->Check_Child_Module($module);
                    }
                }
            }
            return true;
        }
        else
        {
            return true;
        }
    }
    public function GuestModuleSelection(Request $request)
    {
        try
        {
            $post = $request->all();
            unset($post['_token']);
            Session::put('user-module-selection', $post);
            Session::put('Subscription', 'custom_subscription');

        }
        catch (\Throwable $th)
        {

        }
    }
    public function ModuleReset(Request $request)
    {
       $value = Session::get('user-module-selection');
       if(!empty($value))
       {
         Session::forget('user-module-selection');
       }
       return redirect()->route('plans.index');
    }
    public function CancelAddOn($name = null)
    {
        if(!empty($name))
        {
            $name         = \Illuminate\Support\Facades\Crypt::decrypt($name);
            $user_module = explode(',',Auth::user()->active_module);
            $user_module = array_values(array_diff($user_module, array($name)));
            $user = User::find(Auth::user()->id);
            $user->active_module = implode(',',$user_module);
            $user->save();

              // first parameter workspace
              event(new CancelSubscription(creatorId(),getActiveWorkSpace(),$name));

            // Sidebar Performance Changes

            userActiveModule::where('user_id', Auth::user()->id)->where('module', $name)->delete();

            Cache::flush();
            return redirect()->back()->with('success', __('Successfully cancel subscription.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Something went wrong please try again .'));
        }
    }
}
