<?php

namespace App\Http\Livewire\Admin\Slider;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'delete',
    ];

    public $search;
    public $show = 10;

    public function delete($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->deleteFile();
        $slider->delete();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
    }

    public function render()
    {
        $sliders = Slider::select('id', toLocale('name'))->with('images')->search($this->search)->latest()->paginate($this->show);

        return view('livewire.admin.slider.index', [
            'sliders' => $sliders,
        ])->layout(ADMIN_LAYOUT);
    }
}
