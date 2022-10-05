<?php

namespace App\Http\Livewire\Admin\Admin;

use App\Models\Admin;
use Livewire\Component;

class Show extends Component
{
    protected $listeners = [
        'delete'
    ];
    public $admin;
    public $title_en;
    public $title_ar;
    public $message_en;
    public $message_ar;


    public function mount(Admin $admin)
    {
        permation('admin_view');
        $this->admin = $admin->load('images');
    }


    public function delete($id)
    {
        permation('admin_delete');
        $this->admin->deleteFile();
        $this->admin->delete();
        session()->flash('success', __('app.data_deleted'));
        return redirect()->route('admin.admin.index');
    }



    public function render()
    {
        return view('livewire.admin.admin.show')->layout(ADMIN_LAYOUT);
    }
}
