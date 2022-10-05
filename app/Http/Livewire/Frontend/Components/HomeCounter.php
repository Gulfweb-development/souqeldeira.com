<?php

namespace App\Http\Livewire\Frontend\Components;

use App\Models\Ad;
use App\Models\Setting;
use Livewire\Component;

class HomeCounter extends Component
{
    public $housesCount;
    public $visitsCount;

    public function mount()
    {
        $this->housesCount = Ad::count();
        $this->visitsCount = Setting::select('id', 'visits')->latest()->first()->visits;
    }
    public function render()
    {
        return view('livewire.frontend.components.home-counter');
    }
}
