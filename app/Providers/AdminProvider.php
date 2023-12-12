<?php

namespace App\Providers;

use App\Helpers\DatabaseHelper;
use App\Models\XWEB_ADMINLOGIN;
use App\Models\XWEB_WEB_INFORMATION;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AdminProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (DatabaseHelper::isXWEBConnected() && Schema::connection('XWEB')->hasTable('XWEB_WEB_INFORMATION') && Schema::connection('XWEB')->hasTable('XWEB_ADMINLOGIN')) {
            $webInformationProvider = XWEB_WEB_INFORMATION::get();
            $adminProvider = XWEB_ADMINLOGIN::get();
            View::share([
                'webInformationProvider' => $webInformationProvider,
                'adminProvider' => $adminProvider
            ]);
        }
    }
}
