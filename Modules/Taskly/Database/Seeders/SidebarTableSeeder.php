<?php

namespace Modules\Taskly\Database\Seeders;

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
        $project_dash = Sidebar::where('title',__('Project Dashboard'))->where('parent_id',$dashboard->id)->where('type','company')->first();
        if($project_dash == null)
        {
            Sidebar::create([
                'title' => 'Project Dashboard',
                'icon' => '',
                'parent_id' => $dashboard->id,
                'sort_order' => 10,
                'route' => 'taskly.dashboard',
                'permissions' => 'taskly dashboard manage',
                'type' => 'company',
                'module' => 'Taskly',
            ]);
        }

        $check = Sidebar::where('title',__('Projects'))->where('parent_id',0)->exists();
        if(!$check)
        {
            $main = Sidebar::where('title',__('Projects'))->where('parent_id',0)->where('type','company')->first();
            if($main == null)
            {
                $main = Sidebar::create( [
                    'title' => 'Projects',
                    'icon' => 'ti ti-square-check',
                    'parent_id' => 0,
                    'sort_order' => 310,
                    'route' => NULL,
                    'permissions' => 'project manage',
                    'type' => 'company',
                    'module' => 'Taskly',
                ]);
            }

            $project = Sidebar::where('title',__('Project'))->where('parent_id',$main->id)->where('type','company')->first();
            if($project == null)
            {
                Sidebar::create( [
                    'title' => 'Project',
                    'icon' => '',
                    'parent_id' => $main->id,
                    'sort_order' => 20,
                    'route' => 'projects.index',
                    'permissions' => 'project manage',
                    'type' => 'company',
                    'module' => 'Taskly',
                ]);
            }

            $report = Sidebar::where('title',__('Project Report'))->where('parent_id',$main->id)->where('type','company')->first();
            if($report == null)
            {
                Sidebar::create( [
                    'title' => 'Project Report',
                    'icon' => '',
                    'parent_id' => $main->id,
                    'sort_order' => 30,
                    'route' => 'project_report.index',
                    'permissions' => 'project report manage',
                    'type' => 'company',
                    'module' => 'Taskly',
                ]);
            }

            $setup = Sidebar::where('title',__('System Setup'))->where('parent_id',$main->id)->where('type','company')->first();
            if($setup == null)
            {
                $setup =  Sidebar::create([
                    'title' => 'System Setup',
                    'icon' => '',
                    'parent_id' => $main->id,
                    'sort_order' => 40,
                    'route' => 'stages.index',
                    'permissions' => 'taskly setup manage',
                    'type' => 'company',
                    'module' => 'Taskly',
                ]);
            }
        }
    }
}
