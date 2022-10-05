<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Setting;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Welcome extends Component
{
    public function mount()
    {
        Setting::latest()->first()->increment('visits');
    }

    public function render()
    {
        return view('livewire.frontend.welcome');
    }
}
