<?php

namespace Modules\Hrm\Database\Seeders;

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
        // slack notification
        $notifications = [
            'New Award','New Announcement','New Holidays','New Monthly Payslip','New Event','New Company Policy'
        ];
        $types = [
            'slack','telegram'
        ];
        foreach($types as $t){
            foreach($notifications as $n){
                $ntfy = Notification::where('action',$n)->where('type',$t)->where('module','Hrm')->count();
                if($ntfy == 0){
                    $new = new Notification();
                    $new->action = $n;
                    $new->status = 'on';
                    $new->module = 'Hrm';
                    $new->type = $t;
                    $new->save();
                }
            }
        }

        // twilio notification
        $notifications = [
            'New Monthly Payslip','New Award','New Event','Leave Approve/Reject','New Trip','New Announcement','New Holidays','New Company Policy'
        ];
        $types = [
            'twilio','whatsapp'
        ];
        foreach($types as $t){
            foreach($notifications as $n){
                $ntfy = Notification::where('action',$n)->where('type',$t)->where('module','Hrm')->count();
                if($ntfy == 0){
                    $new = new Notification();
                    $new->action = $n;
                    $new->status = 'on';
                    $new->module = 'Hrm';
                    $new->type = $t;
                    $new->save();
                }
            }
        }

        // email notification
        $notifications = [
            'Leave Status','New Award','Employee Complaints','New Payroll','Employee Promotion','Employee Resignation','Employee Termination','Employee Transfer','Employee Trip','Employee Warning'
        ];
        $permissions = [
            'leave approver manage',
            'award manage',
            'complaint manage',
            'setsalary pay slip manage',
            'promotion manage',
            'resignation manage',
            'termination manage',
            'transfer manage',
            'travel manage',
            'warning manage'


        ];
            foreach($notifications as $key=>$n){
                $ntfy = Notification::where('action',$n)->where('type','mail')->where('module','Hrm')->count();
                if($ntfy == 0){
                    $new = new Notification();
                    $new->action = $n;
                    $new->status = 'on';
                    $new->permissions = $permissions[$key];
                    $new->module = 'Hrm';
                    $new->type = 'mail';
                    $new->save();
                }
            }

    }
}
