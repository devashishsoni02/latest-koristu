<?php

namespace App\Models;

use App\Events\DefaultData;
use App\Events\GivePermissionToRole;
use Carbon\Carbon;
use App\Models\WorkSpace;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Rawilk\Settings\Support\Context;
use Lab404\Impersonate\Models\Impersonate;
use Laravel\Paddle\Billable;


class User extends Authenticatable implements JWTSubject,MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles,Impersonate, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile_no',
        'email_verified_at',
        'password',
        'remember_token',
        'type',
        'active_status',
        'active_workspace',
        'avatar',
        'dark_mode',
        'requested_plan',
        'messenger_color',
        'active_plan',
        'billing_type',
        'active_module',
        'plan_expire_date',
        'total_user',
        'total_workspace',
        'seeder_run',
        'workspace_id',
        'created_by',
        'lang',
        'is_enable_login',
        'is_disable',
        'trial_expire_date',
        'is_trial_done',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public static $superadmin_activated_module = [
        'ProductService',
    ];
    public static $not_edit_role = [
        'super admin',
        'company',
        'client',
        'vendor',
        'staff',
        'driver'
    ];

    public  $not_emp_type = [
        'super admin',
        'company',
        'client',
        'vendor',
        'driver'
    ];
    public $client_type = [
        'client',
    ];
    public $not_all_user = [
        'super admin',
        'company',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function plan()
    {
        return  $this->hasOne(Plan::class,'id','active_plan');
    }

    public function scopeEmp($query)
    {
        return $query->whereNotIn('type', $this->not_emp_type);
    }
    public function scopeUsers($query)
    {
        return $query->whereNotIn('type', $this->not_emp_type);
    }
    public function scopeAllusers($query)
    {
        return $query->whereNotIn('type', $this->not_all_user);
    }
    public function scopeClients($query)
    {
        return $query->whereIn('type', $this->client_type);
    }

    public function assignPlan($plan_id = null,$duration = null,$modules = null,$counter = null,$user_id = null)
    {
        if($user_id != null)
        {
            $user = User::find($user_id);
        }
        else
        {
            $user =  User::find(Auth::user()->id);
        }
        if($plan_id != null){

            $plan = Plan::find($plan_id);
        }else
        {
            $plan = Plan::where('is_free_plan',1)->first();
        }
        $oldplan= Plan::where('id',$user->active_plan)->first();
        if($plan)
        {

            $user->active_plan = $plan->id;

            if(!empty($duration))
            {
                if($duration == 'Month')
                {
                    $user->plan_expire_date = Carbon::now()->addMonths(1)->isoFormat('YYYY-MM-DD');
                }
                elseif($duration == 'Year')
                {
                    $user->plan_expire_date = Carbon::now()->addYears(1)->isoFormat('YYYY-MM-DD');
                }
                elseif($duration == 'Trial')
                {
                    $user->trial_expire_date =  Carbon::now()->addDays($plan->trial_days)->isoFormat('YYYY-MM-DD');
                    if($user->plan_expire_date)
                    {
                        $user->plan_expire_date = null;
                    }
                }
                else{
                    $user->plan_expire_date = null;
                }
            }else
            {
                $user->plan_expire_date = null;
                // for days
                // $this->plan_expire_date = Carbon::now()->addDays($duration)->isoFormat('YYYY-MM-DD');
            }
            if(!empty($modules))
            {
                $modules_array = explode(',',$modules);
                if(!empty($user->active_module) && (!empty($oldplan->custom_plan) == 1) && (!empty($plan->custom_plan )==1))
                {
                    $user_module = explode(',',$user->active_module);
                    foreach ($modules_array as $module) {
                        if(!in_array($module,$user_module)){
                            array_push($user_module,$module);
                        }
                    }
                }
                else
                {
                    $user_module = $modules_array;
                }
                if(!in_array('ProductService',$user_module)){

                    array_push($user_module,"ProductService");
                }

                // Sidebar Performance Changes
                $currentActiveModules = userActiveModule::where('user_id', $user->id)->pluck('module')->toArray();
                $newModules = array_diff($user_module, $currentActiveModules);
                $modulesToRemove = array_diff($currentActiveModules, $user_module);

                foreach ($newModules as $moduleName) {
                    userActiveModule::create([
                        'user_id' => $user->id,
                        'module' => $moduleName,
                    ]);
                }

                foreach ($modulesToRemove as $moduleName) {
                    userActiveModule::where('user_id', $user->id)->where('module', $moduleName)->delete();
                }

                $user->active_module = implode(',',$user_module);

                event(new DefaultData($user->id,null,$modules));

                $client_role = Role::where('name','client')->where('created_by',$user->id)->first();
                $staff_role = Role::where('name','staff')->where('created_by',$user->id)->first();
                $vendor_role = Role::where('name','vendor')->where('created_by',$user->id)->first();

                if(!empty($client_role))
                {
                    event(new GivePermissionToRole($client_role->id,'client',$modules));
                }
                if(!empty($staff_role))
                {
                    event(new GivePermissionToRole($staff_role->id,'staff',$modules));
                }
                if(!empty($vendor_role))
                {
                    event(new GivePermissionToRole($vendor_role->id,'vendor',$modules));
                }
            }

            if($counter != null && !empty($oldplan->custom_plan) == 1 && !empty($plan->custom_plan )==1)
            {
                $plan->number_of_workspace = ($user->total_workspace == -1) ? $counter['workspace_counter'] : $counter['workspace_counter'] + $user->total_workspace;
                $plan->number_of_user = ($user->total_user == -1) ? $counter['user_counter'] : $counter['user_counter'] + $user->total_user;
            }
            elseif($counter != null && $plan->custom_plan == 1)
            {

                $plan->number_of_workspace = $counter['workspace_counter'];
                $plan->number_of_user = $counter['user_counter'];
            }
            //For Workspace enable/disable
            $plan->number_of_workspace = !empty($plan->number_of_workspace) ? $plan->number_of_workspace : -1 ;
            $workspace = Workspace::where('created_by',$user->id)->where('is_disable',1)->get();
            $total= $workspace->count();
            if($plan->number_of_workspace > 0)
            {
                if($total > $plan->number_of_workspace)
                {
                    $count = $total - $plan->number_of_workspace;
                    $WspToDisable = Workspace::orderBy('created_at', 'desc')->where('created_by',$user->id)->where('is_disable',1)->take($count)->get();
                    foreach($WspToDisable as $item){
                        $item->is_disable = 0;
                        $item->save();
                        if($user->active_workspace == $item->id){
                            $switchwsp = Workspace::where('created_by',$user->id)->where('is_disable',1)->first();
                            $user->active_workspace = $switchwsp->id;
                        }
                        $users = User::where('workspace_id',$item->id)->get();
                        foreach($users as $item){
                            $item->is_disable = 0;
                            $item->save();
                        }
                        $WspActive = Workspace::where('created_by',$user->id)->where('id','!=',$item)->get();
                        foreach($WspActive as $active)
                        {
                            $this->Usercount($active->id,$plan);
                        }
                    }
                }else
                {
                    foreach($workspace as $item){
                        $this->Usercount($item->id,$plan);
                    }
                    $count =  $plan->number_of_workspace - $total;
                    $workspaces = Workspace::where('created_by',$user->id)->where('is_disable',0)->take($count)->get();
                    foreach($workspaces as $item)
                    {
                            $item->is_disable = 1;
                            $this->Usercount($item->id,$plan);
                            $item->save();
                    }
                }

            }elseif($plan->number_of_workspace == -1)
            {
                $workspace = Workspace::where('created_by',$user->id)->get();
                foreach($workspace as $item)
                    {
                        $item->is_disable = 1;
                        $item->save();
                        $this->Usercount($item->id,$plan);
                    }
            }
            $user->total_user = $plan->number_of_user;
            $user->total_workspace = $plan->number_of_workspace;
            $user->save();

            // Sidebar Performance Changes
            Cache::forget('cached_menu_auth'.$user->id);
            return ['is_success' => true];
        }
        else
        {
            return [
                'is_success' => false,
                'error' => 'Plan is deleted.',
            ];
        }
    }
      // get font-color code accourding to bg-color
      public static function hex2rgb($hex)
      {
          $hex = str_replace("#", "", $hex);

          if(strlen($hex) == 3)
          {
              $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
              $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
              $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
          }
          else
          {
              $r = hexdec(substr($hex, 0, 2));
              $g = hexdec(substr($hex, 2, 2));
              $b = hexdec(substr($hex, 4, 2));
          }
          $rgb = array(
              $r,
              $g,
              $b,
          );

          //return implode(",", $rgb); // returns the rgb values separated by commas
          return $rgb; // returns an array with the rgb values
      }

      public static function getFontColor($color_code)
      {
          $rgb = self::hex2rgb($color_code);
          $R   = $G = $B = $C = $L = $color = '';

          $R = (floor($rgb[0]));
          $G = (floor($rgb[1]));
          $B = (floor($rgb[2]));

          $C = [
              $R / 255,
              $G / 255,
              $B / 255,
          ];

          for($i = 0; $i < count($C); ++$i)
          {
              if($C[$i] <= 0.03928)
              {
                  $C[$i] = $C[$i] / 12.92;
              }
              else
              {
                  $C[$i] = pow(($C[$i] + 0.055) / 1.055, 2.4);
              }
          }

          $L = 0.2126 * $C[0] + 0.7152 * $C[1] + 0.0722 * $C[2];

          if($L > 0.179)
          {
              $color = 'black';
          }
          else
          {
              $color = 'white';
          }

          return $color;
      }

    public function MakeRole()
    {
        $data = [];
        $staff_role_permission = [
            'user chat manage',
            'user profile manage',
            'user logs history',

        ];
        $client_role_permission = [
            'user chat manage',
            'user profile manage',
            'user logs history',
            'invoice manage',
            'invoice show',
            'proposal manage',
            'proposal show',

        ];
        $client_role = Role::where('name','client')->where('created_by',$this->id)->where('guard_name','web')->first();
        if(empty($client_role))
        {
            $client_role                   = new Role();
            $client_role->name             = 'client';
            $client_role->guard_name       = 'web';
            $client_role->module           = 'Base';
            $client_role->created_by       = $this->id;
            $client_role->save();

            foreach($client_role_permission as $permission_c){
                $permission = Permission::where('name',$permission_c)->first();
                $client_role->givePermissionTo($permission);
            }
        }
        $staff_role = Role::where('name','staff')->where('created_by',$this->id)->where('guard_name','web')->first();
        if(empty($staff_role))
        {
            $staff_role                   = new Role();
            $staff_role->name             = 'staff';
            $staff_role->guard_name       = 'web';
            $staff_role->module           = 'Base';
            $staff_role->created_by       = $this->id;
            $staff_role->save();

            foreach($staff_role_permission as $permission_s){
                $permission = Permission::where('name',$permission_s)->first();
                $staff_role->givePermissionTo($permission);
            }
        }
        $data['client_role'] = $client_role;
        $data['staff_role'] = $staff_role;

        return $data;
    }
    public static function CompanySetting($id = null,$workspace_id = null)
    {
        if(!empty($id))
        {
            $company = User::find($id);
            if(empty($workspace_id))
            {
                $workspace_id = $company->active_workspace;
            }
            $company_setting = [
                "currency_format" => !empty(admin_setting('currency_format')) ? admin_setting('currency_format') : "1",
                "defult_currancy" => !empty(admin_setting('defult_currancy')) ? admin_setting('defult_currancy') : "USD",
                "defult_currancy_symbol" => !empty(admin_setting('defult_currancy_symbol')) ? admin_setting('defult_currancy_symbol') : "$",
                "defult_language" => !empty(admin_setting('defult_language')) ? admin_setting('defult_language') : 'en',
                "defult_timezone" => !empty(admin_setting('defult_timezone')) ? admin_setting('defult_timezone') : 'Asia/Kolkata',
                "site_currency_symbol_position" => "pre",
                "site_date_format" => "d-m-Y",
                "site_time_format" => "g:i A",
                "title_text" => !empty(admin_setting('title_text')) ? admin_setting('title_text') : "WorkDo Dash",
                "footer_text" => !empty(admin_setting('footer_text')) ? admin_setting('footer_text') :"Copyright © WorkDo Dash",
                "site_rtl" => "off",
                "cust_darklayout" => "off",
                "site_transparent" => "on",
                "color" => "theme-1",
                "invoice_prefix" => "#INVO",
                "invoice_starting_number" => "1",
                "invoice_template" => "template1",
                "invoice_color" => "ffffff",
                "invoice_shipping_display" => "on",
                "invoice_title" => "",
                "invoice_notes" => "",
                "proposal_prefix" => "#PROP0",
                "proposal_starting_number" => "1",
                "proposal_template" => "template1",
                "proposal_color" => "ffffff",
                "proposal_shipping_display" => "on",
                "proposal_title" => "",
                "proposal_notes" => "",

            ];
            $userContext = new Context(['user_id' => $id,'workspace_id'=> $workspace_id]);
            foreach($company_setting as $key =>  $p){
                if(empty(company_setting($key,$id)))
                {
                    \Settings::context($userContext)->set($key, $p);
                }
            }
        }
    }
    public function countCompany()
    {
        return User::where('type', '=', 'company')->where('created_by', '=',creatorId())->count();
    }
    public function countPaidCompany()
    {
        return  User::where('type', '=', 'company')->whereNotIn('active_plan', [0,1])->where('created_by', '=', creatorId())->count();
    }
    public function ActiveWorkspaceName()
    {
        $name = $this->name;
        $workspace = WorkSpace::find(getActiveWorkSpace());
        if($workspace)
        {
            $name = $workspace->name;
        }
        return $name;
    }

    public function UserCount($id,$plan)
    {
        if(!empty($id) && !empty($plan)){

            $users = User::where('workspace_id',$id)->where('is_disable',1)->where('type','!=','company')->get();
            $total_users =  $users->count();
            if($plan->number_of_user > 0)
            {
                if($total_users > $plan->number_of_user){
                        $count_user = $total_users - $plan->number_of_user;
                        $usersToDisable = User::orderBy('created_at', 'desc')->where('workspace_id',$id)->where('is_disable',1)->where('type','!=','company')->take($count_user)->get();
                        foreach($usersToDisable as $item){
                            $item->is_disable = 0;
                            $item->save();
                        }
                    }else{
                        $count_user =  $plan->number_of_user - $total_users ;
                        $users = User::where('workspace_id',$id)->where('is_disable',0)->where('type','!=','company')->take($count_user)->get();
                        foreach($users as $item){
                            $item->is_disable = 1;
                            $item->save();
                        }
                    }
                }elseif($plan->number_of_user == -1){
                    $users = User::where('workspace_id',$id)->get();
                    foreach($users as $item){
                        $item->is_disable = 1;
                        $item->save();
                    }
                }
        }
    }
}
