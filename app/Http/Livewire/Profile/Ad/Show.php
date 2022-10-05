<?php

namespace App\Http\Livewire\Profile\Ad;

use App\Models\Ad;
use Livewire\Component;

class Show extends Component
{
    public $ad;
    public function mount(Ad $ad)
    {
        $this->ad = Ad::with('images')->where('user_id',user()->id)->where('id',$ad->id)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.profile.ad.show')->layout(PROFILE_LAYOUT);
    }
}
