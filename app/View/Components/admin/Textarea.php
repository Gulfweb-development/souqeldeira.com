<?php

namespace App\View\Components\admin;

use Illuminate\View\Component;

class Textarea extends Component
{
    public $name;

    public $placeholder;

    public $label;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $placeholder, $label)
    {
        //
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.textarea');
    }
}
