<?php

namespace App\Http\Livewire\Admin\Ad;

use App\Models\Ad;
use App\Models\Setting;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Agency;
use App\Models\Region;
use Livewire\Component;
use App\Models\Governorate;
use Illuminate\Support\Str;
use App\Models\BuildingType;
use Livewire\WithFileUploads;
use App\Models\BuildingStatus;
use Illuminate\Support\Facades\Validator;

class Create extends Component
{
    use WithFileUploads;

    public $state = [
        'is_approved' => 1,
        'is_featured' => 0,
    ];
    public $users = [];
    // public $agencies = [];
    public $governorates = [];
    public $regions = [];
    public $buildingTypes = [];
    // public $buildingStatuses = [];

    public function mount()
    {
        permation('ad_create');
        abort(404);
        $this->users = User::all();
        // $this->agencies = Agency::all();
        $this->governorates = Governorate::all();
        $this->buildingTypes = BuildingType::all();
        // $this->buildingStatuses = BuildingStatus::all();
    }
    public function updatedStateGovernorateId($value)
    {
        $this->regions = Region::select('id','governorate_id',toLocale('name'))->where('governorate_id',$value)->get();
    }

    public function store()
    {
        Validator::make($this->state, [
            'user_id' => 'required|exists:users,id',
            'region_id' => 'required|exists:regions,id',
            'governorate_id' => 'required|exists:governorates,id',
            // 'agency_id' => 'required|exists:agencies,id',
            'building_type_id' => 'required|exists:building_types,id',
            // 'building_status_id' => 'required|exists:building_statuses,id',
            'title_ar' => 'required|string|max:170',
            'title_en' => 'required|string|max:170',
            'text_ar' => 'required|string',
            'text_en' => 'required|string',
            'map_link' => 'nullable|string',
            'video_link' => 'nullable|string',
            'price' => 'required|numeric',
            'phone' => 'required|string|regex:' . phoneNumberFormat(),
            'distance' => 'required|numeric|min:1',
            'rooms_count' => 'required|numeric|min:1',
            'bathrooms_count' => 'required|numeric|min:1',
            'is_approved' => 'required|boolean',
            'is_featured' => 'required|boolean',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ])->validate();
        $this->state['code'] = Str::random(6);
        $this->state['archived_at'] = Carbon::now('UTC')->addDays(
            $this->state['is_featured'] == "1" ? Setting::get('expire_time_premium_adv', 15) : Setting::get('expire_time_adv', 15)
        )->format('Y-m-d H:i:s');
        $ad = Ad::create($this->state);
        if (toExists('image', $this->state)) {
            $ad->uploadFile($this->state['image']);
        }
        // PUBLISH TO TWITTER AND FACEBOOK AND INSTRGRAM
        session()->flash('success', __('app.data_created'));
        $this->reset();
        return redirect()->route('admin.ad.index');
    }
    public function render()
    {
        return view('livewire.admin.ad.create')->layout(ADMIN_LAYOUT);
    }
}
