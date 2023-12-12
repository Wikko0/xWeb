<?php

namespace App\Providers;

use App\Models\XWEB_ADDSTATS;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AddStatsProvider extends ServiceProvider
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
        if (Schema::connection('XWEB')->hasTable('XWEB_ADDSTATS')) {
            $addStatsProvider = XWEB_ADDSTATS::get();
            View::share([
                'addStatsProvider' => $addStatsProvider,
            ]);
        }
    }
}
