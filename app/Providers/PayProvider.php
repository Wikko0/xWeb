<?php

namespace App\Providers;

use App\Helpers\DatabaseHelper;
use App\Models\XWEB_PAYPAL;
use App\Models\XWEB_PAYPAL_PACKAGE;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class PayProvider extends ServiceProvider
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
        if (DatabaseHelper::isXWEBConnected() && Schema::connection('XWEB')->hasTable('XWEB_PAYPAL') &&
            Schema::connection('XWEB')->hasTable('XWEB_PAYPAL_PACKAGE')) {

            $paypalProvider = XWEB_PAYPAL::get();
            $paypalPackProvider = XWEB_PAYPAL_PACKAGE::get();

            View::share([
                'paypalProvider' => $paypalProvider,
                'paypalPackProvider' => $paypalPackProvider,
            ]);
        }
    }
}
