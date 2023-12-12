<?php

namespace App\Providers;

use App\Helpers\DatabaseHelper;
use App\Models\XWEB_PKCLEAR;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class PkClearProvider extends ServiceProvider
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
        if (DatabaseHelper::isXWEBConnected() && Schema::connection('XWEB')->hasTable('XWEB_PKCLEAR')) {
            $pkClearProvider = XWEB_PKCLEAR::get();
            View::share([
                'pkClearProvider' => $pkClearProvider,
            ]);
        }
    }
}
