<?php

namespace Modules\hrm\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Hrm\Entities\ExperienceCertificate;
use Modules\Hrm\Entities\IpRestrict;
use Modules\Hrm\Entities\JoiningLetter;
use Modules\Hrm\Entities\NOC;


class ViewComposer extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */


    public function boot()
    {


        view()->composer(['settings*'], function ($view) {
            if(\Auth::check())
            {
                $currentParams = \Route::current()->parameters('noclangs');
                $active_module = explode(',', \Auth::user()->active_module);
                $dependency = explode(',', 'Hrm');
                if (!empty(array_intersect($dependency, $active_module))) {
                    if (request()->get('joininglangs')) {
                        $joininglang = request()->get('joininglangs');
                    } else {
                        $joininglang = "en";
                    }
                    if (request()->get('explangs')) {
                        $explang = request()->get('explangs');
                    } else {
                        $explang = "en";
                    }
                    if (request()->get('noclangs')) {
                        $noclang = request()->get('noclangs');
                    } else {
                        $noclang = "en";
                    }
                    if (module_is_active('Recruitment')) {
                        if (request()->get('offerlangs')) {
                            $offerlang = request()->get('offerlangs');
                        } else {
                            $offerlang = "en";
                        }
                        //offer letter
                        $Offerletter = \Modules\Recruitment\Entities\OfferLetter::all();
                        $currOfferletterLang = \Modules\Recruitment\Entities\OfferLetter::where('created_by', \Auth::user()->id)->where('lang', $offerlang)->where('workspace', getActiveWorkSpace())->first();
                    } else {
                        $offerlang = "en";
                        $Offerletter = '';
                        $currOfferletterLang = '';
                    }
                    //joining letter
                    $Joiningletter = JoiningLetter::all();
                    $currjoiningletterLang = JoiningLetter::where('created_by',  \Auth::user()->id)->where('lang', $joininglang)->where('workspace', getActiveWorkSpace())->first();

                    //Experience Certificate
                    $experience_certificate = ExperienceCertificate::all();
                    $curr_exp_cetificate_Lang = ExperienceCertificate::where('created_by',  \Auth::user()->id)->where('lang', $explang)->where('workspace', getActiveWorkSpace())->first();
                    //NOC
                    $noc_certificate = NOC::all();
                    $currnocLang = NOC::where('created_by',  \Auth::user()->id)->where('lang', $noclang)->where('workspace', getActiveWorkSpace())->first();
                    $ips = IpRestrict::where('created_by', \Auth::user()->id)->where('workspace', getActiveWorkSpace())->get();
                    $view->getFactory()->startPush('hrm_setting_sidebar', view('hrm::setting.sidebar'));
                    $view->getFactory()->startPush('hrm_setting_sidebar_div', view('hrm::setting.nav_containt_div', compact('joininglang', 'explang', 'noclang', 'Joiningletter', 'currjoiningletterLang', 'experience_certificate', 'curr_exp_cetificate_Lang', 'noc_certificate', 'currnocLang', 'offerlang', 'Offerletter', 'currOfferletterLang','ips')));
                }
            }
        });
    }
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
