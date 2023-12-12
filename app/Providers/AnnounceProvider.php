<?php

namespace App\Providers;

use App\Helpers\DatabaseHelper;
use App\Models\XWEB_ANNOUNCE;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AnnounceProvider extends ServiceProvider
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
        if (DatabaseHelper::isXWEBConnected() && Schema::connection('XWEB')->hasTable('XWEB_ANNOUNCE')) {
            $announceProvider = XWEB_ANNOUNCE::get();
            View::share([
                'announceProvider' => $announceProvider,
            ]);
        }
    }
}
