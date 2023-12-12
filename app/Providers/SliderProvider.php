<?php

namespace App\Providers;

use App\Helpers\DatabaseHelper;
use App\Models\XWEB_SLIDERS;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SliderProvider extends ServiceProvider
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
        if (DatabaseHelper::isXWEBConnected() && Schema::connection('XWEB')->hasTable('XWEB_SLIDERS')) {
            $sliderProvider = XWEB_SLIDERS::get();
            View::share([
                'sliderProvider' => $sliderProvider,
            ]);
        }
    }
}
