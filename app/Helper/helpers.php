<?php

use App\Models\AddOn;
use App\Models\Coupon;
use App\Models\Currency;
use App\Models\EmailTemplate;
use App\Models\EmailTemplateLang;
use App\Models\Language;
use App\Models\Order;
use App\Models\Plan;
use App\Models\Sidebar;
use App\Models\sidebarMenuDependency;
use App\Models\User;
use App\Models\UserCoupon;
use App\Models\userActiveModule;
use App\Models\WorkSpace;
use Carbon\Carbon;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Rawilk\Settings\Settings;
use Rawilk\Settings\Support\Context;
use Illuminate\Support\Facades\Validator;
use Nwidart\Modules\Facades\Module;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

if (! function_exists('get_permission_by_module')) {
    function get_permission_by_module($mudule){
        $user = \Auth::user();

        if($user->type == 'super admin')
            {
                $permissions = Spatie\Permission\Models\Permission::where('module',$mudule)->orderBy('name')->get();
            }
            else
            {
                $permissions = new Collection();
                foreach($user->roles as $role)
                {
                    $permissions = $permissions->merge($role->permissions);
                }
                $permissions = $permissions->where('module', $mudule);

            }
        // $permissions = Spatie\Permission\Models\Permission::where('module',$mudule)->orderBy('name')->get();
        return $permissions;
    }
}

if (! function_exists('languages')) {
    function languages(){
        // $dir     = base_path() . '/resources/lang/';
        // $glob    = glob($dir . "*", GLOB_ONLYDIR);
        // $arrLang = array_map(
        //     function ($value) use ($dir){
        //         return str_replace($dir, '', $value);
        //     }, $glob
        // );

        // $arrLang = array_map(
        //     function ($value) use ($dir){
        //         return preg_replace('/[0-9]+/', '', $value);
        //     }, $arrLang
        // );
        // $arrLang = array_filter($arrLang);

        // return $arrLang;
        try {
            $arrLang = Language::where('status',1)->get()->pluck('name','code')->toArray();
        } catch (\Throwable $th) {
            $arrLang=[
                "ar" => "Arabic",
                "da" => "Danish",
                "de" => "German",
                "en" => "English",
                "es" => "Spanish",
                "fr" => "French",
                "it" => "Italian",
                "ja" => "Japanese",
                "nl" => "Dutch",
                "pl" => "Polish",
                "pt" => "Portuguese",
                "ru" => "Russian",
                "tr" => "Turkish"
            ];
        }
        return $arrLang;
    }
}

if (! function_exists('get_module_img')) {
    function get_module_img($module){
        $url = url("/Modules/".$module.'/favicon.png');
        return $url;
    }
}

if (! function_exists('getPlanField')) {
    function getPlanField()
    {
        $field= new App\Models\PlanField();
        $columns = $field->getTableColumns();
        return $columns;
    }
}

if (! function_exists('getModuleList')) {
    function getModuleList(){
        $all = Nwidart\Modules\Facades\Module::getOrdered();
        $list = [];
        foreach($all as $module){
            array_push($list,$module->getName());
        }
        return $list;
    }
}
if (! function_exists('getshowModuleList')) {
    function getshowModuleList(){
        $all = Nwidart\Modules\Facades\Module::getOrdered();
        $list = [];
        foreach($all as $module){
            $path =$module->getPath().'/module.json';
            $json = json_decode(file_get_contents($path), true);
            if (!isset($json['display']) || $json['display'] == true)
            {
                array_push($list,$module->getName());
            }

        }
        return $list;
    }
}

if (! function_exists('getActiveLanguage')) {
    function getActiveLanguage(){
        if((\Auth::check()) && (!empty(\Auth::user()->lang))){
            return \Auth::user()->lang;
        }else{
            return !empty(admin_setting('defult_language')) ? admin_setting('defult_language') : 'en';
        }
    }
}

if (! function_exists('getWorkspace')) {
    function getWorkspace(){
        $data = [];
        if(\Auth::check())
        {
        //    if(\Auth::user()->type == 'company' || \Auth::user()->type == 'super admin')
        //    {
        //         return WorkSpace::where('created_by',\Auth::user()->id)->get();
        //    }
        //    else
        //    {
                $users = User::where('email',\Auth::user()->email)->get();
                $WorkSpace =  WorkSpace::whereIn('id',$users->pluck('workspace_id')->toArray())->orWhereIn('created_by',$users->pluck('id')->toArray())->where('is_disable',1)->get();
                return $WorkSpace;
        //    }
        }
        else
        {
            return $data;
        }
    }
}

if (! function_exists('getActiveWorkSpace')) {
    function getActiveWorkSpace($user_id= null){
        if(empty($user_id)){
            $user_id =  \Auth::user()->id;
        }
        $user = User::find($user_id);

        if($user)
        {
            if(!empty($user->active_workspace)){
                return $user->active_workspace;
            }else{
                if($user->type == 'super admin'){
                    return 0;
                }else{
                    $workspace = WorkSpace::where('created_by',$user->id)->first();
                    return $workspace->id;
                }
            }
        }
    }
}
// Sidebar Performance Changes

