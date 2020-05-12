<?php

namespace Forrestedw\QueryUrlBuilder;

use Illuminate\View\Component;

class Search extends Component
{
    public $filter;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($filter)
    {
        $this->filter = $filter;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('forrestedw::components.search');
    }
}
