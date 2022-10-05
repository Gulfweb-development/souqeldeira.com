<?php

namespace App\Http\Livewire\Profile\Profile;

use Livewire\Component;

class Dashboard extends Component
{
    public $totalAds = 0;
    public $totalReveiws = 0;
    public function render()
    {
        $this->totalAds = user()->ads()->count();
        $this->totalReveiws = user()->comments()->count();
        return view('livewire.profile.profile.dashboard')->layout(PROFILE_LAYOUT);
    }
}
