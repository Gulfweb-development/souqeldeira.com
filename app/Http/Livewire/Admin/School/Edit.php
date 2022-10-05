<?php

namespace App\Http\Livewire\Admin\School;

use App\Models\Region;
use App\Models\School;
use Livewire\Component;
use App\Models\Governorate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class Edit extends Component
{
    use WithFileUploads;
    public $state = [];
    public $school;
    public $governorates = [];
    public $regions = [];

    public function mount(School $school)
    {
        permation('school_edit');
        $this->state = $school->load('images')->toArray();
        $this->school = $school;
        $this->state['old_image'] = $this->school->getFile();
        $this->governorates = Governorate::all();
        $this->regions = Region::all();
    }

    public function update()
    {
        Validator::make($this->state, [
            'governorate_id' => 'required|exists:governorates,id',
            'region_id' => 'required|exists:regions,id',
            'title_ar' => 'required|string|max:170',
            'title_en' => 'required|string|max:170',
            'text_ar' => 'required|string',
            'text_en' => 'required|string',
            'phone' => 'required|string|regex:' . phoneNumberFormat(),
            'email' => 'required|email',
            'facebook' => 'required|string',
            'twitter' => 'required|string',
            'instagram' => 'required|string',
            'snapchat' => 'required|string',
            'youtube' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ])->validate();
        $this->school->update($this->state);
        if (toExists('image', $this->state)) {
            $this->school->deleteFile();
            $this->school->uploadFile($this->state['image']);
        }
        session()->flash('success', __('app.data_updated'));
        return redirect()->route('admin.school.index');
    }


    public function render()
    {
        return view('livewire.admin.school.edit')->layout(ADMIN_LAYOUT);
    }
}
