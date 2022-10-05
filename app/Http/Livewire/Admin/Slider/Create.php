<?php

namespace App\Http\Livewire\Admin\Slider;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class Create extends Component
{
    use WithFileUploads;

    public $state = [];

    public function store()
    {

        Validator::make($this->state, [
            'name_ar' => 'required|string|max:170',
            'name_en' => 'required|string|max:170',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ])->validate();
        $this->state['admin_id'] = admin()->id;
        $slider = Slider::create($this->state);
        if (toExists('image', $this->state)) {
            $slider->uploadFile($this->state['image']);
        }
        session()->flash('success', __('app.data_created'));
        $this->reset();
        return redirect()->route('admin.slider.index');
    }
    public function render()
    {
        return view('livewire.admin.slider.create')->layout(ADMIN_LAYOUT);
    }
}
