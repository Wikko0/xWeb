<?php

namespace App\Providers;

use App\Helpers\DatabaseHelper;
use App\Models\XWEB_CHARACTERS;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CharactersProvider extends ServiceProvider
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
        if (DatabaseHelper::isXWEBConnected() && Schema::connection('XWEB')->hasTable('XWEB_CHARACTERS')) {
            $charactersProvider = XWEB_CHARACTERS::get();
            View::share([
                'charactersProvider' => $charactersProvider,
            ]);
        }
    }
}
