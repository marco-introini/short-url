<?php

namespace App\Providers;

use Override;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    #[Override]
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::preventAccessingMissingAttributes(! $this->app->isProduction());
        Model::preventLazyLoading(! $this->app->isProduction());
    }
}
