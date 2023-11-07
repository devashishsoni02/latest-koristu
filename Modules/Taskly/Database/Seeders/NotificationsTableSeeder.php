<?php

namespace Modules\Taskly\Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class NotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        //  slack notification
        $notifications = [
            'New Project','New Milestone','New Task','Task Stage Updated','New Task Comment','New Bug'
        ];
        $types = [
            'slack','telegram'
        ];
        foreach($types as $t){
            foreach($notifications as $n){
                $ntfy = Notification::where('action',$n)->where('type',$t)->where('module','Taskly')->count();
                if($ntfy == 0){
                    $new = new Notification();
                    $new->action = $n;
                    $new->status = 'on';
                    $new->module = 'Taskly';
                    $new->type = $t;
                    $new->save();
                }
            }
        }

        Model::unguard();
        //  twilio notification
        $notifications = [
            'New Project','New Task','New Bug',
        ];
        $types = [
            'twilio','whatsapp'
        ];
        foreach($types as $t){
            foreach($notifications as $n){
                $ntfy = Notification::where('action',$n)->where('type',$t)->where('module','Taskly')->count();
                if($ntfy == 0){
                    $new = new Notification();
                    $new->action = $n;
                    $new->status = 'on';
                    $new->module = 'Taskly';
                    $new->type = $t;
                    $new->save();
                }
            }
        }

        // email notification
        $notifications = [
        'User Invited',
        'Project Assigned',
        ];

        foreach($notifications as $key=>$n){
            $ntfy = Notification::where('action',$n)->where('type','mail')->where('module','Taskly')->count();
            if($ntfy == 0){
                $new = new Notification();
                $new->action = $n;
                $new->status = 'on';
                $new->permissions = null;
                $new->module = 'Taskly';
                $new->type = 'mail';
                $new->save();
            }
        }
    }
}
