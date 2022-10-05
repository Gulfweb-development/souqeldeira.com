<?php

namespace App\Http\Livewire\Admin\Buildingstatus;

use App\Models\BuildingStatus;
use Livewire\Component;

class Show extends Component
{
    protected $listeners = [
        'delete'
    ];
    public $buildingstatus;


    public function mount(BuildingStatus $buildingstatus)
    {
        $this->buildingstatus = $buildingstatus->load('admin');
    }
    public function delete($id)
    {
        $this->buildingstatus->delete();
        session()->flash('success', __('app.data_deleted'));
        return redirect()->route('admin.buildingstatus.index');
    }

    public function render()
    {
        return view('livewire.admin.buildingstatus.show')->layout(ADMIN_LAYOUT);
    }
}
