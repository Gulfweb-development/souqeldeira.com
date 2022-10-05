<?php

namespace App\Http\Livewire\Admin\Agency;

use App\Models\Agency;
use Livewire\Component;

class Show extends Component
{
    protected $listeners = [
        'delete'
    ];
    public $agency;


    public function mount(Agency $agency)
    {
        permation('agency_view');
        $this->agency = $agency->load('images', 'user');
    }
    public function delete($id)
    {
        permation('agency_delete');
        $this->agency->deleteFile();
        $this->agency->delete();
        session()->flash('success', __('app.data_deleted'));
        return redirect()->route('admin.agency.index');
    }

    public function render()
    {
        return view('livewire.admin.agency.show')->layout(ADMIN_LAYOUT);
    }
}
