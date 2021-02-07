<?php

namespace App\View\Components;

use Illuminate\View\Component;

class createproduct extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $categories;
    public $menus;
    public function __construct($categories,$menus)
    {
        $this->categories=$categories;
        $this->menus=$menus;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.createproduct');
    }
}
