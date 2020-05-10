<?php

namespace Forrestedw\QueryUrlBuilder;

use Illuminate\Support\ServiceProvider;

class QueryUrlBuilderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('query-url-builder', function ($app) {
            return new QueryUrlBuilder();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
