<?php


namespace Forrestedw\QueryUrlBuilder;


class QueryUrl
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
    public function sort(string $by)
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
     *
     * @return mixed
     */
    public function build()
    {
        $entities = ['%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D'];
        $replacements = ['!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]"];
        return request()->url() . '/?'. str_replace($entities, $replacements, http_build_query( (array) $this));
    }
}
