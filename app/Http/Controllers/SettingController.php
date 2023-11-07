<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Models\ApikeySetiings;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Nwidart\Modules\Facades\Module;
use Rawilk\Settings\Settings;
use Rawilk\Settings\Support\Context;
class SettingController extends Controller
{
    public function index(){
        if(Auth::user()->can('setting manage'))
        {
            $timezones = config('timezones');
            $file_type = config('files_types');
            $email_notification_modules = Notification::where('type','mail')->groupBy('module')->pluck('module');
            $email_notify = Notification::where('type','mail')->get();

            $ai_key_settings = ApikeySetiings::get();
            return view('settings.index',compact('timezones','file_type','email_notification_modules','email_notify','ai_key_settings'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function store(Request $request){
        if(Auth::user()->can('setting manage'))
        {
            $post = $request->all();
            unset($post['_token']);
            unset($post['_method']);

            if(!isset($post['landing_page'])){
                $post['landing_page'] = 'off';
            }
            if(!isset($post['site_rtl'])){
                $post['site_rtl'] = 'off';
            }
            if(!isset($post['signup'])){
                $post['signup'] = 'off';
            }
            if(!isset($post['email_verification'])){
                $post['email_verification'] = 'off';
            }
            if(!isset($post['site_transparent'])){
                $post['site_transparent'] = 'off';
            }
            if(!isset($post['cust_darklayout'])){
                $post['cust_darklayout'] = 'off';
            }


            if($request->hasFile('logo_dark'))
            {
                if(Auth::user()->type == 'super admin')
                {
                    $logo_dark = 'logo_dark.png';
                    $uplaod = upload_file($request,'logo_dark',$logo_dark,'logo');
                }

                $logo_dark =  'logo_dark_'.time().'.png';
                $uplaod = upload_file($request,'logo_dark',$logo_dark,'logo');
                if($uplaod['flag'] == 1)
                {
                    $post['logo_dark'] = $uplaod['url'];

                    $old_logo_dark = company_setting('logo_dark');
                    if(!empty($old_logo_dark) && check_file($old_logo_dark))
                    {
                        delete_file($old_logo_dark);
                    }
                }else{
                    return redirect()->back()->with('error',$uplaod['msg']);
                }
            }
            if($request->hasFile('logo_light'))
            {
                if(Auth::user()->type == 'super admin')
                {
                    $logo_light = 'logo_light.png';
                    $uplaod = upload_file($request,'logo_light',$logo_light,'logo');
                }
                $logo_light =  'logo_light_'.time().'.png';
                $uplaod = upload_file($request,'logo_light',$logo_light,'logo');
                if($uplaod['flag'] == 1)
                {
                    $post['logo_light'] = $uplaod['url'];

                    $old_logo_light = company_setting('logo_light');
                    if(!empty($old_logo_light) && check_file($old_logo_light))
                    {
                        delete_file($old_logo_light);
                    }
                }else{
                    return redirect()->back()->with('error',$uplaod['msg']);
                }
            }
            if($request->hasFile('favicon'))
            {
                if(Auth::user()->type == 'super admin')
                {
                    $favicon = 'favicon.png';
                    $uplaod = upload_file($request,'favicon',$favicon,'logo');
                }
                $favicon =  'favicon_'.time().'.png';
                $uplaod = upload_file($request,'favicon',$favicon,'logo');
                if($uplaod['flag'] == 1){
                    $post['favicon'] = $uplaod['url'];

                    $old_favicon = company_setting('favicon');
                    if(!empty($old_favicon) && check_file($old_favicon))
                    {
                        delete_file($old_favicon);
                    }
                }else{
                    return redirect()->back()->with('error',$uplaod['msg']);
                }
            }

            $userContext = new Context(['user_id' => \Auth::user()->id,'workspace_id'=>getActiveWorkSpace()]);
            foreach($post as $key =>  $p){
                \Settings::context($userContext)->set($key, $p);
            }
            return redirect()->back()->with('success', __('Setting save sucessfully.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function SystemStore(Request $request)
    {
        if(Auth::user()->can('setting manage'))
        {
            $post = $request->all();
            unset($post['_token']);
            unset($post['_method']);

            if(isset($post['defult_currancy']))
            {
                $data = explode('-',$post['defult_currancy']);
                $post['defult_currancy_symbol'] = $data[0];
                $post['defult_currancy']        = $data[1];
            }
            else
            {
                $post['defult_currancy']        = 'USD';
                $post['defult_currancy_symbol'] = '$';
            }
            if(isset($post['site_currency_symbol_position']))
            {
                $post['site_currency_symbol_position'] = !empty($request->site_currency_symbol_position) ? $request->site_currency_symbol_position : 'pre';
            }

            $userContext = new Context(['user_id' => \Auth::user()->id,'workspace_id'=>getActiveWorkSpace()]);
            foreach($post as $key =>  $p){
                \Settings::context($userContext)->set($key, $p);
            }
            return redirect()->back()->with('success','Setting save sucessfully.');
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function storageStore(Request $request)
    {
        if(Auth::user()->can('setting storage manage'))
        {
            if($request->storage_setting == 'wasabi')
            {
                $validator = \Validator::make(
                    $request->all(),[
                        'wasabi_key' => 'required',
                        'wasabi_secret' => 'required',
                        'wasabi_region' => 'required',
                        'wasabi_bucket' => 'required',
                        'wasabi_url' => 'required',
                        'wasabi_root' => 'required',
                        'wasabi_max_upload_size' => 'required',
                    ]
                );
            }
            elseif($request->storage_setting == 'wasabi')
            {
                $validator = \Validator::make(
                    $request->all(),[
                        's3_key' => 'required',
                        's3_secret' => 'required',
                        's3_region' => 'required',
                        's3_bucket' => 'required',
                        's3_url' => 'required',
                        's3_endpoint' => 'required',
                        's3_max_upload_size' => 'required',
                    ]
                );
            }
            else
            {
                $validator = \Validator::make(
                    $request->all(),[
                        'local_storage_max_upload_size' => 'required',
                        'local_storage_validation' => 'required',
                    ]
                );
            }

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error',$messages->first());
            }
                $post = $request->all();
                unset($post['_token']);
                $userContext = new Context(['user_id' => \Auth::user()->id,'workspace_id'=>getActiveWorkSpace()]);
                foreach($post as $key =>  $p){
                    \Settings::context($userContext)->set($key, $p);
                }
            return redirect()->back()->with('success','Storage Setting save sucessfully.');
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function testMail(Request $request)
    {
        $data                    = [];
        $data['mail_driver']     = $request->mail_driver;
        $data['mail_host']       = $request->mail_host;
        $data['mail_port']       = $request->mail_port;
        $data['mail_username']   = $request->mail_username;
        $data['mail_password']   = $request->mail_password;
        $data['mail_from_address']   = $request->mail_from_address;
        $data['mail_encryption'] = $request->mail_encryption;
        return view('settings.test_mail', compact('data'));
    }
    public function sendTestMail(Request $request)
    {
        $validator = \Validator::make(
            $request->all(), [
                               'email' => 'required|email',
                               'mail_driver' => 'required',
                               'mail_host' => 'required',
                               'mail_port' => 'required',
                               'mail_username' => 'required',
                               'mail_password' => 'required',
                               'mail_from_address' => 'required',
                           ]
        );
        if($validator->fails())
        {
            $messages = $validator->getMessageBag();

            return error_res($messages->first());
        }
        try
        {
            config(
                [
                    'mail.driver' => $request->mail_driver,
                    'mail.host' => $request->mail_host,
                    'mail.port' => $request->mail_port,
                    'mail.encryption' => $request->mail_encryption,
                    'mail.username' => $request->mail_username,
                    'mail.password' => $request->mail_password,
                    'mail.from.address' => $request->mail_from_address,
                    'mail.from.name' => config('name'),
                ]
            );

             Mail::to($request->email)->send(new TestMail());

            return success_res(__('Email send Successfully'));

        }
        catch(\Exception $e)
        {
            return error_res($e->getMessage());
        }
    }
    public function mailStore(Request $request)
    {
        $validator = \Validator::make(
            $request->all(),[
                'mail_driver' => 'required|string|max:255',
                'mail_host' => 'required|string|max:255',
                'mail_port' => 'required|string|max:255',
                'mail_username' => 'required|string|max:255',
                'mail_password' => 'required|string|max:255',
                'mail_encryption' => 'required|string|max:255',
                'mail_from_address' => 'required|string|max:255',
                'mail_from_name' => 'required|string|max:255',
            ]
        );
        if($validator->fails())
        {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error',$messages->first());
        }
        $userContext = new Context(['user_id' => \Auth::user()->id,'workspace_id'=>getActiveWorkSpace()]);
        $post = $request->all();
        unset($post['_token'],$post['_method'],$post['mail_noti']);
        foreach($post as $key =>  $p){
            \Settings::context($userContext)->set($key, $p);
        }
        return redirect()->back()->with('success','Mail Setting save sucessfully.');
    }
    public function MailNotificationStore(Request $request)
    {
        $userContext = new Context(['user_id' => \Auth::user()->id,'workspace_id'=>getActiveWorkSpace()]);

        // mail notification save
        if($request->has('mail_noti'))
        {
            foreach($request->mail_noti as $key => $notification)
            {
                \Settings::context($userContext)->set($key, $notification);
            }
        }
        return redirect()->back()->with('success','Mail Notification Setting save sucessfully.');
    }
    public function CompanySettingStore(Request $request)
    {
        $validator = \Validator::make($request->all(),
        [
            'company_name' => 'required',
            'company_address' => 'required',
            'company_city' => 'required',
            'company_state' => 'required',
            'company_zipcode' => 'required',
            'company_country' => 'required',
            'company_telephone' => 'required',
            'company_email' => 'required',
            'company_email_from_name' => 'required',
        ]);
        if($validator->fails()){
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }
        else
        {
            $userContext = new Context(['user_id' => \Auth::user()->id,'workspace_id'=>getActiveWorkSpace()]);
            \Settings::context($userContext)->set('company_name', !empty($request->company_name) ? $request->company_name : '');
            \Settings::context($userContext)->set('company_address', !empty($request->company_address) ? $request->company_address : '');
            \Settings::context($userContext)->set('company_city', !empty($request->company_city) ? $request->company_city : '');
            \Settings::context($userContext)->set('company_state', !empty($request->company_state) ? $request->company_state : '');
            \Settings::context($userContext)->set('company_zipcode', !empty($request->company_zipcode) ? $request->company_zipcode : '');
            \Settings::context($userContext)->set('company_country', !empty($request->company_country) ? $request->company_country : '');
            \Settings::context($userContext)->set('company_telephone', !empty($request->company_telephone) ? $request->company_telephone : '');
            \Settings::context($userContext)->set('company_email', !empty($request->company_email) ? $request->company_email : '');
            \Settings::context($userContext)->set('company_email_from_name', !empty($request->company_email_from_name) ? $request->company_email_from_name : '');
            \Settings::context($userContext)->set('registration_number', !empty($request->registration_number) ? $request->registration_number : '');
            if(isset($request->vat_gst_number_switch) && $request->vat_gst_number_switch == 'on')
            {
                \Settings::context($userContext)->set('vat_gst_number_switch','on');
                \Settings::context($userContext)->set('tax_type', !empty($request->tax_type) ? $request->tax_type : 'VAT');
                \Settings::context($userContext)->set('vat_number', !empty($request->vat_number) ? $request->vat_number : '');
            }
            else
            {
                \Settings::context($userContext)->set('vat_gst_number_switch','off');
                \Settings::context($userContext)->set('tax_type', '');
                \Settings::context($userContext)->set('vat_number', '');
            }

            return redirect()->back()->with('success','Company setting save sucessfully.');
        }

    }
    public function savePusherSettings(Request $request)
    {
        if(\Auth::user()->type == 'super admin')
        {
            $request->validate(
                [
                    'pusher_app_id' => 'required',
                    'pusher_app_key' => 'required',
                    'pusher_app_secret' => 'required',
                    'pusher_app_cluster' => 'required',
                ]
            );
            try
            {
                $userContext = new Context(['user_id' => \Auth::user()->id,'workspace_id'=>getActiveWorkSpace()]);
                \Settings::context($userContext)->set('PUSHER_APP_ID', $request->pusher_app_id);
                \Settings::context($userContext)->set('PUSHER_APP_KEY', $request->pusher_app_key);
                \Settings::context($userContext)->set('PUSHER_APP_SECRET', $request->pusher_app_secret);
                \Settings::context($userContext)->set('PUSHER_APP_CLUSTER', $request->pusher_app_cluster);
            }
            catch (\Exception $e)
            {
                return redirect()->back()->with('error', $e->getMessage());
            }
            return redirect()->back()->with('success', __('Pusher successfully updated.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }


    }
    public function SeoSetting(Request $request)
    {
        $validator = \Validator::make(
            $request->all(),
            [
                'meta_title' => 'required|string',
                'meta_keywords' => 'required|string',
                'meta_description' => 'required|string',
                'meta_image' => 'mimes:jpeg,jpg,png,gif',
            ]
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }

        if($request->hasFile('meta_image'))
        {
            $filenameWithExt = $request->file('meta_image')->getClientOriginalName();
            $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension       = $request->file('meta_image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            $uplaod = upload_file($request,'meta_image',$fileNameToStore,'meta');

            if($uplaod['flag'] == 1)
            {
                // old img delete
                if((!empty(admin_setting('meta_image'))) && strpos(admin_setting('meta_image'),'meta_image.png') == false && check_file(admin_setting('meta_image')))
                {
                    delete_file(admin_setting('meta_image'));
                }


            }else{
                return redirect()->back()->with('error',$uplaod['msg']);
            }
        }

        try
        {
            $userContext = new Context(['user_id' => \Auth::user()->id,'workspace_id'=>getActiveWorkSpace()]);

            \Settings::context($userContext)->set('meta_title', $request->meta_title);
            \Settings::context($userContext)->set('meta_keywords', $request->meta_keywords);
            \Settings::context($userContext)->set('meta_description', $request->meta_description);

            if ((isset($uplaod)) && ($uplaod['flag'] == 1) && (!empty($uplaod['url']))) {
                \Settings::context($userContext)->set('meta_image', $uplaod['url']);

            }
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', __('SEO setting successfully updated.'));
    }
    public function CookieSetting(Request $request)
    {
        if($request->has('enable_cookie'))
        {
            $validator = \Validator::make($request->all(), [
                'cookie_title' => 'required',
                'cookie_description' => 'required',
                'strictly_cookie_title' => 'required',
                'strictly_cookie_description' => 'required',
                'more_information_description' => 'required',
                'contactus_url' => 'required',
            ]);
            if($validator->fails()){
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
        }

        $userContext = new Context(['user_id' => \Auth::user()->id,'workspace_id'=>getActiveWorkSpace()]);
        if($request->has('enable_cookie'))
        {
            \Settings::context($userContext)->set('enable_cookie', $request->enable_cookie);
            \Settings::context($userContext)->set('cookie_logging', $request->cookie_logging);
            \Settings::context($userContext)->set('cookie_title', $request->cookie_title);
            \Settings::context($userContext)->set('cookie_description', $request->cookie_description);
            \Settings::context($userContext)->set('necessary_cookies', $request->necessary_cookies);
            \Settings::context($userContext)->set('strictly_cookie_title', $request->strictly_cookie_title);
            \Settings::context($userContext)->set('strictly_cookie_description', $request->strictly_cookie_description);
            \Settings::context($userContext)->set('more_information_description', $request->more_information_description);
            \Settings::context($userContext)->set('contactus_url', $request->contactus_url);
        }
        else
        {
            \Settings::context($userContext)->set('enable_cookie', 'off');
        }

        return redirect()->back()->with('success', 'Cookie setting save successfully.');
    }
    public function CookieConsent(Request $request)
    {
        if( admin_setting('enable_cookie') == "on" &&  admin_setting('cookie_logging') == "on")
        {
            try {

                $whichbrowser = new \WhichBrowser\Parser($_SERVER['HTTP_USER_AGENT']);
                // Generate new CSV line
                $browser_name = $whichbrowser->browser->name ?? null;
                $os_name = $whichbrowser->os->name ?? null;
                $browser_language = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? mb_substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) : null;
                $device_type = GetDeviceType($_SERVER['HTTP_USER_AGENT']);

                $ip = $_SERVER['REMOTE_ADDR'];

                $query = @unserialize(file_get_contents('http://ip-api.com/php/' . $ip));

                if($query['status'] == 'success')
                {
                    $date = (new \DateTime())->format('Y-m-d');
                    $time = (new \DateTime())->format('H:i:s').' UTC';


                    $new_line = implode(',', [$ip, $date, $time,implode('-',$request['cookie']), $device_type, $browser_language, $browser_name, $os_name, isset($query)?$query['country']:'',isset($query)?$query['region']:'',isset($query)?$query['regionName']:'',isset($query)?$query['city']:'',isset($query)?$query['zip']:'',isset($query)?$query['lat']:'',isset($query)?$query['lon']:'']);
                    if(!check_file('/uploads/sample/cookie_data.csv')) {
                        $first_line = 'IP,Date,Time,Accepted-cookies,Device type,Browser anguage,Browser name,OS Name,Country,Region,RegionName,City,Zipcode,Lat,Lon';
                        file_put_contents(base_path() . '/uploads/sample/cookie_data.csv', $first_line . PHP_EOL , FILE_APPEND | LOCK_EX);
                    }
                    file_put_contents(base_path() . '/uploads/sample/cookie_data.csv', $new_line . PHP_EOL , FILE_APPEND | LOCK_EX);
                }

            }
            catch (\Throwable $th)
            {
                return response()->json('error');
            }
            return response()->json('success');
        }
        return response()->json('error');
    }
    public function AiKeySettingSave(Request $request)
    {
        if(Auth::user()->can('api key setting create'))
        {
            $user = Auth::user();
            if ($user)
            {
                $key_arr=$request->api_key;
                foreach ($key_arr as  $data)
                {
                    if($data !='' && !empty($data))
                    {
                        $company_email_setting = ApikeySetiings::updateOrCreate(
                        [
                            'key' => $data,
                            'created_by' => creatorId()
                        ]
                        );
                    }
                }

                ApikeySetiings::whereNotIn('key',$key_arr)->delete();
                return redirect()->back()->with('success', __('Key Settings Save Successfully'));
            }

            else
            {
                return redirect()->back()->with('error', __('Something is wrong'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
