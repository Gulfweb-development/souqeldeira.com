<?php

namespace App\Http\Livewire\Frontend\Ads;

use App\Models\Ad;
use App\Models\Region;
use Livewire\Component;
use App\Models\Governorate;
use App\Models\BuildingType;
use App\Models\Favorite;
use App\Services\FavoritesService;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;

class AdsSearch extends Component
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

    public function updatedGovernorateId($value)
    {
        $this->regions = Region::select('id', 'governorate_id', toLocale('name'))->where('governorate_id', $value)->get();
        // EMIT TO FRONT TO SET DATA TO REGION DROPDOWN
        $this->emit('reinit-niceSelect');
        $this->emit('update-regions', $this->regions);
    }

    public function search()
    {
        $ads = Ad::with('region', 'images')->frontSearch($this->governorate_id, $this->region_id, $this->building_type_id, $this->type, $this->rooms_count, $this->bathrooms_count, $this->price_from, $this->price_to, $this->filter)->paginate(12);
        // TO REDIRECT FILTERED DATA
        session()->flash('ads', $ads);
        return redirect()->route('ads.search');
    }

    public function addToFavorite(Ad $ad)
    {
        // CHECK IF ADD ALREADY EXISTS
        $favoriteCount = Favorite::where('ad_id', $ad->id)->where('user_id', user()->id)->count();
        if ($favoriteCount > 0) {
            return $this->dispatchBrowserEvent('info', ['message' => __('app.ad_already_exists')]);
        }
        $service = new FavoritesService($ad);
        $service->addToFavorite();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_added_favorite')]);
    }


    public function deleteFromFavorite(Ad $ad)
    {
        $service = new FavoritesService($ad);
        $service->deleteFromFavorite();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted_favorite')]);
    }

    public function render()
    {
        $ads = Ad::query();
        if (Session::has('ads')) {
            $ads = Session::get('ads');
        } else {
            $ads->with('region', 'governorate', 'images', 'user', 'buildingType')->where('is_approved', 1)->latest();
            if ($this->filter == 'MOST_VIWED') {
                $ads->orderBy('views','DESC');
            } elseif ($this->filter == 'LOW_TO_HIGH') {
                $ads->orderBy('price', 'ASC');
            } elseif ($this->filter == 'HIGH_TO_LOW') {
                $ads->orderBy('price', 'DESC');
            } else {
                // $ads->paginate(12);
            }
            $ads = $ads->paginate(12);
        }
        // CHECK TOGGLE FAVORITE ICON BTWEEN DELETE AND ADD

        return view('livewire.frontend.ads.ads-search', [
            'ads' => $ads,
        ]);
    }
}
