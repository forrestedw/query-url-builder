<?php

namespace Forrestedw\QueryUrlBuilder\Test;


use Forrestedw\QueryUrlBuilder\QueryUrl;
use Forrestedw\QueryUrlBuilder\QueryUrlBuilderServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [QueryUrlBuilderServiceProvider::class];
    }

    /**
     * Load package alias
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'QueryUrl' => QueryUrl::class,
        ];
    }
}
