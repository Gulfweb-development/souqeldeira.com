<?php

namespace App\Http\Livewire\Profile\Profile;

use Livewire\Component;
use App\Models\Governorate;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    public $governorates;
    public $name;
    public $phone;
    // public $description_en;
    public $description;
    public $field;
    public $image;
    public $photo;
    public $governorate_ids = [];

    public function mount()
    {
        $this->name = user()->name;
        $this->phone = user()->phone;
        $this->field = user()->field;
        $this->description = user()->description;
        // $this->description_ar = user()->description_ar;
        $this->governorate_ids = user()->governorates->pluck('id');
        $this->governorates = Governorate::select('id', toLocale('name'))->get();
    }

    public function updatedPhoto()
    {
        $this->image = $this->photo;
    }

    public function delete()
    {
        user()->deleteFile();
        foreach (user()->ads as $ad){
            $ad->deleteFiles();
            $ad->delete();
        }
        user()->delete();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
        return redirect()->route('auth.logout');
    }


    public function update()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|min:3|max:100',
            'phone' => 'required|unique:users,phone,'.user()->id.'|regex:' . phoneNumberFormat(),
            'description' => 'required|string',
            // 'description_ar' => 'required|string',
            'field' => 'required|in:ALL,RENT,SALE,EXCHANGE,REQUEST',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        user()->update([
            'name' => $this->name,
            'phone' => $this->phone,
            'description' => $this->description,
            'description_ar' => $this->description,
            'description_en' => $this->description,
            'field' => $this->field,
        ]);
        user()->governorates()->sync($this->governorate_ids);
        if ($this->image != '') {
            user()->deleteFile();
            user()->uploadFile($this->image);
        }
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_updated')]);
    }
    public function render()
    {
        return view('livewire.profile.profile.profile')->layout(PROFILE_LAYOUT);
    }
}
