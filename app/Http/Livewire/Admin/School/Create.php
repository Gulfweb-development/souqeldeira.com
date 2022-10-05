<?php

namespace App\Http\Livewire\Admin\School;

use App\Models\Region;
use App\Models\School;
use Livewire\Component;
use App\Models\Governorate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class Create extends Component
{

    use WithFileUploads;

    public $state = [];
    public $governorates = [];
    public $regions = [];

    public function mount()
    {
        permation('school_create');
        $this->governorates = Governorate::all();
    }
    public function updatedStateGovernorateId($value)
    {
        $this->regions = Region::select('id', 'governorate_id', toLocale('name'))->where('governorate_id', $value)->get();
    }

    public function store()
    {
        Validator::make($this->state, [
            'governorate_id' => 'required|exists:governorates,id',
            'region_id' => 'required|exists:regions,id',
            'title_ar' => 'required|string|max:170',
            'title_en' => 'required|string|max:170',
            'text_ar' => 'required|string',
            'text_en' => 'required|string',
            'map_link' => 'nullable|string',
            'phone' => 'required|string|regex:' . phoneNumberFormat(),
            'email' => 'required|email|max:170',
            'facebook' => 'required|string|max:170',
            'twitter' => 'required|string|max:170',
            'instagram' => 'required|string|max:170',
            'snapchat' => 'required|string|max:170',
            'youtube' => 'required|string|max:170',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ])->validate();
        $school = School::create($this->state);
        if (toExists('image', $this->state)) {
            $school->uploadFile($this->state['image']);
        }
        // PUBLISH TO TWITTER AND FACEBOOK AND INSTRGRAM
        session()->flash('success', __('app.data_created'));
        $this->reset();
        return redirect()->route('admin.school.index');
    }
    public function render()
    {
        return view('livewire.admin.school.create')->layout(ADMIN_LAYOUT);
    }


}
