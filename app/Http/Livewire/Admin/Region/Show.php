<?php

namespace App\Http\Livewire\Admin\Region;

use App\Models\Region;
use Livewire\Component;

class Show extends Component
{
    protected $listeners = [
        'delete'
    ];
    public $region;


    public function mount(Region $region)
    {
        permation('region_view');
        $this->region = $region->load('admin', 'governorate');
    }
    public function delete($id)
    {
        $this->region->delete();
        session()->flash('success', __('app.data_deleted'));
        return redirect()->route('admin.region.index');
    }

    public function render()
    {
        return view('livewire.admin.region.show')->layout(ADMIN_LAYOUT);
    }
}
