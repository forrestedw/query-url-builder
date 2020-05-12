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
        $this->app->bind(QueryUrlBuilder::class, function ($app) {
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
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        $this->loadViewsFrom(__DIR__.'/resources/views', 'forrestedw');

        $this->loadViewComponentsAs('queryUrl', [
            Sort::class,
            BoolFilter::class,
        ]);
    }
}
