<?php

namespace App\Providers;

use App\Models\XWEB_GRANDRESET;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class GrandResetProvider extends ServiceProvider
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
        if (Schema::connection('XWEB')->hasTable('XWEB_GRANDRESET')) {
            $grandResetProvider = XWEB_GRANDRESET::get();
            View::share([
                'grandResetProvider' => $grandResetProvider,
            ]);
        }
    }
}
