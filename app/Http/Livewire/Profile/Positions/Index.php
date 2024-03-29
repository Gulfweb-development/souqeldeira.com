<?php

namespace App\Http\Livewire\Profile\Positions;

use App\Models\Position;
use App\Models\Setting;
use Livewire\Component;
use App\Models\Governorate;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{

    public function render()
    {
        $allPositions = collect(Setting::get('special_position'));
        $positions = $allPositions->except(Position::getActivePositionForBuy());
        $myPositions = Position::getMyActivePosition();
        return view('livewire.profile.positions.index' , compact('positions' , 'myPositions'))->layout(PROFILE_LAYOUT);
    }
}
