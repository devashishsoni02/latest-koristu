<?php

namespace App\Http\Controllers;

use App\Models\AddOn;
use App\Models\Order;
use App\Models\Plan;
use App\Models\Sidebar;
use Illuminate\Support\Facades\Auth;
use Modules\LandingPage\Entities\MarketplacePageSetting;
use Nwidart\Modules\Facades\Module;


class HomeController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {
            return redirect('dashboard');
        }
        else
        {
            if(!file_exists(storage_path() . "/installed"))
            {
                header('location:install');
                die;
            }
            else
            {
                if(admin_setting('landing_page') == 'on')
                {
                    if(module_is_active('LandingPage'))
                    {
                        return view('landingpage::layouts.landingpage');
                    }
                    else
                    {
                        return view('marketplace.landing');
                    }
                }
                else
                {
                    return redirect('login');
                }
            }
        }
    }
    public function Dashboard()
    {
        if(Auth::check())
        {
            if(Auth::user()->type == 'super admin')
            {
                $user                       = \Auth::user();
                $user['total_user']         = $user->countCompany();
                $user['total_paid_user']    = $user->countPaidCompany();
                $user['total_orders']       = Order::total_orders();
                $user['total_orders_price'] = Order::total_orders_price();
                $chartData                  = $this->getOrderChart(['duration' => 'week']);

                return view('dashboard.dashboard', compact('user', 'chartData'));
            }
            else
            {
                $data = Sidebar::GetDashboardRoute();
                if($data['status'] == true && $data['route'] != 'dashboard')
                {
                    return redirect()->route($data['route']);
                }
                else
                {
                    return view('dashboard');
                }
            }
        }
        else
        {
            return redirect()->route('start');
        }
    }
    public function getOrderChart($arrParam)
    {
        $arrDuration = [];
        if($arrParam['duration'])
        {
            if($arrParam['duration'] == 'week')
            {
                $previous_week = strtotime("-2 week +1 day");
                for($i = 0; $i < 14; $i++)
                {
                    $arrDuration[date('Y-m-d', $previous_week)] = date('d-M', $previous_week);
                    $previous_week                              = strtotime(date('Y-m-d', $previous_week) . " +1 day");
                }
            }
        }
        $arrTask          = [];
        $arrTask['label'] = [];
        $arrTask['data']  = [];
        foreach($arrDuration as $date => $label)
        {
            $data               = Order::select(\DB::raw('count(*) as total'))->whereDate('created_at', '=', $date)->first();
            $arrTask['label'][] = $label;
            $arrTask['data'][]  = $data->total;
        }
        return $arrTask;
    }
    public function Software()
    {
        $modules = Module::getByStatus(1);

        if (module_is_active('LandingPage')) {
            $layout = 'landingpage::layouts.marketplace';
        } else {
            $layout = 'marketplace.marketplace';
        }

        return view('marketplace.software',compact('modules','layout'));
    }
    public function SoftwareDetails($slug)
    {
        $modules_all = Module::getByStatus(1);
        $modules = [];
        if(count($modules_all) > 0)
        {
            $modules = array_intersect_key(
                $modules_all,  // the array with all keys
                array_flip(array_rand($modules_all,(count($modules_all) <  6) ? count($modules_all) : 6 )) // keys to be extracted
            );
        }
        $plan = Plan::first();
        $addon = AddOn::where('name',$slug)->first();
        if(!empty($addon) && !empty($addon->module))
        {
            $module = Module::find($addon->module);
            if(!empty($module))
            {
                try {
                    if(module_is_active('LandingPage'))
                    {
                        return view('landingpage::marketplace.index',compact('modules','module','plan'));
                    }
                    else{
                        return view($module->getLowerName().'::marketplace.index',compact('modules','module','plan'));
                    }
                } catch (\Throwable $th) {

                }
            }
        }
        return view('marketplace.detail_not_found',compact('modules'));

    }
    public function Pricing()
    {
        if(Auth::check())
        {
            if(\Auth::user()->type == 'company')
            {
                return redirect('plans');
            }
            else
            {
                return redirect('dashboard');
            }
        }
        else
        {
            $plan = Plan::first();
            $modules = Module::getByStatus(1);

            if (module_is_active('LandingPage')) {
                $layout = 'landingpage::layouts.marketplace';
            } else {
                $layout = 'marketplace.marketplace';
            }

            return view('marketplace.pricing',compact('modules','plan','layout'));
        }
    }
}
