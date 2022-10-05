<?php

namespace App\Http\Livewire\Profile\Agency;

use App\Models\Agency;
use Livewire\Component;

class Show extends Component
{

    public $agency;
    public function mount(Agency $agency)
    {
        abort_unless(authApprovedUserCompany(), 403);
        $this->agency = Agency::with('images')->where('user_id', user()->id)->where('id', $agency->id)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.profile.agency.show')->layout(PROFILE_LAYOUT);
    }


}
