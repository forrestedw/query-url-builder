<?php

namespace Forrestedw\QueryUrlBuilder;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Sort extends Component
{
    public $sortAttribute, $sortDisplay;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $sort)
    {
        $this->sortAttribute = Str::snake($sort);
        $this->sortDisplay = $sort;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('forrestedw::components.sort', [
            'sortAttribute' => $this->sortAttribute,
            'sortDisplay' => $this->sortDisplay
        ]);
    }
}
