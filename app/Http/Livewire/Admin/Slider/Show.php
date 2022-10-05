<?php

namespace App\Http\Livewire\Admin\Slider;

use App\Models\Slider;
use Livewire\Component;

class Show extends Component
{
    protected $listeners = [
        'delete'
    ];
    public $slider;


    public function mount(Slider $slider)
    {
        $this->slider = $slider->load('images', 'admin');
    }
    public function delete($id)
    {
        $this->slider->deleteFile();
        $this->slider->delete();
        session()->flash('success', __('app.data_deleted'));
        return redirect()->route('admin.slider.index');
    }

    public function render()
    {
        return view('livewire.admin.slider.show')->layout(ADMIN_LAYOUT);
    }
}
