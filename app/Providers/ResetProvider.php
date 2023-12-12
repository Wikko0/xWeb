<?php

namespace App\Providers;

use App\Models\XWEB_RESET;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ResetProvider extends ServiceProvider
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
        if (Schema::connection('XWEB')->hasTable('XWEB_RESET')) {
            $resetProvider = XWEB_RESET::get();
            View::share([
                'resetProvider' => $resetProvider,
            ]);
        }
    }
}
