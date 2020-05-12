<?php

namespace Forrestedw\QueryUrlBuilder;

use Illuminate\View\Component;

class Sort extends Component
{
    /**
     * The attribute to be sorted
     * @var
     */
    public $sort;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $sort)
    {
        $this->sort = $sort;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('forrestedw::components.sort');
    }
}
