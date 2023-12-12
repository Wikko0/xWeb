<?php

namespace App\Providers;

use App\Models\XWEB_DOWNLOAD;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class DownloadProvider extends ServiceProvider
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
        if (Schema::connection('XWEB')->hasTable('XWEB_DOWNLOAD')) {
            $downloadProvider = XWEB_DOWNLOAD::get();
            View::share([
                'downloadProvider' => $downloadProvider,
            ]);
        }
    }
}
