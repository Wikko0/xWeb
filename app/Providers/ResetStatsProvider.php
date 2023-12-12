<?php

namespace App\Providers;

use App\Helpers\DatabaseHelper;
use App\Models\XWEB_RESETSTATS;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ResetStatsProvider extends ServiceProvider
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
        if (DatabaseHelper::isXWEBConnected() && Schema::connection('XWEB')->hasTable('XWEB_RESETSTATS')) {
            $resetStatsProvider = XWEB_RESETSTATS::get();
            View::share([
                'resetStatsProvider' => $resetStatsProvider,
            ]);
        }
    }
}
