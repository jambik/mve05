<?php

namespace App\Providers;

use App\Http\Composers\FooterComposer;
use App\Http\Composers\SlidesComposer;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
//        $this->composeSlides();

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

//    public function composeSlides()
//    {
//        view()->composer('partials._slides', SlidesComposer::class);
//    }
}
