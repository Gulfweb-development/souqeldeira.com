<?php

namespace App\Http\Livewire\Frontend\Layouts;

use App\Models\Setting;
use Livewire\Component;

class Header extends Component
{
    public $setting;

    public function mount()
    {
      $this->setting = Setting::select('id',toLocale('title'),toLocale('description'))->latest()->first();
    }

    public function render()
    {
        return view('livewire.frontend.layouts.header');
    }
}
