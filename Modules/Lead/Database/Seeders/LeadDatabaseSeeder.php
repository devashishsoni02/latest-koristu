<?php

namespace Modules\Lead\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Nwidart\Modules\Facades\Module;

class LeadDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(SidebarTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(EmailTemplateTableSeeder::class);
        $this->call(NotificationsTableSeeder::class);
        $check = Module::find('CustomField');
        if($check ){
            $this->call(CustomFieldListTableSeeder::class);
        }
        if(module_is_active('AIAssistant'))
        {
            $this->call(AIAssistantTemplateListTableSeeder::class);
        }
        if(module_is_active('Webhook'))
        {
            $this->call(WebhookTableSeeder::class);
        }
        if(module_is_active('LandingPage'))
        {
            $this->call(MarketPlaceSeederTableSeeder::class);
        }
        if(module_is_active('Zapier'))
        {
            $this->call(ZapierTableSeeder::class);
        }
    }
}
