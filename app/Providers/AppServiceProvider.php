<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator; // para produccion
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

 #   {
        //
  #  }
  /**
     * Bootstrap any application services.
     * 
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        $url->forceScheme('https');
    }

}

