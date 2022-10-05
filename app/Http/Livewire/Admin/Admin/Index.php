<?php

namespace App\Http\Livewire\Admin\Admin;

use App\Models\Admin;
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



    public function delete(Admin $admin)
    {
        permation('admin_delete');
        $admin->deleteFile();
        $admin->delete();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
    }


    public function render()
    {
        permation('admin_view');
        $admins = Admin::with('images')->search($this->search)->latest()->paginate($this->show);

        return view('livewire.admin.admin.index', [
            'admins' => $admins,
        ])->layout(ADMIN_LAYOUT);
    }
}