if (! function_exists('getSideMenu')) {
    function getSideMenu(){
        if(\Auth::check())
        {
            if(\Auth::user()->type == "super admin")
            {
                return $menus = Sidebar::with('childs')->where('parent_id', '=', 0)->where('type',"super admin")->where('is_visible',1)->orderBy('sort_order')->get();
            }
            else
            {
                return Cache::store('file')->rememberForever('cached_menu_auth' . \Auth::user()->id, function () {
                    $menus = Sidebar::select('sidebar.id', 'sidebar.parent_id', 'sidebar.module', 'sidebar.type', 'sidebar.is_visible', 'sidebar.route', 'sidebar.dependency', 'sidebar.disable_module','sidebar.permissions', 'sidebar.icon', 'sidebar.title')
                    ->with('childs')
                    ->leftJoin('user_active_modules', function($join) {
                        $join->on('sidebar.module', '=', 'user_active_modules.module')
                            ->where('user_active_modules.user_id', '=', creatorId());
                    })
                    ->leftJoin('sidebar_menu_disables', 'sidebar.id', '=', 'sidebar_menu_disables.sidebar_id')
                    ->where(function ($query) {
                        $query->where('sidebar.module', '=', 'Base')
                            ->orWhereNotNull('user_active_modules.module');
                    })
                    ->where('sidebar.parent_id', '=', 0)
                    ->whereNotIn('sidebar.type', ['super admin'])
                    ->whereNull('sidebar_menu_disables.module')
                    ->where('sidebar.is_visible', 1)
                    ->orderBy('sidebar.sort_order')
                    ->get();

                    $dependency = sidebarMenuDependency::whereIn('sidebar_id', $menus->pluck('id')->toArray())->pluck('module','sidebar_id')->toArray();
                    $active_modules = userActiveModule::where('user_id',creatorId())->pluck('module')->toArray();

                    foreach ($menus as $key => $menu) {
                        //dependency module
                        if (array_key_exists($menu->id,$dependency)) {
                            if(!in_array($dependency[$menu->id],$active_modules)){
                                unset($menus[$key]);
                            }
                        }
                    }
                    return $menus;
                });
            }
        }
        else
        {
            return [];
        }
    }
}

if (! function_exists('company_setting')) {
    function company_setting($key,$user_id= null,$workspace= null){
        if(empty($user_id)){
            $user_id =  \Auth::user()->id;
        }
        $user = User::find($user_id);

        if($user->type == 'super admin')
        {
            return admin_setting($key);
        }

        $workspace_id = $user->active_workspace;

        if(!in_array($user->type,['company','super admin'])){
            $workspace_id = $user->workspace_id;
            $user = User::find($user->created_by);
        }
        if(!empty($workspace)){
            $workspace_id = $workspace;
        }

        $userContext = new Context(['user_id' => $user->id,'workspace_id'=>$workspace_id]);
        $setting = settings()->context($userContext)->get($key);
        return $setting;
    }
}

if (! function_exists('admin_setting')) {
    function admin_setting($key){
        $user = User::where('type','super admin')->first();
        $userContext = new Context(['user_id' => $user->id,'workspace_id'=>getActiveWorkSpace($user->id)]);
        $setting = settings()->context($userContext)->get($key);
        return $setting;
    }
}


if (! function_exists('currency')) {
    function currency($code=null){
        if($code==null){
            $c = Currency::get();
        }else{
            $c = Currency::where('code',$code)->first();
        }
        return $c;
    }
}

if (! function_exists('company_datetime_formate')) {
    function company_datetime_formate($date){
        $date_formate = !empty(company_setting('site_date_format')) ? company_setting('site_date_format') : 'd-m-y';
        $time_formate = !empty(company_setting('site_time_format')) ? company_setting('site_time_format') : 'H:i';
        return date($date_formate.' '.$time_formate,strtotime($date));
    }
}

if (! function_exists('company_date_formate')) {
    function company_date_formate($date,$company_id = null,$workspace= null){
        if(!empty($company_id) && empty($workspace))
        {

            $date_formate = !empty(company_setting('site_date_format',$company_id)) ? company_setting('site_date_format',$company_id) : 'd-m-y';

        }
        elseif(!empty($company_id) && !empty($workspace))
        {
            $date_formate = !empty(company_setting('site_date_format',$company_id,$workspace)) ? company_setting('site_date_format',$company_id,$workspace) : 'd-m-y';
        }
        else{

            $date_formate = !empty(company_setting('site_date_format')) ? company_setting('site_date_format') : 'd-m-y';
        }
        return date($date_formate,strtotime($date));
    }
}
if (! function_exists('company_Time_formate')) {
    function company_Time_formate($time){
        $time_formate = !empty(company_setting('site_time_format')) ? company_setting('site_time_format') : 'H:i';
        return date($time_formate,strtotime($time));
    }
}

