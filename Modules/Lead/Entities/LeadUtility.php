<?php

namespace Modules\Lead\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\WorkSpace;
use Rawilk\Settings\Support\Context;

class LeadUtility extends Model
{
    use HasFactory;

    public static function GivePermissionToRoles($role_id = null,$rolename = null)
    {
        $client_permissions=[
            'crm manage',
            'deal manage',
            'deal show',
            'deal task create',
            'deal task edit',
            'deal task delete',
            'deal task show',
            'deal call create',
            'deal call edit',
            'deal call delete',
            'deal email create',
        ];


        $staff_permissions=[
            'crm manage',
            'lead manage',
            'lead show',
            'deal manage',
            'deal show',
            'deal task show',
        ];

        if($role_id == Null)
        {
            // client
            $roles_c = Role::where('name','client')->get();
            foreach($roles_c as $role)
            {
                foreach($client_permissions as $permission_c){
                    $permission = Permission::where('name',$permission_c)->first();
                    $role->givePermissionTo($permission);
                }
            }

            // vender
            $roles_v = Role::where('name','staff')->get();

            foreach($roles_v as $role)
            {
                foreach($staff_permissions as $permission_v){
                    $permission = Permission::where('name',$permission_v)->first();
                    $role->givePermissionTo($permission);
                }
            }

        }
        else
        {
            if($rolename == 'client')
            {
                $roles_c = Role::where('name','client')->where('id',$role_id)->first();
                foreach($client_permissions as $permission_c){
                    $permission = Permission::where('name',$permission_c)->first();
                    $roles_c->givePermissionTo($permission);
                }
            }
            elseif($rolename == 'staff')
            {
                $roles_v = Role::where('name','staff')->where('id',$role_id)->first();
                foreach($staff_permissions as $permission_v){
                    $permission = Permission::where('name',$permission_v)->first();
                    $roles_v->givePermissionTo($permission);
                }
            }
        }

    }

