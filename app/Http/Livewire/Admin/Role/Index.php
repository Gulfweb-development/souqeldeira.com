<?php

namespace App\Http\Livewire\Admin\Role;

use App\Models\Role;
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
        permation('role_delete');
        $role = Role::findOrFail($id);
        $role->delete();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
    }

    public function render()
    {
        permation('role_view');
        $roles = Role::search($this->search)->where('id','>',0)->latest()->paginate($this->show);

        return view('livewire.admin.role.index', [
            'roles' => $roles,
        ])->layout(ADMIN_LAYOUT);
    }
}
