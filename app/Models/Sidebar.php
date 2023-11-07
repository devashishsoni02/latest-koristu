<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\sidebarMenuDependency;
use App\Models\userActiveModule;

class Sidebar extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'icon',
        'parent_id',
        'sort_order',
        'route',
        'is_visible',
        'permissions',
        'module',
        'dependency',
        'disable_module',
        'type'
    ];
    protected $table ="sidebar";

    // Sidebar Performance Changes
    public function childs() {

        if(Auth::user()->type == 'super admin')
        {
            $menuModules =ActivatedModule();

            array_push($menuModules,"Base");
        }
        else
        {
            $userActiveModule = userActiveModule::whereIn('module', $this->menus()->pluck('module'))
            ->where('user_id', creatorId())
            ->get();
            $menuModules = $userActiveModule->pluck('module')->push('Base');
        }

        $return = $this->hasMany('App\Models\Sidebar', 'parent_id', 'id')
                ->whereIn('module', $menuModules)
                ->where('is_visible', 1)
                ->orderBy('sort_order')
                ->whereNotIn('id', function ($query) use ($menuModules) {
                    $query->select('sidebar_id')
                        ->from('sidebar_menu_disables')
                        ->whereIn('sidebar_id', function ($subquery) use ($menuModules) {
                            $subquery->select('id')
                                ->from('sidebar')
                                ->whereIn('module', $menuModules);
                        });
                });

        $dependency = sidebarMenuDependency::whereIn('sidebar_id', $return->pluck('id')->toArray())->pluck('module','sidebar_id')->toArray();
        $active_modules = userActiveModule::where('user_id',creatorId())->pluck('module')->toArray();

        foreach ($return as $key => $menu) {
            //dependency module
            if (array_key_exists($menu->id,$dependency)) {
                if(!in_array($dependency[$menu->id],$active_modules)){
                    unset($return[$key]);
                }
            }
        }
        return $return;
    }
    public function menus()
    {
        return $this->hasMany('App\Models\Sidebar', 'parent_id', 'id');
    }


    public static function GetDashboardRoute()
    {
        $data = [];
        $data['status'] = false;
        $data['route'] = '';
        if(\Auth::user()->type == 'super admin')
        {
            $data['status'] = true;
            $data['route'] = 'dashboard';
        }
        else
        {
            $active_module = ActivatedModule();

            $dashboard = Sidebar::where('title','Dashboard')->where('parent_id',0)->where('type','company')->first();
            if(!empty($dashboard))
            {
                $sidebars = Sidebar::where('parent_id',$dashboard->id)->where('is_visible',1)->whereIn('module',$active_module)->whereNotNull('route')->orderBy('sort_order')->get();
                if(count($sidebars) > 0 && Auth::user()->canany(array_column($sidebars->toArray(), 'permissions')))
                {
                    foreach ($sidebars as $key => $sidebar)
                    {
                        if(module_is_active($sidebar->module))
                        {
                            if(Auth::user()->can($sidebar->permissions))
                            {
                                if(!empty($sidebar->route))
                                {
                                    $data['status'] = true;
                                    $data['route'] = $sidebar->route;
                                    return $data;
                                }
                            }
                        }
                    }
                }
                else
                {
                    $data['status'] = true;
                    $data['route'] = 'dashboard';
                }
            }
            else
            {
                $data['status'] = true;
                $data['route'] = 'dashboard';
            }
        }
        return $data;
    }
}
