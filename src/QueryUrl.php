<?php

namespace Forrestedw\QueryUrlBuilder;

use Illuminate\Support\Facades\Facade;

/**
 * @method static QueryUrlBuilder filter(string $filter)
 * @method static QueryUrlBuilder removeFilter(string $filter)
 * @method static QueryUrlBuilder hasFilter(string $filter)
 * @method static QueryUrlBuilder setFilter(string $filter, $value)
 * @method static QueryUrlBuilder sortBy(string $by)
 * @method static QueryUrlBuilder removeSort()
 * @method static QueryUrlBuilder reverseSort()
 * @method static string build()
 */
class QueryUrl extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'query-url-builder';
    }
}
