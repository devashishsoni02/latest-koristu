<?php

namespace RachidLaasri\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use RachidLaasri\LaravelInstaller\Helpers\DatabaseManager;
use RachidLaasri\LaravelInstaller\Helpers\InstalledFileManager;
use Nwidart\Modules\Facades\Module;
use Illuminate\Support\Facades\Artisan;

class UpdateController extends Controller
{
    use \RachidLaasri\LaravelInstaller\Helpers\MigrationsHelper;

    /**
     * Display the updater welcome page.
     *
     * @return \Illuminate\View\View
     */
    public function welcome()
    {
        return view('vendor.installer.update.welcome');
    }

    /**
     * Display the updater overview page.
     *
     * @return \Illuminate\View\View
     */
    public function overview()
    {
        $migrations = $this->getMigrations();
        $dbMigrations = $this->getExecutedMigrations();

        return view('vendor.installer.update.overview', ['numberOfUpdatesPending' => count($migrations) - count($dbMigrations)]);
    }

    /**
     * Migrate and seed the database.
     *
     * @return \Illuminate\View\View
     */
    public function database()
    {
        $databaseManager = new DatabaseManager;
        $response = $databaseManager->migrateAndSeed();

        $module = Module::find('LandingPage');
        $module->enable();

        Artisan::call('module:migrate LandingPage');
        Artisan::call('module:seed LandingPage');

        return redirect()->route('LaravelUpdater::final')
                         ->with(['message' => $response]);
    }

    /**
     * Update installed file and display finished view.
     *
     * @param InstalledFileManager $fileManager
     * @return \Illuminate\View\View
     */
    public function finish(InstalledFileManager $fileManager)
    {
        $fileManager->update();

        return view('vendor.installer.update.finished');
    }
}