if(! function_exists('check_file')){
    function check_file($path){

        if(!empty($path)){
            if( admin_setting('storage_setting') == 'local' || admin_setting('storage_setting') == null){

                return file_exists(base_path($path));
            }else{

                if(admin_setting('storage_setting') == 's3')
                {
                    config(
                        [
                            'filesystems.disks.s3.key' => admin_setting('s3_key'),
                            'filesystems.disks.s3.secret' => admin_setting('s3_secret'),
                            'filesystems.disks.s3.region' => admin_setting('s3_region'),
                            'filesystems.disks.s3.bucket' => admin_setting('s3_bucket'),
                            'filesystems.disks.s3.url' => admin_setting('s3_url'),
                            'filesystems.disks.s3.endpoint' => admin_setting('s3_endpoint'),
                        ]
                    );
                }
                else if(admin_setting('storage_setting') == 'wasabi')
                {
                    config(
                        [
                            'filesystems.disks.wasabi.key' => admin_setting('wasabi_key'),
                            'filesystems.disks.wasabi.secret' => admin_setting('wasabi_secret'),
                            'filesystems.disks.wasabi.region' => admin_setting('wasabi_region'),
                            'filesystems.disks.wasabi.bucket' => admin_setting('wasabi_bucket'),
                            'filesystems.disks.wasabi.root' => admin_setting('wasabi_root'),
                            'filesystems.disks.wasabi.endpoint' => admin_setting('wasabi_url')
                        ]
                    );
                }
                try {
                    return  Storage::disk(admin_setting('storage_setting'))->exists($path);
                } catch (\Throwable $th) {
                    return 0;
                }
            }
        }else{
            return 0;
        }
    }
}
if(! function_exists('get_file')){
    function get_file($path){
        if(admin_setting('storage_setting') == 's3')
        {
            config(
                [
                    'filesystems.disks.s3.key' => admin_setting('s3_key'),
                    'filesystems.disks.s3.secret' => admin_setting('s3_secret'),
                    'filesystems.disks.s3.region' => admin_setting('s3_region'),
                    'filesystems.disks.s3.bucket' => admin_setting('s3_bucket'),
                    'filesystems.disks.s3.url' => admin_setting('s3_url'),
                    'filesystems.disks.s3.endpoint' => admin_setting('s3_endpoint'),
                ]
            );

            return Storage::disk('s3')->url($path);
        }
        else if(admin_setting('storage_setting') == 'wasabi')
        {
            config(
                [
                    'filesystems.disks.wasabi.key' => admin_setting('wasabi_key'),
                    'filesystems.disks.wasabi.secret' => admin_setting('wasabi_secret'),
                    'filesystems.disks.wasabi.region' => admin_setting('wasabi_region'),
                    'filesystems.disks.wasabi.bucket' => admin_setting('wasabi_bucket'),
                    'filesystems.disks.wasabi.root' => admin_setting('wasabi_root'),
                    'filesystems.disks.wasabi.endpoint' => admin_setting('wasabi_url')
                ]
            );
            return Storage::disk('wasabi')->url($path);
        }
        else
        {
            return asset($path);
        }
    }
}
if(! function_exists('get_base_file')){
    function get_base_file($path){
        if(admin_setting('storage_setting') == 's3')
        {
            config(
                [
                    'filesystems.disks.s3.key' => admin_setting('s3_key'),
                    'filesystems.disks.s3.secret' => admin_setting('s3_secret'),
                    'filesystems.disks.s3.region' => admin_setting('s3_region'),
                    'filesystems.disks.s3.bucket' => admin_setting('s3_bucket'),
                    'filesystems.disks.s3.url' => admin_setting('s3_url'),
                    'filesystems.disks.s3.endpoint' => admin_setting('s3_endpoint'),
                ]
            );

            return Storage::disk('s3')->url($path);
        }else if(admin_setting('storage_setting') == 'wasabi')
        {
            config(
                [
                    'filesystems.disks.wasabi.key' => admin_setting('wasabi_key'),
                    'filesystems.disks.wasabi.secret' => admin_setting('wasabi_secret'),
                    'filesystems.disks.wasabi.region' => admin_setting('wasabi_region'),
                    'filesystems.disks.wasabi.bucket' => admin_setting('wasabi_bucket'),
                    'filesystems.disks.wasabi.root' => admin_setting('wasabi_root'),
                    'filesystems.disks.wasabi.endpoint' => admin_setting('wasabi_url')
                ]
            );
            return Storage::disk('wasabi')->url($path);
        }else{
            return base_path($path);
        }
    }
}
if(! function_exists('upload_file')){
    function upload_file($request,$key_name,$name,$path,$custom_validation =[]){
        try{
            if(!empty(admin_setting('storage_setting'))){
                if(admin_setting('storage_setting') == 'wasabi'){
                    config(
                        [
                            'filesystems.disks.wasabi.key' => admin_setting('wasabi_key'),
                            'filesystems.disks.wasabi.secret' => admin_setting('wasabi_secret'),
                            'filesystems.disks.wasabi.region' => admin_setting('wasabi_region'),
                            'filesystems.disks.wasabi.bucket' => admin_setting('wasabi_bucket'),
                            'filesystems.disks.wasabi.root' => admin_setting('wasabi_root'),
                            'filesystems.disks.wasabi.endpoint' => admin_setting('wasabi_url')
                        ]
                    );
                    $max_size = !empty(admin_setting('wasabi_max_upload_size'))? admin_setting('wasabi_max_upload_size'):'2048';
                    $mimes =  !empty(admin_setting('wasabi_storage_validation'))? admin_setting('wasabi_storage_validation'):'jpeg,jpg,png,svg,zip,txt,gif,docx';

                }else if(admin_setting('storage_setting') == 's3'){
                    config(
                        [
                            'filesystems.disks.s3.key' => admin_setting('s3_key'),
                            'filesystems.disks.s3.secret' => admin_setting('s3_secret'),
                            'filesystems.disks.s3.region' => admin_setting('s3_region'),
                            'filesystems.disks.s3.bucket' => admin_setting('s3_bucket'),
                            'filesystems.disks.s3.url' => admin_setting('s3_url'),
                            'filesystems.disks.s3.endpoint' => admin_setting('s3_endpoint'),
                        ]
                    );
                    $max_size = !empty(admin_setting('s3_max_upload_size'))? admin_setting('s3_max_upload_size'):'2048';
                    $mimes =  !empty(admin_setting('s3_storage_validation'))? admin_setting('s3_storage_validation'):'jpeg,jpg,png,svg,zip,txt,gif,docx';

                }else{
                    $max_size = !empty(admin_setting('local_storage_max_upload_size'))? admin_setting('local_storage_max_upload_size'):'2048';
                    $mimes =  !empty(admin_setting('local_storage_validation'))? admin_setting('local_storage_validation'):'jpeg,jpg,png,svg,zip,txt,gif,docx';
                }
                $file = $request->$key_name;
                if(count($custom_validation) > 0){
                    $validation =$custom_validation;
                }else{
                    $validation =[
                        'mimes:'.implode(",",$mimes),
                        'max:'.$max_size,
                    ];
                }
                $validator = Validator::make($request->all(), [
                    $key_name =>$validation
                ]);
                if($validator->fails()){
                    $res = [
                        'flag' => 0,
                        'msg' => $validator->messages()->first(),
                    ];
                    return $res;
                } else {
                    $name = $name;
                    $save = Storage::disk(admin_setting('storage_setting'))->putFileAs(
                        $path,
                        $file,
                        $name
                    );
                    if(admin_setting('storage_setting') == 'wasabi'){
                        $url = $save;
                    }elseif(admin_setting('storage_setting') == 's3'){
                        $url = $save;

                    }else{
                        $url ='uploads/'.$save;
                    }
                    $res = [
                        'flag' => 1,
                        'msg'  =>'success',
                        'url'  => $url
                    ];
                    return $res;
                }

            }else{
                $res = [
                    'flag' => 0,
                    'msg' => 'not set configurations',
                ];
                return $res;
            }

        }
        catch(\Exception $e){
            $res = [
                'flag' => 0,
                'msg' => $e->getMessage(),
            ];
            return $res;
        }

    }
}

