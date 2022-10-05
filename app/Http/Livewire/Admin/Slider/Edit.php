<?php

namespace App\Http\Livewire\Admin\Slider;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class Edit extends Component
{
    use WithFileUploads;
    public $state = [];
    public $slider;

    public function mount(Slider $slider)
    {
        $this->state = $slider->load('images')->toArray();
        $this->slider = $slider;
        $this->state['old_image'] = $this->slider->getFile();
    }

    public function update()
    {
        Validator::make($this->state, [
            'name_ar' => 'required|string|max:170',
            'name_en' => 'required|string|max:170',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ])->validate();
        $this->state['admin_id'] = admin()->id;
        $this->slider->update($this->state);
        if (toExists('image', $this->state)) {
            $this->slider->deleteFile();
            $this->slider->uploadFile($this->state['image']);
        }
        session()->flash('success', __('app.data_updated'));
        return redirect()->route('admin.slider.index');
    }


    public function render()
    {
        return view('livewire.admin.slider.edit')->layout(ADMIN_LAYOUT);
    }
}
