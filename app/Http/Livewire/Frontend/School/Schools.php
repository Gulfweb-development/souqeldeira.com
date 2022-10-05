<?php

namespace App\Http\Livewire\Frontend\School;

use App\Models\Region;
use App\Models\School;
use Livewire\Component;
use App\Models\Governorate;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;

class Schools extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $governorates = [];
    public $governorate_id;
    public $regions = [];
    public $region_id;
    public $filter;

    public function mount()
    {
        $this->governorates = Governorate::select('id', toLocale('name'))->get();
    }

    public function updatedGovernorateId($value)
    {
        $this->regions = Region::select('id', 'governorate_id', toLocale('name'))->where('governorate_id', $value)->get();
        // EMIT TO FRONT TO SET DATA TO REGION DROPDOWN
        $this->emit('reinit-niceSelect');
        $this->emit('update-regions', $this->regions);
    }

    public function search()
    {
        $schools = School::with('region', 'images')->frontSearch($this->governorate_id, $this->region_id)->paginate(12);
        // TO REDIRECT FILTERED DATA
        session()->flash('schools', $schools);
        return redirect()->route('schools');
    }


    public function render()
    {
        $schools = School::query();
        if (Session::has('schools')) {
            $schools = Session::get('schools');
        } else {
            $schools->with('region', 'governorate', 'images')->latest();
            $schools = $schools->paginate(12);
        }
        // CHECK TOGGLE FAVORITE ICON BTWEEN DELETE AND ADD

        return view('livewire.frontend.school.schools', [
            'schools' => $schools,
        ]);
    }

}
