<?php

namespace App\View\Components\frontend;

use Illuminate\View\Component;

class Alerts extends Component
{
    public $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type = 'success')
    {
        //
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.alerts');
    }
}
