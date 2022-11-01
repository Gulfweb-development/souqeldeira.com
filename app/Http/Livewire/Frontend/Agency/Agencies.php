<?php

namespace App\Http\Livewire\Frontend\Agency;

use App\Models\Ad;
use App\Models\Report;
use App\Models\User;
use App\Models\Region;
use Livewire\Component;
use App\Models\Governorate;
use App\Models\BuildingType;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;

class Agencies extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $governorates = [];
    public $filter;
    public $regions = [];
    public $buildingTypes = [];
    public $governorate_id;
    public $region_id;
    public $building_type_id;
    public $type;
    public $rooms_count;
    public $bathrooms_count;
    public $price_from;
    public $price_to;

    public function mount()
    {
        $this->governorates = Governorate::select('id', toLocale('name'))->get();
        $this->buildingTypes = BuildingType::select('id', toLocale('name'))->get();
    }



    public function sendReport($Id)
    {
        Report::insert(User::companies()->findOrFail($Id));
        session()->flash('success', __('app.reportSent'));
        $this->dispatchBrowserEvent('success', ['message' => __('app.reportSent')]);
    }




    public function render()
    {
        $users = User::companies()->paginate(PG);
        return view('livewire.frontend.agency.agencies', [
            'users' => $users,
        ]);
    }
}
