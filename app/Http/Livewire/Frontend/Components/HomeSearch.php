<?php

namespace App\Http\Livewire\Frontend\Components;

use regions;
use App\Models\Ad;
use App\Models\Region;
use Livewire\Component;
use App\Models\Governorate;
use App\Models\BuildingType;

class HomeSearch extends Component
{
    public $governorates = [];
    public $regions = [];
    public $buildingTypes = [];
    public $governorate_id;
    public $region_id;
    public $building_type_id;
    public $type;
    public $price_from;
    public $price_to;

    public function mount()
    {
        $this->governorates = Governorate::select('id', toLocale('name'))->get();
        $this->buildingTypes = BuildingType::select('id', toLocale('name'))->get();
    }
    public function updatedGovernorateId($value)
    {
        $this->regions = Region::select('id', 'governorate_id', toLocale('name'))->where('governorate_id',$value)->get();
        // EMIT TO FRONT TO SET DATA TO REGION DROPDOWN
        $this->emit('reinit-niceSelect');
        $this->emit('update-regions',$this->regions);
    }

    public function search()
    {
        $ads = Ad::with('region', 'images')->frontSearch($this->governorate_id,$this->region_id,$this->building_type_id,$this->type,$this->price_from,$this->price_to)->paginate(12);
        // TO REDIRECT FILTERED DATA
        session()->flash('ads', $ads);
        $regions = Region::select(toLocale('name'))->find($this->region_id);
        $buildingTypes = BuildingType::select(toLocale('name'))->find($this->building_type_id);
        if ( $regions !== null or $buildingTypes !== null or $this->type != null ){
            $name = $this->type ? trans('app.'.strtolower($this->type)).' ' : '';
            $name .= $buildingTypes ? $buildingTypes['name_'.app()->getLocale()].' ' : '';
            $name .= $regions ? trans('app.in').' '.$regions['name_'.app()->getLocale()] : '';
        } else
            $name = trans('app.ads');

        session()->flash('ads_title', trim($name));
        return redirect()->route('ads.search');
    }

    // public function dehydrate()
    // {
    //     $this->emit('reinit-niceSelect');
    // }

    public function render()
    {
        return view('livewire.frontend.components.home-search');
    }
}
