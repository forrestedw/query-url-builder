<?php


namespace Forrestedw\QueryUrlBuilder;


use Illuminate\Support\Facades\Route;

class QueryUrlBuilder
{
    /**
     * The query's filter value(s)
     * @var array|null
     */
    public $filter;

    /**
     * The attribute to sort by.
     * @var
     */
    public $sort;

    /**
     * The url to use build url on.
     * @var string
     */
    public $url;

    public function __construct()
    {
        $query = request()->query();
        $this->sort = $query['sort'] ?? null;
        $this->filter = $query['filter'] ?? null;
    }

    /**
     * The value of a filter in the query.
     *
     * @param $filter
     * @return bool
     */
    public function filter($filter)
    {
        $value = $this->filter[$filter];

        if($value == '1' || $value == '0') {
            return (boolean)$value;
        }
        return $value;
    }

    /**
     * Remove a filter from the query.
     *
     * @param $filter
     * @return $this
     */
    public function removeFilter($filter)
    {
        unset($this->filter[$filter]);

        return $this;
    }

    /**
     * Whether a query has a given filter.
     *
     * @param string $filter
     * @return bool
     */
    public function hasFilter(string $filter) : bool
    {
        if(! $this->filter) {
            return false;
        }
        if(array_key_exists($filter, $this->filter)) {
            return true;
        }
        return false;
    }

    /**
     * Sets a custom url to apply filters on.
     *
     * @param string $urlOrNamedRoute
     * @param array|int|string $namedRouteParams
     *
     * @return $this
     */
    public function forUrl(string $urlOrNamedRoute, $namedRouteParams = [])
    {
        $this->url = url($urlOrNamedRoute);

        if(Route::has($urlOrNamedRoute)){
            $this->url = route($urlOrNamedRoute, (array)$namedRouteParams);
        }

        return $this;
    }

    /**
     * Set the value of a filter.
     *
     * @param $filter
     * @param $value
     * @return $this
     */
    public function setFilter($filter, $value)
    {
        $this->filter[$filter] = $value;

        return $this;
    }

    /**
     * The attribute to sort by.
     *
     * @param string $by
     * @return $this
     */
    public function sortBy(string $by)
    {
        $this->sort = $by;

        return $this;
    }

    public function removeSort()
    {
        $this->sort = null;

        return $this;
    }
    /**
     * Reverse the order of a sort/
     *
     * @return $this
     */
    public function reserveSort()
    {
        if($this->sort[0] === '-') {
            $this->sort = str_replace('-', '', $this->sort);
        }
        $this->sort = '-' . $this->sort;

        return $this;
    }

    /**
     * Adds multiple filters to the query.
     *
     * @param array $filters
     *
     * @return $this
     */
    public function setFilters(array $filters)
    {
        if ($this->isAssociativeArray($filters)) {
            foreach ($filters as $key => $value) {
                $this->setFilter($key, $value);
            }
        } else {
            throw new \InvalidArgumentException('The filters you put user are not in correct format, use associative arrays');
        }

        return $this;
    }

    /**
     * Removes multiple filters from a query.
     *
     * @param $filters
     *
     * @return $this
     */
    public function removeFilters($filters)
    {
        if ($this->isAssociativeArray($filters)) {
            $filters = array_keys($filters);
        }

        foreach ($filters as $filter) {
            $this->removeFilter($filter);
        }

        return $this;
    }


        /**
     *
     * @return mixed
     */
    public function build()
    {
        $entities = ['%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D'];
        $replacements = ['!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]"];

        $queryData = (array) $this;
        if($this->url){
            unset($queryData['url']);
        }
        return ($this->url ?? request()->url()) . '?'. str_replace($entities, $replacements, http_build_query($queryData));
    }

    /**
     * Checks if array is of type associative or sequential.
     *
     * @param array $input
     *
     * @return bool
     */
    private function isAssociativeArray(array $input)
    {
        return array_keys($input) !== range(0, count($input) - 1);
    }
}
