<?php

namespace App\Providers;

use App\Models\XWEB_NEWS;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class NewsProvider extends ServiceProvider
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
        if (Schema::connection('XWEB')->hasTable('XWEB_NEWS')) {
            $newNewsProvider = XWEB_NEWS::where('specific', '=', 'news')->get();
            $newEventsProvider = XWEB_NEWS::where('specific', '=', 'events')->get();
            $newUpdatesProvider = XWEB_NEWS::where('specific', '=', 'updates')->get();
            View::share([
                'newNewsProvider' => $newNewsProvider,
                'newEventsProvider' => $newEventsProvider,
                'newUpdatesProvider' => $newUpdatesProvider,
            ]);
        }
    }
}