    public static function defaultdata($company_id = null,$workspace_id = null)
    {
        $pipelines = [
            'Sales',
        ];

        $lead_stages = [
            "Draft",
            "Sent",
            "Open",
            "Revised",
            "Declined",
            "Accepted",
        ];
        $stages = [
            'Initial Contact',
            'Qualification',
            'Meeting',
            'Proposal',
            'Close',
        ];

        if($company_id == Null)
        {
            $companys = User::where('type','company')->get();
            foreach($companys as $company)
            {
                $WorkSpaces = WorkSpace::where('created_by',$company->id)->get();
                foreach($WorkSpaces as $WorkSpace)
                {
                    foreach($pipelines as $pipeline)
                    {
                        $Pipeline = Pipeline::where('name',$pipeline)->where('workspace_id',$WorkSpace->id)->where('created_by',$company->id)->first();

                        if($Pipeline == null){
                            $Pipeline = new Pipeline();
                            $Pipeline->name = $pipeline;
                            $Pipeline->workspace_id =  !empty($WorkSpace->id) ? $WorkSpace->id : 0 ;
                            $Pipeline->created_by = !empty($company->id) ? $company->id : 2;
                            $Pipeline->save();
                        }
                    }
                    foreach($lead_stages as $lead_stage)
                    {
                        $leadstage = LeadStage::where('name',$lead_stage)->where('workspace_id',$WorkSpace->id)->where('created_by',$company->id)->first();

                        if($leadstage == null){
                            $leadstage = new LeadStage();
                            $leadstage->name = $lead_stage;
                            $leadstage->pipeline_id = $Pipeline->id;
                            $leadstage->order = 0;
                            $leadstage->workspace_id =  !empty($WorkSpace->id) ? $WorkSpace->id : 0 ;
                            $leadstage->created_by = !empty($company->id) ? $company->id : 2;
                            $leadstage->save();
                        }
                    }
                    foreach($stages as $stage)
                    {
                        $dealstage = DealStage::where('name',$stage)->where('workspace_id',$WorkSpace->id)->where('created_by',$company->id)->first();

                        if($dealstage == null){
                            $dealstage = new DealStage();
                            $dealstage->name = $stage;
                            $dealstage->pipeline_id = $Pipeline->id;
                            $dealstage->order = 0;
                            $dealstage->workspace_id =  !empty($WorkSpace->id) ? $WorkSpace->id : 0 ;
                            $dealstage->created_by = !empty($company->id) ? $company->id : 2;
                            $dealstage->save();
                        }

                    }
                }
            }
        }elseif($workspace_id == Null){
            $company = User::where('type','company')->where('id',$company_id)->first();
            $WorkSpaces = WorkSpace::where('created_by',$company->id)->get();
            foreach($WorkSpaces as $WorkSpace)
            {
                foreach($pipelines as $pipeline)
                {
                    $Pipeline = Pipeline::where('name',$pipeline)->where('workspace_id',$WorkSpace->id)->where('created_by',$company->id)->first();

                    if($Pipeline == null){
                        $Pipeline = new Pipeline();
                        $Pipeline->name = $pipeline;
                        $Pipeline->workspace_id =  !empty($WorkSpace->id) ? $WorkSpace->id : 0 ;
                        $Pipeline->created_by = !empty($company->id) ? $company->id : 2;
                        $Pipeline->save();
                    }
                }
                foreach($lead_stages as $lead_stage)
                {
                    $leadstage = LeadStage::where('name',$lead_stage)->where('workspace_id',$WorkSpace->id)->where('created_by',$company->id)->first();
                    if($leadstage == null){
                        $leadstage = new LeadStage();
                        $leadstage->name = $lead_stage;
                        $leadstage->pipeline_id = $Pipeline->id;
                        $leadstage->order = 0;
                        $leadstage->workspace_id =  !empty($WorkSpace->id) ? $WorkSpace->id : 0 ;
                        $leadstage->created_by = !empty($company->id) ? $company->id : 2;
                        $leadstage->save();
                    }

                }
                foreach($stages as $stage)
                    {
                        $dealstage = DealStage::where('name',$stage)->where('workspace_id',$WorkSpace->id)->where('created_by',$company->id)->first();
                        if($dealstage == null){
                            $dealstage = new DealStage();
                            $dealstage->name = $stage;
                            $dealstage->pipeline_id = $Pipeline->id;
                            $dealstage->order = 0;
                            $dealstage->workspace_id =  !empty($WorkSpace->id) ? $WorkSpace->id : 0 ;
                            $dealstage->created_by = !empty($company->id) ? $company->id : 2;
                            $dealstage->save();
                        }

                    }
            }
        }else{
            $company = User::where('type','company')->where('id',$company_id)->first();
            $WorkSpace = WorkSpace::where('created_by',$company->id)->where('id',$workspace_id)->first();
            foreach($pipelines as $pipeline)
            {
                $Pipeline = Pipeline::where('name',$pipeline)->where('workspace_id',$WorkSpace->id)->where('created_by',$company->id)->first();
                if($Pipeline == null){
                    $Pipeline = new Pipeline();
                    $Pipeline->name = $pipeline;
                    $Pipeline->workspace_id =  !empty($WorkSpace->id) ? $WorkSpace->id : 0 ;
                    $Pipeline->created_by = !empty($company->id) ? $company->id : 2;
                    $Pipeline->save();
                }
            }
            foreach($lead_stages as $lead_stage)
            {
                $leadstage = LeadStage::where('name',$lead_stage)->where('workspace_id',$WorkSpace->id)->where('created_by',$company->id)->first();
                if($leadstage == null){
                    $leadstage = new LeadStage();
                    $leadstage->name = $lead_stage;
                    $leadstage->pipeline_id = $Pipeline->id;
                    $leadstage->order = 0;
                    $leadstage->workspace_id =  !empty($WorkSpace->id) ? $WorkSpace->id : 0 ;
                    $leadstage->created_by = !empty($company->id) ? $company->id : 2;
                    $leadstage->save();
                }
            }
            foreach($stages as $stage)
            {
                $dealstage = DealStage::where('name',$stage)->where('workspace_id',$WorkSpace->id)->where('created_by',$company->id)->first();
                if($dealstage == null){
                    $dealstage = new DealStage();
                    $dealstage->name = $stage;
                    $dealstage->pipeline_id = $Pipeline->id;
                    $dealstage->order = 0;
                    $dealstage->workspace_id =  !empty($WorkSpace->id) ? $WorkSpace->id : 0 ;
                    $dealstage->created_by = !empty($company->id) ? $company->id : 2;
                    $dealstage->save();
                }

            }
        }
    }
}
