<?php

namespace Modules\Lead\Database\Seeders;

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
        $lead_dash = Sidebar::where('title',__('CRM Dashboard'))->where('parent_id',$dashboard->id)->where('type','company')->first();
        if($lead_dash == null)
        {
            Sidebar::create( [
                'title' => 'CRM Dashboard',
                'icon' => '',
                'parent_id' => $dashboard->id,
                'sort_order' => 50,
                'route' => 'lead.dashboard',
                'permissions' => 'crm dashboard manage',
                'type' => 'company',
                'module' => 'Lead',
            ]);
        }
        $check = Sidebar::where('title',__('CRM'))->where('parent_id',0)->where('type','company')->exists();
        if(!($check))
        {
            $main = Sidebar::where('title',__('CRM'))->where('parent_id',0)->where('type','company')->first();
            if($main == null)
            {
                $main = Sidebar::create([
                    'title' => __('CRM'),
                    'icon' => 'ti ti-layers-difference',
                    'parent_id' => 0,
                    'sort_order' => 350,
                    'route' => '',
                    'permissions' => 'crm manage',
                    'type' => 'company',
                    'module' => 'Lead',
                ]);
            }
            $lead = Sidebar::where('title',__('Lead'))->where('parent_id',$main->id)->where('type','company')->first();
            if($lead == null)
            {
                Sidebar::create([
                    'title' => 'Lead',
                    'icon' => '',
                    'parent_id' => $main->id,
                    'sort_order' => 10,
                    'route' => 'leads.index',
                    'permissions' => 'lead manage',
                    'type' => 'company',
                    'module' => 'Lead',
                ]);
            }
            $deal = Sidebar::where('title',__('Deal'))->where('parent_id',$main->id)->where('type','company')->first();
            if($deal == null)
            {
                Sidebar::create([
                    'title' => 'Deal',
                    'icon' => '',
                    'parent_id' => $main->id,
                    'sort_order' => 15,
                    'route' => 'deals.index',
                    'permissions' => 'deal manage',
                    'type' => 'company',
                    'module' => 'Lead',
                ]);
            }
            $setup = Sidebar::where('title',__('System Setup'))->where('parent_id',$main->id)->where('type','company')->first();
            if($setup == null)
            {
                $setup =  Sidebar::create([
                    'title' => 'System Setup',
                    'icon' => '',
                    'parent_id' => $main->id,
                    'sort_order' => 30,
                    'route' => 'pipelines.index',
                    'permissions' => 'crm setup manage',
                    'type' => 'company',
                    'module' => 'Lead',
                ]);
            }
            $report = Sidebar::where('title',__('Report'))->where('parent_id',$main->id)->where('type','company')->first();
            if(!$report)
            {
                $report =  Sidebar::create( [
                    'title' => 'Report',
                    'icon' => '',
                    'parent_id' => $main->id,
                    'sort_order' => 35,
                    'route' => '',
                    'permissions' =>'crm report manage',
                    'type' => 'company',
                    'module' => 'Lead',
                ]);
            }
            $quoteanl = Sidebar::where('title',__('Lead'))->where('parent_id',$report->id)->where('type','company')->first();
            if($quoteanl == null)
            {
                Sidebar::create( [
                    'title' => 'Lead',
                    'icon' => 'ti ti-file-invoice',
                    'parent_id' => $report->id,
                    'sort_order' => 10,
                    'route' => 'report.lead',
                    'permissions' => 'lead report',
                    'type' => 'company',
                    'module' => 'Lead',
                ]);
            }
            $inoanl = Sidebar::where('title',__('Deal'))->where('parent_id',$report->id)->where('type','company')->first();
            if($inoanl == null)
            {
                Sidebar::create( [
                    'title' => 'Deal',
                    'icon' => 'ti ti-file-invoice',
                    'parent_id' => $report->id,
                    'sort_order' => 15,
                    'route' => 'report.deal',
                    'permissions' => 'deal report',
                    'type' => 'company',
                    'module' => 'Lead',
                ]);
            }
        }
    }
}
