<?php

namespace App\Http\Livewire\Profile\Layouts;

use App\Models\Setting;
use Livewire\Component;

class Footer extends Component
{
    public $setting;

    public function mount()
    {
        $this->setting = Setting::latest()->first();
    }

    public function render()
    {
        return view('livewire.profile.layouts.footer');
    }
}