if(! function_exists('multi_upload_file')){
    function multi_upload_file($request,$key_name,$name,$path,$custom_validation =[]){
        try{
            if(!empty(admin_setting('storage_setting'))){
                if(admin_setting('storage_setting') == 'wasabi'){
                    config(
                        [
                            'filesystems.disks.wasabi.key' => admin_setting('wasabi_key'),
                            'filesystems.disks.wasabi.secret' => admin_setting('wasabi_secret'),
                            'filesystems.disks.wasabi.region' => admin_setting('wasabi_region'),
                            'filesystems.disks.wasabi.bucket' => admin_setting('wasabi_bucket'),
                            'filesystems.disks.wasabi.root' => admin_setting('wasabi_root'),
                            'filesystems.disks.wasabi.endpoint' => admin_setting('wasabi_url')
                        ]
                    );
                    $max_size = !empty(admin_setting('wasabi_max_upload_size'))? admin_setting('wasabi_max_upload_size'):'2048';
                    $mimes =  !empty(admin_setting('wasabi_storage_validation'))? admin_setting('wasabi_storage_validation'):'';

                }else if(admin_setting('storage_setting') == 's3'){
                    config(
                        [
                            'filesystems.disks.s3.key' => admin_setting('s3_key'),
                            'filesystems.disks.s3.secret' => admin_setting('s3_secret'),
                            'filesystems.disks.s3.region' => admin_setting('s3_region'),
                            'filesystems.disks.s3.bucket' => admin_setting('s3_bucket'),
                            'filesystems.disks.s3.url' => admin_setting('s3_url'),
                            'filesystems.disks.s3.endpoint' => admin_setting('s3_endpoint'),
                        ]
                    );
                    $max_size = !empty(admin_setting('s3_max_upload_size'))? admin_setting('s3_max_upload_size'):'2048';
                    $mimes =  !empty(admin_setting('s3_storage_validation'))? admin_setting('s3_storage_validation'):'';

                }else{
                    $max_size = !empty(admin_setting('local_storage_max_upload_size'))? admin_setting('local_storage_max_upload_size'):'2048';
                    $mimes =  !empty(admin_setting('local_storage_validation'))? admin_setting('local_storage_validation'):'';
                }

                $file = $request;
                $key_validation = $key_name.'*';
                if(count($custom_validation) > 0){
                    $validation =$custom_validation;
                }else{
                    $validation =[
                        'mimes:'.implode(",",$mimes),
                        'max:'.$max_size,
                    ];
                }
                $validator = Validator::make(array($key_name=> $request), [
                    $key_validation =>$validation
                ]);
                if($validator->fails()){
                    $res = [
                        'flag' => 0,
                        'msg' => $validator->messages()->first(),
                    ];
                    return $res;
                } else {

                    $name = $name;

                    $save = Storage::disk(admin_setting('storage_setting'))->putFileAs(
                        $path,
                        $file,
                        $name
                    );

                    if(admin_setting('storage_setting') == 'wasabi'){
                        $url = $save;
                    }elseif(admin_setting('storage_setting') == 's3'){
                        $url = $save;

                    }else{
                        $url ='uploads/'.$save;
                    }
                    $res = [
                        'flag' => 1,
                        'msg'  =>'success',
                        'url'  => $url
                    ];
                    return $res;
                }

            }else{
                $res = [
                    'flag' => 0,
                    'msg' => 'not set configration',
                ];
                return $res;
            }

        }
        catch(\Exception $e){
            $res = [
                'flag' => 0,
                'msg' => $e->getMessage(),
            ];
            return $res;
        }

    }
}
if(! function_exists('currency_format'))
{
    function currency_format($price){
        return number_format($price, company_setting('currency_format'), '.', '');
    }
}

if(! function_exists('currency_format_with_sym')){

    function currency_format_with_sym($price,$company_id = null,$workspace = null)
    {
        if(!empty($company_id) && empty($workspace))
        {
            return ( (empty(company_setting('site_currency_symbol_position',$company_id)) || company_setting('site_currency_symbol_position',$company_id) == "pre" )? company_setting('defult_currancy_symbol',$company_id) : '').number_format($price, company_setting('currency_format',$company_id)) . ((company_setting('site_currency_symbol_position',$company_id) == "post") ? company_setting('defult_currancy_symbol',$company_id) : '');
        }
        elseif(!empty($company_id) && !empty($workspace))
        {
            return ( (empty(company_setting('site_currency_symbol_position',$company_id,$workspace)) || company_setting('site_currency_symbol_position',$company_id,$workspace) == "pre" )? company_setting('defult_currancy_symbol',$company_id,$workspace) : '').number_format($price, company_setting('currency_format',$company_id,$workspace)) . ((company_setting('site_currency_symbol_position',$company_id,$workspace) == "post") ? company_setting('defult_currancy_symbol',$company_id,$workspace) : '');
        }
        else{
            return ( (empty(company_setting('site_currency_symbol_position')) || company_setting('site_currency_symbol_position') == "pre" )? company_setting('defult_currancy_symbol') : '').number_format($price, company_setting('currency_format')) . ((company_setting('site_currency_symbol_position') == "post") ? company_setting('defult_currancy_symbol') : '');
        }
    }
}
if(! function_exists('super_currency_format_with_sym')){
    function super_currency_format_with_sym($price,$setting = null)
    {
        return ( (empty( admin_setting('site_currency_symbol_position')) ||  admin_setting('site_currency_symbol_position') == "pre" )?  admin_setting('defult_currancy_symbol') : '').number_format($price,  admin_setting('currency_format')) . (( admin_setting('site_currency_symbol_position') == "post") ?  admin_setting('defult_currancy_symbol') : '');
    }
}

