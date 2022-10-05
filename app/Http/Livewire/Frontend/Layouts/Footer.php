<?php

namespace App\Http\Livewire\Frontend\Layouts;

use App\Models\Setting;
use Livewire\Component;

class Footer extends Component
{
    public $setting;

    public function mount()
    {
        $this->setting = Setting::select('id','facebook','twitter','instagram','youtube',)->latest()->first();
    }

    public function render()
    {
        return view('livewire.frontend.layouts.footer');
    }
}
