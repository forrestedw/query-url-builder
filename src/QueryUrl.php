<?php

namespace Forrestedw\QueryUrlBuilder;

use Illuminate\Support\Facades\Facade;

class QueryUrl extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'query-url-builder';
    }
}
