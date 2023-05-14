<?php

namespace App\Http\Livewire\Frontend\Components;

use App\Models\Ad;
use Carbon\Carbon;
use Livewire\Component;

class ForSale extends Component
{
    public $saleAds;

    public function mount()
    {
        $this->saleAds = Ad::with('region','images','buildingType','governorate')->select('id','type','is_approved','is_featured','region_id','price','title','building_type_id','phone','governorate_id', 'created_at', 'views')->where('is_approved',1)->where('type','SALE')->orderByDesc('is_featured')->inRandomOrder()->take(6)->get();
    }
    public function render()
    {
        return view('livewire.frontend.components.for-sale');
    }
}
