<?php

namespace App\Providers;

use App\Helpers\DatabaseHelper;
use App\Models\XWEB_TEMPLATE;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class TemplateProvider extends ServiceProvider
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
        if (DatabaseHelper::isXWEBConnected() && Schema::connection('XWEB')->hasTable('XWEB_TEMPLATE')) {
            $templateProvider = XWEB_TEMPLATE::first();
            View::share([
                'templateProvider' => $templateProvider,
            ]);
        }
    }
}
