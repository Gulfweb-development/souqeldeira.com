<?php

namespace App\Http\Livewire\Admin\Governorate;

use Livewire\Component;
use App\Models\Governorate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class Edit extends Component
{
    use WithFileUploads;
    public $state = [];
    public $governorate;

    public function mount(Governorate $governorate)
    {
        permation('governorate_edit');
        $this->state = $governorate->load('images')->toArray();
        $this->governorate = $governorate;
        $this->state['old_image'] = $this->governorate->getFile();
    }

    public function update()
    {
        Validator::make($this->state, [
            'name_ar' => 'required|string|max:170',
            'name_en' => 'required|string|max:170',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ])->validate();
        $this->state['admin_id'] = admin()->id;
        $this->governorate->update($this->state);
        if (toExists('image', $this->state)) {
            $this->governorate->deleteFile();
            $this->governorate->uploadFile($this->state['image']);
        }
        session()->flash('success', __('app.data_updated'));
        return redirect()->route('admin.governorate.index');
    }


    public function render()
    {
        return view('livewire.admin.governorate.edit')->layout(ADMIN_LAYOUT);
    }
}
