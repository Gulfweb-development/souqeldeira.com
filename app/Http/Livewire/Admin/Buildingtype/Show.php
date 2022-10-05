<?php

namespace App\Http\Livewire\Admin\Buildingtype;

use Livewire\Component;
use App\Models\BuildingType;

class Show extends Component
{
    protected $listeners = [
        'delete'
    ];
    public $buildingtype;


    public function mount(BuildingType $buildingtype)
    {
        permation('building_type_view');
        $this->buildingtype = $buildingtype->load('admin');
    }
    public function delete($id)
    {
        $this->buildingtype->delete();
        session()->flash('success', __('app.data_deleted'));
        return redirect()->route('admin.buildingtype.index');
    }

    public function render()
    {
        return view('livewire.admin.buildingtype.show')->layout(ADMIN_LAYOUT);
    }
}
