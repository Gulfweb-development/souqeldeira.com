<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Setting;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Welcome extends Component
{
    public $setting;

    public function mount()
    {
        Setting::latest()->first()->increment('visits');
        $this->setting = Setting::select('id',toLocale('title'),toLocale('description'))->latest()->first();
    }

    public function render()
    {
        return view('livewire.frontend.welcome');
    }
}
