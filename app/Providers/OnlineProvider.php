<?php

namespace App\Providers;

use App\Models\MEMB_STAT;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class OnlineProvider extends ServiceProvider
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
        if (Schema::hasTable('MEMB_STAT')) {
            $onlinePlayersProvider = MEMB_STAT::where('ConnectStat', 1)->count();
            View::share([
                'onlinePlayersProvider' => $onlinePlayersProvider,
            ]);
        }
    }
}