if(! function_exists('module_is_active')){
    function module_is_active($module,$user_id = null){
        if(Module::has($module)){
            $module = Module::find($module);
            if($module->isEnabled())
            {
                if(\Auth::check())
                {
                    $user = \Auth::user();
                }
                elseif($user_id != null)
                {
                    $user = User::find($user_id);
                }
                if(!empty($user))
                {
                    if($user->type == 'super admin')
                    {
                        return true;
                    }
                    else
                    {
                        $active_module = ActivatedModule($user_id);
                        if((count($active_module) > 0 && in_array($module->getName(),$active_module)))
                        {
                            return true;
                        }
                        return false;
                    }
                }
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }
}
if(! function_exists('ActivatedModule')){
    function ActivatedModule($user_id = null)
    {
        $data = [];
        $activated_module = user::$superadmin_activated_module;

        if($user_id != null)
        {
            $user = User::find($user_id);
        }
        elseif(\Auth::check())
        {
            $user = \Auth::user();
        }
        if(!empty($user))
        {
            if($user->type == 'super admin')
            {
                $data = array_keys(Module::getByStatus(1));
            }
            else
            {
                if($user->type != 'company')
                {
                    $user_not_com = User::find($user->created_by);
                    if(!empty($user))
                    {
                        // Sidebar Performance Changes
                        $active_module = userActiveModule::where('user_id', $user_not_com->id)->pluck('module')->toArray();

                    }
                }
                else
                {
                    // Sidebar Performance Changes
                    $active_module = userActiveModule::where('user_id', $user->id)->pluck('module')->toArray();
                }
                $active_module = array_merge($active_module,$activated_module);
                foreach ($active_module as $key => $value) {
                    $module = Module::find($value);
                    if($module)
                    {
                        if($module->isEnabled())
                        {
                            $data[] = $value;
                        }
                    }
                }
            }

        }
        return $data;
    }
}
if(! function_exists('sidebar_logo')){
    function sidebar_logo(){
        if(\Auth::check() && (\Auth::user()->type != 'super admin'))
        {
            if(company_setting('cust_darklayout') == 'on')
            {
                if(!empty(company_setting('logo_light')))
                {
                    if(check_file(company_setting('logo_light')))
                    {
                        return company_setting('logo_light');
                    }
                    else
                    {
                        return 'uploads/logo/logo_light.png';
                    }
                }else{
                    if(!empty(admin_setting('logo_light')))
                    {
                        if(check_file(admin_setting('logo_light')))
                        {
                            return admin_setting('logo_light');
                        }
                        else
                        {
                            return 'uploads/logo/logo_light.png';
                        }
                    }else{
                        return 'uploads/logo/logo_light.png';
                    }
                }
            }else{
                if(!empty(company_setting('logo_dark'))){
                    if(check_file(company_setting('logo_dark')))
                    {
                        return company_setting('logo_dark');
                    }
                    else
                    {
                        return 'uploads/logo/logo_dark.png';
                    }
                }else{
                    if(!empty(admin_setting('logo_dark'))){
                        if(check_file(admin_setting('logo_dark')))
                        {
                            return admin_setting('logo_dark');
                        }
                        else
                        {
                            return 'uploads/logo/logo_dark.png';
                        }
                    }else{
                        return 'uploads/logo/logo_dark.png';
                    }

                }
            }
        }
        else
        {
            if(admin_setting('cust_darklayout') == 'on')
            {
                if(!empty(admin_setting('logo_light')))
                {
                    if(check_file(admin_setting('logo_light')))
                    {
                        return admin_setting('logo_light');
                    }
                    else
                    {
                        return 'uploads/logo/logo_light.png';
                    }
                }else{
                    return 'uploads/logo/logo_light.png';
                }
            }
            else
            {
                if(!empty(admin_setting('logo_dark'))){
                    if(check_file(admin_setting('logo_dark')))
                    {
                        return admin_setting('logo_dark');
                    }
                    else
                    {
                        return 'uploads/logo/logo_dark.png';
                    }
                }else{
                    return 'uploads/logo/logo_dark.png';
                }
            }
        }
    }
}


if(! function_exists('dark_logo')){
    function dark_logo(){
        if(\Auth::check() && !empty(company_setting('logo_dark')))
        {
            if(check_file(company_setting('logo_dark')))
            {
                return company_setting('logo_dark');
            }
            else
            {
                return 'uploads/logo/logo_dark.png';
            }
        }else{
            if(!empty(admin_setting('logo_dark'))){
                if(check_file(admin_setting('logo_dark')))
                {
                    return admin_setting('logo_dark');
                }
                else
                {
                    return 'uploads/logo/logo_dark.png';
                }
            }else{
                return 'uploads/logo/logo_dark.png';
            }
        }
    }
}

if(! function_exists('light_logo'))
{
    function light_logo(){
        if(\Auth::check() && !empty(company_setting('logo_light'))){
            if(check_file(company_setting('logo_light')))
            {
                return company_setting('logo_light');
            }
            else
            {
                return 'uploads/logo/logo_light.png';
            }
        }else{
            if(!empty(admin_setting('logo_light'))){
                if(check_file(admin_setting('logo_light')))
                {
                    return admin_setting('logo_light');
                }
                else
                {
                    return 'uploads/logo/logo_light.png';
                }
            }else{
                return 'uploads/logo/logo_light.png';
            }
        }
    }
}

if(! function_exists('favicon')){
    function favicon(){
        if(\Auth::check())
        {
            if(!empty(company_setting('favicon')))
            {
                if(check_file(company_setting('favicon')))
                    {
                        return company_setting('favicon');
                    }
                    else
                    {
                        return 'uploads/logo/favicon.png';
                    }
                return company_setting('favicon');
            }else{
                if(!empty(admin_setting('favicon'))){
                    if(check_file(admin_setting('favicon')))
                    {
                        return admin_setting('favicon');
                    }
                    else
                    {
                        return 'uploads/logo/favicon.png';
                    }
                }else{
                    return 'uploads/logo/favicon.png';
                }
            }
        }
        else
        {
            if(!empty(admin_setting('favicon'))){
                if(check_file(admin_setting('favicon')))
                {
                    return admin_setting('favicon');
                }
                else
                {
                    return 'uploads/logo/favicon.png';
                }
            }else{
                return 'uploads/logo/favicon.png';
            }
        }
    }
}

if(! function_exists('creatorId')){
    function creatorId(){
        if(\Auth::user()->type == 'super admin' || Auth::user()->type == 'company'){
            return \Auth::user()->id;
        }else{
            return \Auth::user()->created_by;
        }
    }
}

if(! function_exists('error_res')){
     function error_res($msg = "", $args = array())
    {
        $msg       = $msg == "" ? "error" : $msg;
        $msg_id    = 'error.' . $msg;
        $converted = \Lang::get($msg_id, $args);
        $msg       = $msg_id == $converted ? $msg : $converted;
        $json      = array(
            'flag' => 0,
            'msg' => $msg,
        );

        return $json;
    }
}

if(! function_exists('success_res')){
     function success_res($msg = "", $args = array())
    {
        $msg       = $msg == "" ? "success" : $msg;
        $json      = array(
            'flag' => 1,
            'msg' => $msg,
        );

        return $json;
    }
}

if(! function_exists('check_permission')){
    function check_permission($permissions)
    {
        return \Auth::user()->can($permissions);
    }
}

function module_asset($module,$link){
    return asset('/Modules/'.$module.'/Resources/assets/'.$link);
}
if(! function_exists('second_to_time')){
    function second_to_time($seconds = 0)
    {
        $H = floor($seconds / 3600);
        $i = ($seconds / 60) % 60;
        $s = $seconds % 60;

        $time = sprintf("%02d:%02d:%02d", $H, $i, $s);

        return $time;
    }
}
if(! function_exists('diffance_to_time')){

    function diffance_to_time($start, $end)
    {
        $start         = new Carbon($start);
        $end           = new Carbon($end);
        $totalDuration = $start->diffInSeconds($end);

        return $totalDuration;
    }
}

if(! function_exists('delete_file'))
{
    function delete_file($path)
    {
        if(check_file($path))
        {
            if(admin_setting('storage_setting') == 'local')
            {
                return File::delete($path);
            }
            else
            {
                if(admin_setting('storage_setting') == 's3')
                {
                    config(
                        [
                            'filesystems.disks.s3.key' => admin_setting('s3_key'),
                            'filesystems.disks.s3.secret' => admin_setting('s3_secret'),
                            'filesystems.disks.s3.region' => admin_setting('s3_region'),
                            'filesystems.disks.s3.bucket' => admin_setting('s3_bucket'),
                            'filesystems.disks.s3.url' => admin_setting('s3_url'),
                            'filesystems.disks.s3.endpoint' => admin_setting('s3_endpoint'),
                        ]
                    );
                }
                else if(admin_setting('storage_setting') == 'wasabi')
                {
                    config(
                        [
                            'filesystems.disks.wasabi.key' => admin_setting('wasabi_key'),
                            'filesystems.disks.wasabi.secret' => admin_setting('wasabi_secret'),
                            'filesystems.disks.wasabi.region' => admin_setting('wasabi_region'),
                            'filesystems.disks.wasabi.bucket' => admin_setting('wasabi_bucket'),
                            'filesystems.disks.wasabi.root' => admin_setting('wasabi_root'),
                            'filesystems.disks.wasabi.endpoint' => admin_setting('wasabi_url')
                        ]
                    );
                }
                return Storage::disk(admin_setting('storage_setting'))->delete($path);
            }
        }
    }
}
if(! function_exists('delete_folder'))
{
    function delete_folder($path)
    {
        if(admin_setting('storage_setting') == 'local')
        {
            if(is_dir(Storage::path($path)))
            {
                return \File::deleteDirectory(Storage::path($path));
            }
        }
        else
        {
            if(admin_setting('storage_setting') == 's3')
            {
                config(
                    [
                        'filesystems.disks.s3.key' => admin_setting('s3_key'),
                        'filesystems.disks.s3.secret' => admin_setting('s3_secret'),
                        'filesystems.disks.s3.region' => admin_setting('s3_region'),
                        'filesystems.disks.s3.bucket' => admin_setting('s3_bucket'),
                        'filesystems.disks.s3.url' => admin_setting('s3_url'),
                        'filesystems.disks.s3.endpoint' => admin_setting('s3_endpoint'),
                    ]
                );
            }
            else if(admin_setting('storage_setting') == 'wasabi')
            {
                config(
                    [
                        'filesystems.disks.wasabi.key' => admin_setting('wasabi_key'),
                        'filesystems.disks.wasabi.secret' => admin_setting('wasabi_secret'),
                        'filesystems.disks.wasabi.region' => admin_setting('wasabi_region'),
                        'filesystems.disks.wasabi.bucket' => admin_setting('wasabi_bucket'),
                        'filesystems.disks.wasabi.root' => admin_setting('wasabi_root'),
                        'filesystems.disks.wasabi.endpoint' => admin_setting('wasabi_url')
                    ]
                );
            }

            return Storage::disk(admin_setting('storage_setting'))->deleteDirectory($path);
        }
    }
}
if(! function_exists('get_size'))
{
    function get_size($url){
        $url=str_replace(' ', '%20', $url);
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_NOBODY, TRUE);

        $data = curl_exec($ch);
        $size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);

        curl_close($ch);
        return $size;
    }
}
// setConfigEmail ( SMTP )
if(! function_exists('SetConfigEmail'))
{
    function SetConfigEmail($user_id = null ,$workspace_id = null)
    {
        try {

            if(!empty($user_id))
            {
                $user_id = User::where('id',$user_id)->first()->id;
            }
            else if(\Auth::user())
            {
                $user_id =  \Auth::user()->id;
            }
            else
            {
                $user_id = User::where('type','super admin')->first()->id;
            }
            if(!empty($user_id) && empty($workspace_id)){
                config(
                    [
                        'mail.driver' => company_setting('mail_driver',$user_id),
                        'mail.host' => company_setting('mail_host',$user_id),
                        'mail.port' => company_setting('mail_port',$user_id),
                        'mail.encryption' => company_setting('mail_encryption',$user_id),
                        'mail.username' => company_setting('mail_username',$user_id),
                        'mail.password' => company_setting('mail_password',$user_id),
                        'mail.from.address' => company_setting('mail_from_address',$user_id),
                        'mail.from.name' => company_setting('mail_from_name',$user_id),
                    ]
                );
            }elseif(!empty($user_id) && !empty($workspace_id)){
                config(
                    [
                        'mail.driver' => company_setting('mail_driver',$user_id,$workspace_id),
                        'mail.host' => company_setting('mail_host',$user_id,$workspace_id),
                        'mail.port' => company_setting('mail_port',$user_id,$workspace_id),
                        'mail.encryption' => company_setting('mail_encryption',$user_id,$workspace_id),
                        'mail.username' => company_setting('mail_username',$user_id,$workspace_id),
                        'mail.password' => company_setting('mail_password',$user_id,$workspace_id),
                        'mail.from.address' => company_setting('mail_from_address',$user_id,$workspace_id),
                        'mail.from.name' => company_setting('mail_from_name',$user_id,$workspace_id),
                    ]
                );
            }
            return true;

            } catch (\Exception $e) {

               return false;
            }
    }
}
// module alias name
if(! function_exists('Module_Alias_Name'))
{
    function Module_Alias_Name($module_name)
    {
        $addon = AddOn::where('module',$module_name)->first();
        $module = Module::find($module_name);
        if(!empty($addon))
        {
           $module_name =  !empty($addon->name) ? $addon->name : ( !empty($module->getAlias()) ? $module->getAlias() : $module_name );
        }
        elseif(!empty($module))
        {
            $module_name = $module->getAlias();
        }
        return $module_name;
    }
}
// module price name
if(! function_exists('ModulePriceByName'))
{
    function ModulePriceByName($module_name)
    {
        $addon = AddOn::where('module',$module_name)->first();
        $module = Module::find($module_name);
        $data = [];
        $data['monthly_price'] = 0;
        $data['yearly_price'] = 0;

        if(!empty($module))
        {
            $path = $module->getPath() . '/module.json';
            $json = json_decode(file_get_contents($path), true);

            $data['monthly_price'] = (isset($json['monthly_price']) && !empty($json['monthly_price'])) ? $json['monthly_price'] : 0;
            $data['yearly_price'] = (isset($json['yearly_price']) && !empty($json['yearly_price'])) ? $json['yearly_price'] : 0;
        }

        if(!empty($addon))
        {
            $data['monthly_price'] = ($addon->monthly_price != null) ? $addon->monthly_price : $data['monthly_price'];
            $data['yearly_price'] = ($addon->yearly_price != null) ? $addon->yearly_price : $data['yearly_price'];
        }

        return $data;
    }
}

