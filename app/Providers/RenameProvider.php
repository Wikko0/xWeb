<?php

namespace App\Providers;

use App\Helpers\DatabaseHelper;
use App\Models\XWEB_RENAME;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class RenameProvider extends ServiceProvider
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
        if (DatabaseHelper::isXWEBConnected() && Schema::connection('XWEB')->hasTable('XWEB_RENAME')) {
            $renameProvider = XWEB_RENAME::get();
            View::share([
                'renameProvider' => $renameProvider,
            ]);
        }
    }
}
