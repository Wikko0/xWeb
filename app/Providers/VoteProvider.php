<?php

namespace App\Providers;

use App\Models\XWEB_VOTE_PACKAGE;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class VoteProvider extends ServiceProvider
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
        if (Schema::connection('XWEB')->hasTable('XWEB_VOTE_PACKAGE')) {
            $voteProvider = XWEB_VOTE_PACKAGE::get();
            View::share([
                'voteProvider' => $voteProvider,
            ]);
        }
    }
}
