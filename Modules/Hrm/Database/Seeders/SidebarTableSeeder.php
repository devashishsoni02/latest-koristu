<?php

namespace Modules\Hrm\Database\Seeders;

use App\Models\Sidebar;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SidebarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $dashboard = Sidebar::where('title',__('Dashboard'))->where('parent_id',0)->where('type','company')->first();

        $Hrm_dash = Sidebar::where('title',__('HRM Dashboard'))->where('parent_id',$dashboard->id)->where('type','company')->first();
        if($Hrm_dash == null)
        {
                Sidebar::create( [
                'title' => 'HRM Dashboard',
                'icon' => '',
                'parent_id' => $dashboard->id,
                'sort_order' => 30,
                'route' => 'hrm.dashboard',
                'permissions' => 'hrm dashboard manage',
                'module' => 'Hrm',
                'type'=>'company',
            ]);
        }

        $check = Sidebar::where('title',__('HRM'))->where('parent_id',0)->exists();
        if(!$check)
        {
            $main = Sidebar::where('title',__('HRM'))->where('parent_id',0)->where('type','company')->first();
            if($main == null)
            {
                $main = Sidebar::create([
                    'title' => 'HRM',
                    'icon' => 'ti ti-3d-cube-sphere',
                    'parent_id' => 0,
                    'sort_order' => 330,
                    'route' => null,
                    'permissions' => 'hrm manage',
                    'module' => 'Hrm',
                    'type'=>'company',

                ]);
            }
            $employee = Sidebar::where('title',__('Employee'))->where('parent_id',$main->id)->where('type','company')->first();
            if($employee == null)
            {
               Sidebar::create([
                    'title' => 'Employee',
                    'icon' => '',
                    'parent_id' => $main->id,
                    'sort_order' => 10,
                    'route' => 'employee.index',
                    'permissions' => 'employee manage',
                    'module' => 'Hrm',
                    'type'=>'company',

                ]);
            }
            $payroll = Sidebar::where('title',__('Payroll'))->where('parent_id',$main->id)->where('type','company')->first();
            if($payroll == null)
            {
                $payroll =  Sidebar::create([
                    'title' => 'Payroll',
                    'icon' => '',
                    'parent_id' => $main->id,
                    'sort_order' => 15,
                    'route' => null,
                    'permissions' => 'sidebar payroll manage',
                    'module' => 'Hrm',
                    'type'=>'company',

                ]);
            }
            $set_salary = Sidebar::where('title',__('Set salary'))->where('parent_id',$payroll->id)->where('type','company')->first();
            if($set_salary == null)
            {
                Sidebar::create([
                    'title' => 'Set salary',
                    'icon' => '',
                    'parent_id' => $payroll->id,
                    'sort_order' => 10,
                    'route' => 'setsalary.index',
                    'permissions' => 'setsalary manage',
                    'module' => 'Hrm',
                    'type'=>'company',

                ]);
            }
            $payslip = Sidebar::where('title',__('Payslip'))->where('parent_id',$payroll->id)->where('type','company')->first();
            if($payslip == null)
            {
                Sidebar::create([
                    'title' => 'Payslip',
                    'icon' => '',
                    'parent_id' => $payroll->id,
                    'sort_order' => 15,
                    'route' => 'payslip.index',
                    'permissions' => 'setsalary pay slip manage',
                    'module' => 'Hrm',
                    'type'=>'company',

                ]);
            }
            $leave = Sidebar::where('title',__('Manage Leave'))->where('parent_id',$main->id)->where('type','company')->first();
            if($leave == null)
            {
                Sidebar::create([
                    'title' => 'Manage Leave',
                    'icon' => '',
                    'parent_id' => $main->id,
                    'sort_order' => 17,
                    'route' => 'leave.index',
                    'permissions' => 'leave manage',
                    'module' => 'Hrm',
                    'type'=>'company',

                ]);
            }
            $Attendance = Sidebar::where('title',__('Attendance'))->where('parent_id',$main->id)->where('type','company')->first();
            if($Attendance == null)
            {
                $Attendance =  Sidebar::create([
                        'title' => 'Attendance',
                        'icon' => '',
                        'parent_id' => $main->id,
                        'sort_order' => 16,
                        'route' => null,
                        'permissions' => 'attendance manage',
                        'module' => 'Hrm',
                        'type'=>'company',

                    ]);
            }

            $m_attendance = Sidebar::where('title',__('Mark Attendance'))->where('parent_id',$Attendance->id)->where('type','company')->first();
            if($m_attendance == null)
            {
                Sidebar::create([
                    'title' => 'Mark Attendance',
                    'icon' => '',
                    'parent_id' => $Attendance->id,
                    'sort_order' => 10,
                    'route' => 'attendance.index',
                    'module' => 'Hrm',
                    'type'=>'company',

                ]);
            }

            $b_attendance = Sidebar::where('title',__('Bulk Attendance'))->where('parent_id',$Attendance->id)->where('type','company')->first();
            if($b_attendance == null)
            {
                Sidebar::create([
                    'title' => 'Bulk Attendance',
                    'icon' => '',
                    'parent_id' => $Attendance->id,
                    'sort_order' => 15,
                    'route' => 'attendance.bulkattendance',
                    'module' => 'Hrm',
                    'type'=>'company',

                ]);
            }
            $hr = Sidebar::where('title',__('HR Admin'))->where('parent_id',$main->id)->where('type','company')->first();
            if($hr == null)
            {
                $hr =  Sidebar::create([
                    'title' => 'HR Admin',
                    'icon' => '',
                    'parent_id' => $main->id,
                    'sort_order' => 45,
                    'route' => null,
                    'permissions' => 'sidebar hr admin  manage',
                    'module' => 'Hrm',
                    'type'=>'company',

                ]);
            }
            $award = Sidebar::where('title',__('Award'))->where('parent_id',$hr->id)->where('type','company')->first();
            if($award == null)
            {
                Sidebar::create([
                    'title' => 'Award',
                    'icon' => '',
                    'parent_id' => $hr->id,
                    'sort_order' => 10,
                    'route' => 'award.index',
                    'permissions' => 'award manage',
                    'module' => 'Hrm',
                    'type'=>'company',

                ]);
            }
            $transfer = Sidebar::where('title',__('Transfer'))->where('parent_id',$hr->id)->where('type','company')->first();
            if($transfer == null)
            {
                Sidebar::create([
                    'title' => 'Transfer',
                    'icon' => '',
                    'parent_id' => $hr->id,
                    'sort_order' => 15,
                    'route' => 'transfer.index',
                    'permissions' => 'transfer manage',
                    'module' => 'Hrm',
                    'type'=>'company',

                ]);
            }
            $resignation = Sidebar::where('title',__('Resignation'))->where('parent_id',$hr->id)->where('type','company')->first();
            if($resignation == null)
            {
                Sidebar::create([
                    'title' => 'Resignation',
                    'icon' => '',
                    'parent_id' => $hr->id,
                    'sort_order' => 20,
                    'route' => 'resignation.index',
                    'permissions' => 'resignation manage',
                    'module' => 'Hrm',
                    'type'=>'company',

                ]);
            }
            $trip = Sidebar::where('title',__('Trip'))->where('parent_id',$hr->id)->where('type','company')->first();
            if($trip == null)
            {
                Sidebar::create([
                    'title' => 'Trip',
                    'icon' => '',
                    'parent_id' => $hr->id,
                    'sort_order' => 25,
                    'route' => 'trip.index',
                    'permissions' => 'travel manage',
                    'module' => 'Hrm',
                    'type'=>'company',

                ]);
            }
            $promotion = Sidebar::where('title',__('Promotion'))->where('parent_id',$hr->id)->where('type','company')->first();
            if($promotion == null)
            {
                Sidebar::create([
                    'title' => 'Promotion',
                    'icon' => '',
                    'parent_id' => $hr->id,
                    'sort_order' => 30,
                    'route' => 'promotion.index',
                    'permissions' => 'promotion manage',
                    'module' => 'Hrm',
                    'type'=>'company',

                ]);
            }
            $complaint = Sidebar::where('title',__('Complaints'))->where('parent_id',$hr->id)->where('type','company')->first();
            if($complaint == null)
            {
                Sidebar::create([
                    'title' => 'Complaints',
                    'icon' => '',
                    'parent_id' => $hr->id,
                    'sort_order' => 35,
                    'route' => 'complaint.index',
                    'permissions' => 'complaint manage',
                    'module' => 'Hrm',
                    'type'=>'company',

                ]);
            }
            $warning = Sidebar::where('title',__('Warning'))->where('parent_id',$hr->id)->where('type','company')->first();
            if($warning == null)
            {
                Sidebar::create([
                    'title' => 'Warning',
                    'icon' => '',
                    'parent_id' => $hr->id,
                    'sort_order' => 40,
                    'route' => 'warning.index',
                    'permissions' => 'warning manage',
                    'module' => 'Hrm',
                    'type'=>'company',

                ]);
            }
            $termination = Sidebar::where('title',__('Termination'))->where('parent_id',$hr->id)->where('type','company')->first();
            if($termination == null)
            {
                Sidebar::create([
                    'title' => 'Termination',
                    'icon' => '',
                    'parent_id' => $hr->id,
                    'sort_order' => 45,
                    'route' => 'termination.index',
                    'permissions' => 'termination manage',
                    'module' => 'Hrm',
                    'type'=>'company',

                ]);
            }
            $announcement = Sidebar::where('title',__('Announcement'))->where('parent_id',$hr->id)->where('type','company')->first();
            if($announcement == null)
            {
                Sidebar::create([
                    'title' => 'Announcement',
                    'icon' => '',
                    'parent_id' => $hr->id,
                    'sort_order' => 50,
                    'route' => 'announcement.index',
                    'permissions' => 'announcement manage',
                    'module' => 'Hrm',
                    'type'=>'company',

                ]);
            }
            $holiday = Sidebar::where('title',__('Holidays'))->where('parent_id',$hr->id)->where('type','company')->first();
            if($holiday == null)
            {
                Sidebar::create([
                    'title' => 'Holidays',
                    'icon' => '',
                    'parent_id' => $hr->id,
                    'sort_order' => 50,
                    'route' => 'holiday.index',
                    'permissions' => 'holiday manage',
                    'module' => 'Hrm',
                    'type'=>'company',

                ]);
            }
            $Event = Sidebar::where('title',__('Event'))->where('parent_id',$main->id)->where('type','company')->first();
            if($Event == null)
            {
                Sidebar::create([
                    'title' => 'Event',
                    'icon' => '',
                    'parent_id' => $main->id,
                    'sort_order' => 50,
                    'route' => 'event.index',
                    'permissions' => 'event manage',
                    'module' => 'Hrm',
                    'type'=>'company',

                ]);
            }
            $document = Sidebar::where('title',__('Document'))->where('parent_id',$main->id)->where('type','company')->first();
            if($document == null)
            {
                Sidebar::create([
                    'title' => 'Document',
                    'icon' => '',
                    'parent_id' => $main->id,
                    'sort_order' => 55,
                    'route' => 'document.index',
                    'permissions' => 'document manage',
                    'module' => 'Hrm',
                    'type'=>'company',

                ]);
            }
            $company_policy = Sidebar::where('title',__('Company Policy'))->where('parent_id',$main->id)->where('type','company')->first();
            if($company_policy == null)
            {
                Sidebar::create([
                    'title' => 'Company Policy',
                    'icon' => '',
                    'parent_id' => $main->id,
                    'sort_order' => 60,
                    'route' => 'company-policy.index',
                    'permissions' => 'companypolicy manage',
                    'module' => 'Hrm',
                    'type'=>'company',

                ]);
            }
            $Structure = Sidebar::where('title',__('System Setup'))->where('parent_id',$main->id)->where('type','company')->first();
            if($Structure == null)
            {
                $Structure =  Sidebar::create([
                    'title' => 'System Setup',
                    'icon' => '',
                    'parent_id' => $main->id,
                    'sort_order' => 65,
                    'route' => 'branch.index',
                    'permissions' => 'branch manage',
                    'module' => 'Hrm',
                    'type'=>'company',

                ]);
            }
            $Report = Sidebar::where('title',__('Report'))->where('parent_id',$main->id)->where('type','company')->first();
            if($Report == null)
            {
                $Report =  Sidebar::create([
                        'title' => 'Report',
                        'icon' => '',
                        'parent_id' => $main->id,
                        'sort_order' => 70,
                        'route' => null,
                        'permissions' => 'sidebar hrm report manage',
                        'module' => 'Hrm',
                        'type'=>'company',

                    ]);
            }
            $monthly_attendance = Sidebar::where('title',__('Monthly Attendance'))->where('parent_id',$Report->id)->where('type','company')->first();
            if($monthly_attendance == null)
            {
                    Sidebar::create([
                    'title' => 'Monthly Attendance',
                    'icon' => '',
                    'parent_id' => $Report->id,
                    'sort_order' => 10,
                    'route' => 'report.monthly.attendance',
                    'permissions' => 'attendance report manage',
                    'module' => 'Hrm',
                    'type'=>'company',

                ]);
            }
            $r_leave = Sidebar::where('title',__('Leave'))->where('parent_id',$Report->id)->where('type','company')->first();
            if($r_leave == null)
            {
                Sidebar::create([
                    'title' => 'Leave',
                    'icon' => '',
                    'parent_id' => $Report->id,
                    'sort_order' => 15,
                    'route' => 'report.leave',
                    'permissions' => 'leave report manage',
                    'module' => 'Hrm',
                    'type'=>'company',

                ]);
            }
            $r_payroll = Sidebar::where('title',__('Payroll'))->where('parent_id',$Report->id)->where('type','company')->first();
            if($r_payroll == null)
            {
                Sidebar::create([
                    'title' => 'Payroll',
                    'icon' => '',
                    'parent_id' => $Report->id,
                    'sort_order' => 20,
                    'route' => 'report.payroll',
                    'permissions' => 'hrm payroll report manage',
                    'module' => 'Hrm',
                    'type'=>'company'
                ]);
            }
        }
    }
}
