<?php

namespace Forrestedw\QueryUrlBuilder;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class BoolFilter extends Component
{
    public $filterAttribute, $filterDisplay;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($filter)
    {
        $this->filterAttribute = Str::snake($filter);
        $this->filterDisplay = $filter;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('forrestedw::components.bool-filter');
    }
}
