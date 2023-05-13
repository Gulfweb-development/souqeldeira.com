<?php

namespace App\View\Components\admin;

use Illuminate\View\Component;

class File extends Component
{
    public $name;

    public $label;

    public $image;

    public $oldImage;

    public $size;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name= '', $label= '', $image= '', $oldImage= '', $size = '')
    {
        //
        $this->name = $name;
        $this->label = $label;
        $this->image = $image;
        $this->oldImage = $oldImage;
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.file');
    }
}