// Company Subscription Details
if(! function_exists('SubscriptionDetails'))
{
    function SubscriptionDetails($user_id = null)
    {
        $data = [];
        $data['status'] = false;
        if($user_id != null)
        {
            $user = User::find($user_id);

        }
        elseif(\Auth::check())
        {
            $user = \Auth::user();
        }

        if(isset($user) && !empty($user))
        {
            if($user->type != 'company' && $user->type != 'super admin')
            {
                $user = User::find($user->created_by);
            }

            if(!empty($user))
            {
                if($user->active_plan != 0)
                {
                    $data['status'] = true;
                    $data['active_plan'] = $user->active_plan;
                    $data['billing_type'] = $user->billing_type;
                    $data['plan_expire_date'] = $user->plan_expire_date;
                    $data['active_module'] = ActivatedModule();
                    $data['total_user'] = $user->total_user == -1 ? 'Unlimited': (!empty($user->total_user) ? $user->total_user : 'Unlimited');
                    $data['total_workspace'] = $user->total_workspace == -1 ? 'Unlimited': (!empty($user->total_workspace) ? $user->total_workspace : 'Unlimited');
                    $data['seeder_run'] = $user->seeder_run;
                }
            }
        }
        return $data;
    }
}


// invoice template Data

if(! function_exists('templateData'))
{
    function templateData()
    {
        $arr              = [];
        $arr['colors']    = [
            '003580',
            '666666',
            '6676ef',
            'f50102',
            'f9b034',
            'fbdd03',
            'c1d82f',
            '37a4e4',
            '8a7966',
            '6a737b',
            '050f2c',
            '0e3666',
            '3baeff',
            '3368e6',
            'b84592',
            'f64f81',
            'f66c5f',
            'fac168',
            '46de98',
            '40c7d0',
            'be0028',
            '2f9f45',
            '371676',
            '52325d',
            '511378',
            '0f3866',
            '48c0b6',
            '297cc0',
            'ffffff',
            '000',
        ];
        $arr['templates'] = [
            "template1" => "New York",
            "template2" => "Toronto",
            "template3" => "Rio",
            "template4" => "London",
            "template5" => "Istanbul",
            "template6" => "Mumbai",
            "template7" => "Hong Kong",
            "template8" => "Tokyo",
            "template9" => "Sydney",
            "template10" => "Paris",
        ];
        return $arr;
    }
}

