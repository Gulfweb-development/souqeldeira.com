<?php

namespace App\Http\Livewire\Frontend\Ads;

use App\Models\Ad;
use App\Models\Region;
use App\Models\User;
use Livewire\Component;
use App\Models\Governorate;
use App\Models\BuildingType;
use App\Models\Favorite;
use App\Services\FavoritesService;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;
use Request;

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
    public $agency_id= null;
    public $agency= null;
    public $type;
    public $rooms_count;
    public $bathrooms_count;
    public $price_from;
    public $price_to;

    public function mount($agency_id = null ,$type = null)
    {
        $this->governorates = Governorate::select('id', toLocale('name'))->get();
        $this->buildingTypes = BuildingType::select('id', toLocale('name'))->get();
        $this->type = in_array(strtoupper($type) , ['EXCHANGE' , 'SALE','RENT'] ) ?  strtoupper($type) : null;
        if ( $agency_id != null ){
            $this->agency = User::companies()->findOrFail($agency_id);
            $this->agency_id = $this->agency->id;
        }
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
        $ads = Ad::with('region', 'images')->frontSearch($this->governorate_id, $this->region_id, $this->building_type_id, $this->type, $this->rooms_count, $this->bathrooms_count, $this->price_from, $this->price_to, $this->filter , $this->agency_id)->paginate(12);
        // TO REDIRECT FILTERED DATA
        session()->flash('ads', $ads);
        $regions = Region::select(toLocale('name'))->find($this->region_id);
        $buildingTypes = BuildingType::select(toLocale('name'))->find($this->building_type_id);
        if ( $regions !== null or $buildingTypes !== null or $this->type != null  ){
            $name = $this->type ? trans('app.'.strtolower($this->type)).' ' : '';
            $name .= $buildingTypes ? $buildingTypes['name_'.app()->getLocale()].' ' : '';
            $name .= $regions ? trans('app.in').' '.$regions['name_'.app()->getLocale()] : '';
        } else
            $name = trans('app.ads');

        session()->flash('ads_title', trim($name));
        if ( $this->agency != null )
            return redirect()->route('agency.ads' , [toSlug($this->agency->name),$this->agency->id]);
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
        if ( $this->type != null )
            $ads = $ads->where('type' , $this->type);
        if ( $this->agency_id != null )
            $ads = $ads->where('user_id' , $this->agency_id);
        if (Session::has('ads')) {
            $ads = Session::get('ads');
        } else {
            $ads->with('region', 'governorate', 'images', 'user', 'buildingType')->where('is_approved', 1)->orderByDesc('is_featured')->latest();
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
        $ads_title =  Session::has('ads_title') ? Session::get('ads_title') : ( $this->type ? trans('app.'.strtolower($this->type)) : trans('app.ads'));


        if ( $this->agency_id != null )
            $ads_title .= ' '. trans('app.created_by') .' '. $this->agency->name ;

        return view('livewire.frontend.ads.ads-search', [
            'ads' => $ads,
            'ads_title' => $ads_title,
        ]);
    }
}
