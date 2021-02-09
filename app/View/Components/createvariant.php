<?php

namespace App\View\Components;

use Illuminate\View\Component;

class createvariant extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $attribute;

    public function __construct($attribute)
    {
        $this->attribute=$attribute;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.createvariant');
    }
}