// if Subscription price is 0 then call this
if(! function_exists('DirectAssignPlan'))
{
    function DirectAssignPlan($plan_id,$duration,$user_module,$counter,$type,$user_id = null)
    {
        $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
        $plan =Plan::find($plan_id);
        if(empty($user_id))
        {
            $user_id = \Auth::user()->id;
        }
        $user = User::find($user_id);
        $assignPlan = $user->assignPlan($plan->id,$duration,$user_module,$counter,$user_id);
        if ($assignPlan['is_success']) {
            Order::create(
                [
                    'order_id' => $orderID,
                    'name' => null,
                    'email' => null,
                    'card_number' => null,
                    'card_exp_month' => null,
                    'card_exp_year' => null,
                    'plan_name' => !empty($plan->name) ? $plan->name :'Basic Package',
                    'plan_id' => $plan->id,
                    'price' => 0,
                    'price_currency' => admin_setting('defult_currancy'),
                    'txn_id' => '',
                    'payment_type' =>!empty($type)?$type:"STRIPE",
                    'payment_status' => 'succeeded',
                    'receipt' => null,
                    'user_id' => $user_id,
                ]
            );
            return ['is_success' => true];
        }
        else
        {
            return ['is_success' => false];
        }
    }
}

if(! function_exists('AnnualLeaveCycle'))
{
    function AnnualLeaveCycle()
    {
        $start_date = ''.date('Y').'-01-01';
        $end_date = ''.date('Y').'-12-31';
        $start_date = date('Y-m-d', strtotime($start_date . ' -1 day'));
        $end_date = date('Y-m-d', strtotime($end_date . ' +1 day'));

        $date['start_date'] = $start_date;
        $date['end_date']   = $end_date;

        return $date;

    }
}

