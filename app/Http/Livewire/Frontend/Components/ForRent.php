<?php

namespace App\Http\Livewire\Frontend\Components;

use App\Models\Ad;
use Livewire\Component;

class ForRent extends Component
{
    public $rentAds;

    public function mount()
    {
        $this->rentAds = Ad::with('region', 'images','governorate', 'buildingType')->select('id', 'type', 'is_approved', 'is_featured','region_id', 'price', 'title','phone','governorate_id', 'building_type_id' , 'created_at', 'views')->where('is_approved', 1)->where('type', 'RENT')->orderByDesc('is_featured')->inRandomOrder()->take(6)->get();
    }
    public function render()
    {
        return view('livewire.frontend.components.for-rent');
    }
}
