<?php

namespace App\Http\Livewire\Profile\Subscripts;

use App\Models\Subscriptions;
use Livewire\Component;

class Index extends Component
{

    public function render()
    {
        $lists = Subscriptions::where('status',1)->get();
        return view('livewire.profile.subscriptions.index', [
            'lists' => $lists,
        ])->layout(PROFILE_LAYOUT);
    }
    
}
