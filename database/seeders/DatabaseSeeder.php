<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App::setLocale('en');

        $this->call(SidebarMenu::class);
        $this->call(EmailTemplates::class);
        $this->call(NotificationsTableSeeder::class);
        $this->call(Plans::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DefultSetting::class);
        $this->call(CustomFieldListTableSeeder::class);
        $this->call(LanguageTableSeeder::class);
    }
}
