<?php

namespace App\Http\Livewire\Admin\Ad;

use App\Models\Ad;
use App\Models\User;
use App\Models\Region;
use Livewire\Component;
use App\Models\Governorate;
use App\Models\BuildingType;
use Livewire\WithFileUploads;
use App\Models\BuildingStatus;
use Illuminate\Support\Facades\Validator;

class Edit extends Component
{
    use WithFileUploads;
    public $state = [];
    public $ad;
    public $users;
    // public $agencies;
    public $buildingTypes;
    // public $buildingStatuses;
    public $governorates = [];
    public $regions = [];

    public function mount(Ad $ad)
    {
        permation('ad_edit');
        $this->state = $ad->load('images')->toArray();
        $this->ad = $ad;
        $this->state['old_image'] = $this->ad->getFile();
        $this->governorates = Governorate::all();
        $this->regions = Region::all();
        $this->users = User::all();
        // $this->agencies = Agency::all();
        $this->buildingTypes = BuildingType::all();
        // $this->buildingStatuses = BuildingStatus::all();
    }

    public function update()
    {
        Validator::make($this->state, [
            'user_id' => 'required|exists:users,id',
            'governorate_id' => 'required|exists:governorates,id',
            'region_id' => 'required|exists:regions,id',
            'building_type_id' => 'required|exists:building_types,id',
            'title' => 'required|string|max:170',
            'text' => 'required|string',
            'phone' => 'required|string|regex:' . phoneNumberFormat(),
            'price' => 'nullable|numeric',
            'is_approved' => 'required|boolean',
            'is_featured' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ])->validate();
        $this->ad->update($this->state);
        if (toExists('image', $this->state)) {
            $this->ad->deleteFile();
            $this->ad->uploadFile($this->state['image']);
        }
        session()->flash('success', __('app.data_updated'));
        return redirect()->route('admin.ad.index');
    }


    public function render()
    {
        return view('livewire.admin.ad.edit')->layout(ADMIN_LAYOUT);
    }
}
