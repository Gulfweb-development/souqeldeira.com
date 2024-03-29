<?php

namespace App\Http\Livewire\Profile\Ad;

use App\Models\Ad;
use App\Models\Region;
use App\Models\Setting;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Governorate;
use App\Models\BuildingType;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $ad;
    public $governorates = [];
    public $regions = [];
    public $buildingTypes = [];
    public $governorate_id;
    public $region_id;
    public $is_featured;
    public $building_type_id;
    public $image;
    public $type;
    public $phone;
    public $price;
    public $text;
    public $old_image;
    public $photo;

    public function mount(Ad $ad)
    {
        $this->ad = Ad::with('images')->where('user_id', user()->id)->where('id', $ad->id)->firstOrFail();
        $this->governorate_id = $this->ad->governorate_id;
        $this->region_id = $this->ad->region_id;
        $this->building_type_id = $this->ad->building_type_id;
        $this->type = $this->ad->type;
        $this->phone = $this->ad->phone;
        $this->is_featured = $this->ad->is_featured;
        $this->price = $this->ad->price;
        $this->text = $this->ad->text;
        $this->old_image = $this->ad->getFile();
        $this->regions = Region::all();
        $this->governorates = Governorate::select('id', toLocale('name'))->get();
        $this->buildingTypes = BuildingType::all();
    }

    public function updatedGovernorateId($value)
    {
        $this->regions = Region::select('id', 'governorate_id', toLocale('name'))->where('governorate_id', $value)->get();
    }

    public function upgrade()
    {
        if ( !  $this->ad->is_featured ) {
            $this->ad->update([
                'is_featured' => 1,
                'archived_at' => Carbon::now('UTC')->addDays(
                    $this->is_featured == "1" ? Setting::get('expire_time_premium_adv', 15) : Setting::get('expire_time_adv', 15)
                )->format('Y-m-d H:i:s')
            ]);
            $this->is_featured = 1;
            session()->flash('success', __('upgraded'));
            return redirect()->route('profile.ad.index');
        }
    }

    public function update()
    {

        $validatedData = $this->validate([
            'region_id' => 'required|exists:regions,id',
            //'governorate_id' => 'required|exists:governorates,id',
            'building_type_id' => 'required|exists:building_types,id',
            'text' => 'required|string',
            'price' => 'nullable|numeric',
            'phone' => 'required|string|regex:' . phoneNumberFormat(),
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        $toRegId = Region::select('id', 'governorate_id' , toLocale('name'))->where('id', $this->region_id)->firstOrFail();
        $toGovId = Governorate::select('id', toLocale('name'))->where('id', $toRegId->governorate_id )->firstOrFail();
        $this->governorate_id = $toGovId->id;
        $toBuidingTypeId = buildingType::select('id', toLocale('name'))->where('id', $this->building_type_id)->firstOrFail();
        $toType = $this->type == 'SALE' ? __('app.sale') : ( $this->type == 'EXCHANGE' ? __('app.exchange') : ($this->type == 'REQUEST' ? __('app.REQUEST') : __('app.rent')));
        $this->ad->update([
            'governorate_id' => $this->governorate_id,
            'region_id' => $this->region_id,
            'building_type_id' => $this->building_type_id,
            'title' => Ad::toTitle($toType, $toGovId->translate('name'), $toRegId->translate('name'), $toBuidingTypeId->translate('name')),
            'type' => $this->type,
            'phone' => $this->phone,
            'price' => $this->price,
            'text' => $this->text,
            'is_approved' => 1,
        ]);
        if ($this->old_image == null ) {
            $this->ad->deleteFile();
            $this->old_image = null ;
        }
        if ($this->image != '') {
            $this->ad->deleteFile();
            $this->ad->uploadFile($this->image);
        }
        // PUBLISH TO TWITTER AND FACEBOOK AND INSTRGRAM
        session()->flash('success', __('app.data_updated'));
        return redirect()->route('profile.ad.index');
    }

    public function updatedPhoto()
    {
        $this->image = $this->photo;
    }

    public function render()
    {

        return view('livewire.profile.ad.edit')->layout(PROFILE_LAYOUT);
    }
}
