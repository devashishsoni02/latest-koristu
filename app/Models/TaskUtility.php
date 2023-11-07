<?php

namespace Modules\Taskly\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\WorkSpace;
use Rawilk\Settings\Support\Context;

class TaskUtility extends Model
{
    use HasFactory;

    public static function GivePermissionToRoles($role_id = null,$rolename = null)
    {
        $client_permissions=[
            'taskly dashboard manage',
            'taskly manage',
            'project manage',
            'project create',
            'project show',
            'bug edit',
            'bug show',
            'bug move',
            'bug manage',
            'bug create',
            'bug delete',
            'bug comments delete',
            'bug comments create',
            'bug file delete',
            'bug file uploads',
            'milestone manage',
            'milestone show',
            'sub-task delete',
            'sub-task edit',
            'sub-task manage',
            'task file uploads',
            'task file manage',
            'task file show',
            'task file delete',
            'task comment show',
            'task comment delete',
            'task comment create',
            'task comment edit',
            'task comment manage',
            'task show',
            'task delete',
            'task edit',
            'task create',
            'task manage',
        ];


        $staff_permissions=[
            'taskly dashboard manage',
            'taskly manage',
            'project manage',
            'project show',
            'bug show',
            'bug move',
            'bug manage',
            'bug comments create',
            'bug file delete',
            'bug file uploads',
            'sub-task edit',
            'sub-task manage',
            'task file manage',
            'task file show',
            'task comment show',
            'task comment manage',
            'task show',
            'task manage',
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
            $roles_s = Role::where('name','staff')->get();

            foreach($roles_s as $role)
            {
                foreach($staff_permissions as $permission_s){
                    $permission = Permission::where('name',$permission_s)->first();
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
                $roles_s = Role::where('name','staff')->where('id',$role_id)->first();
                foreach($staff_permissions as $permission_s){
                    $permission = Permission::where('name',$permission_s)->first();
                    $roles_s->givePermissionTo($permission);
                }
            }
        }

    }

    public static function defaultdata($company_id = null,$workspace_id = null)
    {
        $task_stages = [
            "Todo",
            "In Progress",
            "Review",
            "Done",
        ];
        $bug_stages = [
            'Unconfirmed',
            'Confirmed',
            'In Progress',
            'Resolved',
            'Verified',
        ];

        if($company_id == Null)
        {
            $companys = User::where('type','company')->get();
            foreach($companys as $company)
            {
                $WorkSpaces = WorkSpace::where('created_by',$company->id)->get();
                foreach($WorkSpaces as $WorkSpace)
                {

                    foreach($task_stages as $task_stage)
                    {
                        $taskstage = Stage::where('name',$task_stage)->where('workspace_id',$WorkSpace->id)->where('created_by',$company->id)->first();

                        if($taskstage == null){
                            $taskstage = new Stage();
                            $taskstage->name = $task_stage;
                            $taskstage->order = 0;
                            $taskstage->workspace_id =  !empty($WorkSpace->id) ? $WorkSpace->id : 0 ;
                            $taskstage->created_by = !empty($company->id) ? $company->id : 2;
                            $taskstage->save();
                        }
                    }
                    foreach($bug_stages as $bug_stage)
                    {
                        $bugstage = BugStage::where('name',$bug_stage)->where('workspace_id',$WorkSpace->id)->where('created_by',$company->id)->first();

                        if($bugstage == null){
                            $bugstage = new BugStage();
                            $bugstage->name = $bug_stage;
                            $bugstage->order = 0;
                            $bugstage->workspace_id =  !empty($WorkSpace->id) ? $WorkSpace->id : 0 ;
                            $bugstage->created_by = !empty($company->id) ? $company->id : 2;
                            $bugstage->save();
                        }

                    }
                }
            }
        }elseif($workspace_id == Null){
            $company = User::where('type','company')->where('id',$company_id)->first();
            $WorkSpaces = WorkSpace::where('created_by',$company->id)->get();
            foreach($WorkSpaces as $WorkSpace)
            {
                foreach($task_stages as $task_stage)
                {
                    $taskstage = Stage::where('name',$task_stage)->where('workspace_id',$WorkSpace->id)->where('created_by',$company->id)->first();

                    if($taskstage == null){
                        $taskstage = new Stage();
                        $taskstage->name = $task_stage;
                        $taskstage->order = 0;
                        $taskstage->workspace_id =  !empty($WorkSpace->id) ? $WorkSpace->id : 0 ;
                        $taskstage->created_by = !empty($company->id) ? $company->id : 2;
                        $taskstage->save();
                    }
                }
                foreach($bug_stages as $bug_stage)
                {
                    $bugstage = BugStage::where('name',$bug_stage)->where('workspace_id',$WorkSpace->id)->where('created_by',$company->id)->first();

                    if($bugstage == null){
                        $bugstage = new BugStage();
                        $bugstage->name = $bug_stage;
                        $bugstage->order = 0;
                        $bugstage->workspace_id =  !empty($WorkSpace->id) ? $WorkSpace->id : 0 ;
                        $bugstage->created_by = !empty($company->id) ? $company->id : 2;
                        $bugstage->save();
                    }

                }
            }
        }else{
            $company = User::where('type','company')->where('id',$company_id)->first();
            $WorkSpace = WorkSpace::where('created_by',$company->id)->where('id',$workspace_id)->first();
            foreach($task_stages as $task_stage)
            {
                $taskstage = Stage::where('name',$task_stage)->where('workspace_id',$WorkSpace->id)->where('created_by',$company->id)->first();

                if($taskstage == null){
                    $taskstage = new Stage();
                    $taskstage->name = $task_stage;
                    $taskstage->order = 0;
                    $taskstage->workspace_id =  !empty($WorkSpace->id) ? $WorkSpace->id : 0 ;
                    $taskstage->created_by = !empty($company->id) ? $company->id : 2;
                    $taskstage->save();
                }
            }
            foreach($bug_stages as $bug_stage)
            {
                $bugstage = BugStage::where('name',$bug_stage)->where('workspace_id',$WorkSpace->id)->where('created_by',$company->id)->first();

                if($bugstage == null){
                    $bugstage = new BugStage();
                    $bugstage->name = $bug_stage;
                    $bugstage->order = 0;
                    $bugstage->workspace_id =  !empty($WorkSpace->id) ? $WorkSpace->id : 0 ;
                    $bugstage->created_by = !empty($company->id) ? $company->id : 2;
                    $bugstage->save();
                }

            }
        }
    }
}
