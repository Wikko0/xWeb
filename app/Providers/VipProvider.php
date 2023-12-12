<?php

namespace App\Providers;

use App\Helpers\DatabaseHelper;
use App\Models\XWEB_VIP_PACKAGE;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class VipProvider extends ServiceProvider
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
        if (DatabaseHelper::isXWEBConnected() && Schema::connection('XWEB')->hasTable('XWEB_VIP_PACKAGE')) {
            $vipProvider = XWEB_VIP_PACKAGE::get();
            View::share([
                'vipProvider' => $vipProvider,
            ]);
        }
    }
}
