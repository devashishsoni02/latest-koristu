<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notifications = [
            'Create User',
            'Customer Invoice Send',
            'Payment Reminder',
            'Invoice Payment Create',
            'Proposal Status Updated',
        ];
        $permissions = [
            'user manage',
            'invoice send',
            'invoice manage',
            'invoice payment create',
            'proposal send',
        ];
            foreach($notifications as $key=>$n){
                $ntfy = Notification::where('action',$n)->where('type','mail')->where('module','general')->count();
                if($ntfy == 0){
                    $new = new Notification();
                    $new->action = $n;
                    $new->status = 'on';
                    $new->permissions = $permissions[$key];
                    $new->module = 'general';
                    $new->type = 'mail';
                    $new->save();
                }
            }

        $notifications = [
            'Create User','New Invoice','Invoice Status Updated','New Proposal','Proposal Status Updated'
        ];
        $types = [
            'slack','telegram','twilio','whatsapp'
        ];
        foreach($types as $t){
            foreach($notifications as $n){
                $ntfy = Notification::where('action',$n)->where('type',$t)->where('module','general')->count();
                if($ntfy == 0){
                    $new = new Notification();
                    $new->action = $n;
                    $new->status = 'on';
                    $new->module = 'general';
                    $new->type = $t;
                    $new->save();
                }
            }
        }
    }
}