// Get Cache Size
if(! function_exists('CacheSize'))
{
    function CacheSize()
    {
        //start for cache clear
        $file_size = 0;
        foreach (\File::allFiles(storage_path('/framework')) as $file) {
            $file_size += $file->getSize();
        }
        $file_size = number_format($file_size / 1000000, 4);

        return $file_size;
    }
}
if(! function_exists('GetDeviceType'))
{
    function GetDeviceType($user_agent)
    {
        $mobile_regex = '/(?:phone|windows\s+phone|ipod|blackberry|(?:android|bb\d+|meego|silk|googlebot) .+? mobile|palm|windows\s+ce|opera mini|avantgo|mobilesafari|docomo)/i';
        $tablet_regex = '/(?:ipad|playbook|(?:android|bb\d+|meego|silk)(?! .+? mobile))/i';
        if(preg_match_all($mobile_regex, $user_agent))
        {
            return 'mobile';
        }
        else
        {
            if(preg_match_all($tablet_regex, $user_agent)) {
                return 'tablet';
            } else {
                return 'desktop';
            }

        }
    }
}

if (!function_exists('PlanCheck')) {
    function PlanCheck($type = 'User', $id = null)
    {
        if (!empty($id)) {
            $user = User::where('id', $id)->first();
            if ($user->type == 'company') {
                $id = $user->id;
            } else {
                $user = User::where('id', $user->created_by)->first();
                $id = $user->id;
            }
        } else {
            $user = \Auth::user();
            if ($user->type == 'company') {
                $id = $user->id;
            } else {
                $user = User::where('id', $user->created_by)->first();
                $id = $user->id;
            }
        }
        if ($type == "User") {
            if ($user->total_user >= 0) {
                if ($user->type == 'company') {
                    $users = User::where('created_by', $id)->where('workspace_id', getActiveWorkSpace())->get();
                } else {
                    $users = User::where('created_by', $user->created_by)->get();
                }
                if ($users->count() >= $user->total_user) {
                    return false;
                } else {
                    return true;
                }
            } elseif ($user->total_user < 0) {
                return true;
            }
        }
        if ($type == "Workspace") {
            if ($user->total_workspace >= 0) {
                $workspace = WorkSpace::where('created_by', $id)->get();

                if ($workspace->count() >= $user->total_workspace) {
                    return false;
                } else {
                    return true;
                }
            } elseif ($user->total_workspace < 0) {
                return true;
            }
        }
    }
}

if (!function_exists('CheckCoupon'))
{
    function CheckCoupon($code,$price = 0 )
    {
        if(!empty($code) && intval($price) > 0)
        {
            $coupons = Coupon::where('code', strtoupper($code))->where('is_active', '1')->first();
            if(!empty($coupons))
            {
                $usedCoupun     = $coupons->used_coupon();
                $discount_value = ($price / 100) * $coupons->discount;
                $final_price          = $price - $discount_value;

                if($coupons->limit == $usedCoupun)
                {
                    return $price;
                }else{
                    return $final_price;
                }
            }
            else
            {
                return $price;
            }
        }
    }
}

if (!function_exists('UserCoupon'))
{
    function UserCoupon($code,$orderID,$user_id = null)
    {
        if(!empty($code))
        {
            $coupons = Coupon::where('code', strtoupper($code))->where('is_active', '1')->first();
            if($user_id)
            {
                $user = User::find($user_id);
            }
            else
            {
                $user = \Auth::user();
            }
            if(!empty($coupons))
            {
                $userCoupon         = new UserCoupon();
                $userCoupon->user   = $user->id;
                $userCoupon->coupon = $coupons->id;
                $userCoupon->order  = $orderID;
                $userCoupon->save();

                $usedCoupun = $coupons->used_coupon();
                if($coupons->limit <= $usedCoupun)
                {
                    $coupons->is_active = 0;
                    $coupons->save();
                }
            }
        }
    }
}

if (!function_exists('makeEmailLang'))
{
    function makeEmailLang($lang)
    {
        $templates = EmailTemplate::all();
        foreach ($templates as $template) {

            $default_lang  = EmailTemplateLang::where('parent_id', '=', $template->id)->where('lang', 'LIKE', 'en')->first();

            $emailTemplateLang              = new EmailTemplateLang();
            $emailTemplateLang->parent_id   = $template->id;
            $emailTemplateLang->lang        = $lang;
            $emailTemplateLang->subject     = $default_lang->subject;
            $emailTemplateLang->content     = $default_lang->content;
            $emailTemplateLang->variables   = $default_lang->variables;
            $emailTemplateLang->save();
        }
    }
}

if (!function_exists('delete_directory'))
{
    function delete_directory($dir)
    {
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (!delete_directory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }

        return rmdir($dir);
    }
}
