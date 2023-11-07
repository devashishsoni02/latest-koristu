<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

class PlanModuleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $moduleName = null)
    {
        $redirectToRoute = null;
        if (! $request->user() ||
            ($request->user() instanceof MustVerifyEmail &&
            ! $request->user()->hasVerifiedEmail())) {
            return $request->expectsJson()
                    ? abort(403, 'Your email address is not verified.')
                    : Redirect::guest(URL::route($redirectToRoute ?: 'verification.notice'));
        }

        if (\Auth::user()->type != 'super admin')
        {
            if($moduleName != null)
            {
                $moduleName =  explode('-',$moduleName);
                $status = false;
                foreach($moduleName as $m)
                {
                    $status = module_is_active($m);
                    if($status == true)
                    {
                        break;
                    }
                }
                if($status == true)
                {
                    $active_module = ActivatedModule();
                    if(!empty(array_intersect($moduleName,$active_module)))
                    {
                        $response = $next($request);
                        return $response;
                    }
                }
                return redirect()->route('home')->with('error', __('Permission denied '));
            }
            else
            {
                return redirect()->route('home')->with('error', __('Permission denied'));
            }
        }
        $response = $next($request);
        return $response;
    }
}
