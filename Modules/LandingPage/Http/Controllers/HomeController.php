<?php

namespace Modules\LandingPage\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\LandingPage\Entities\LandingPageSetting;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if(\Auth::user()->can('landingpage manage')){

            $settings = LandingPageSetting::settings();
            return view('landingpage::landingpage.homesection', compact('settings'));
        }else{

            return redirect()->back()->with('error',__('Permission Denied!'));
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('landingpage::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        if( $request->home_banner){
            $home_banner = time()."-home_banner." . $request->home_banner->getClientOriginalExtension();
            $path = upload_file($request,'home_banner',$home_banner,'landing_page_image',[]);
            if($path['flag']==0){
                return redirect()->back()->with('error', __($path['msg']));
            }

            // old img delete
            if(!empty($data['home_banner']) && strpos($data['home_banner'],'avatar.png') == false && check_file($data['home_banner']))
            {
                delete_file($data['home_banner']);
            }

            $data['home_banner'] = $path['url'];
        }

        if($request->home_logo){
            $home_logo = time()."-home_logo." . $request->home_logo->getClientOriginalExtension();
            $path = upload_file($request,'home_logo',$home_logo,'landing_page_image',[]);
            if($path['flag']==0){
                return redirect()->back()->with('error', __($path['msg']));
            }

            // old img delete
            if(!empty($data['home_logo']) && strpos($data['home_logo'],'avatar.png') == false && check_file($data['home_logo']))
            {
                delete_file($data['home_logo']);
            }

            $data['home_logo'] = $path['url'];
        }

        $data['home_status']= 'on';
        $data['home_offer_text']= $request->home_offer_text;
        $data['home_title']= $request->home_title;
        $data['home_heading']= $request->home_heading;
        $data['home_description']= $request->home_description;
        $data['home_trusted_by']= $request->home_trusted_by;
        $data['home_live_demo_link']= $request->home_live_demo_link;
        $data['home_link_button_text']= $request->home_link_button_text;



        foreach($data as $key => $value){

            LandingPageSetting::updateOrCreate(['name' =>  $key],['value' => $value]);
        }

        return redirect()->back()->with(['success'=> 'Setting update successfully']);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('landingpage::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('landingpage::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
