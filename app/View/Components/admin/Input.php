<?php

namespace App\View\Components\admin;

use Illuminate\View\Component;

class Input extends Component
{
    public $name;

    public $type;

    public $label;

    public $placeholder;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name , $type = '', $label = '', $placeholder = '')
    {
        $this->name = $name;
        $this->type = $type;
        $this->label = $label;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.input');
    }
}
