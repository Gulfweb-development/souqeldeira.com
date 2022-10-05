<?php

namespace App\Http\Livewire\Admin\Role;

use App\Models\Role;
use Livewire\Component;

class Show extends Component
{
    protected $listeners = [
        'delete'
    ];
    public $role;


    public function mount(Role $role)
    {
        permation('role_view');
        // $this->role = $role->load('permations');
        $this->role = $role;
    }
    public function delete($id)
    {
        permation('role_delete');
        $this->role->delete();
        session()->flash('success', __('app.data_deleted'));
        return redirect()->route('admin.role.index');
    }

    public function render()
    {
        return view('livewire.admin.role.show')->layout(ADMIN_LAYOUT);
    }
}
