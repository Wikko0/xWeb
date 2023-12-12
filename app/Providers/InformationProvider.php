<?php

namespace App\Providers;

use App\Models\XWEB_ADD_INFORMATION;
use App\Models\XWEB_INFORMATION;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class InformationProvider extends ServiceProvider
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
        if (Schema::connection('XWEB')->hasTable('XWEB_INFORMATION')) {
            $informationProvider = XWEB_INFORMATION::get();
            View::share([
                'informationProvider' => $informationProvider,
            ]);
        }

        if (Schema::connection('XWEB')->hasTable('XWEB_ADD_INFORMATION')) {
            $addedInformationProvider = XWEB_ADD_INFORMATION::get();
            View::share([
                'addedInformationProvider' => $addedInformationProvider,
            ]);
        }
    }
}
