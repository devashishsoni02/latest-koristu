<?php

namespace RachidLaasri\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use RachidLaasri\LaravelInstaller\Helpers\DatabaseManager;
use Nwidart\Modules\Facades\Module;
class DatabaseController extends Controller
{
    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * @param DatabaseManager $databaseManager
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    /**
     * Migrate and seed the database.
     *
     * @return \Illuminate\View\View
     */
    public function database()
    {
       $modules =  Module::all();
       if(count($modules)>0)
       {
           foreach ($modules as $key => $module)
           {
             $module->enable();
           }
       }

        $response = $this->databaseManager->migrateAndSeed();
        $module_json=Module::getByStatus(1);
        if(count($module_json)>0)
        {
            $module=array_key_first($module_json);
            return redirect()->route('LaravelInstaller::default_module', ['module' => $module]);
        }
        else
        {
            return redirect()->route('LaravelInstaller::final')
                         ->with(['message' => $response]);
        }
    }
}
