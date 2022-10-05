<?php

namespace App\Http\Livewire\Admin\Governorate;

use Livewire\Component;
use App\Models\Governorate;

class Show extends Component
{
    protected $listeners = [
        'delete'
    ];
    public $governorate;


    public function mount(Governorate $governorate)
    {
        permation('governorate_view');
        $this->governorate = $governorate->load('images', 'admin');
    }
    public function delete($id)
    {
        $this->governorate->deleteFile();
        $this->governorate->delete();
        session()->flash('success', __('app.data_deleted'));
        return redirect()->route('admin.governorate.index');
    }

    public function render()
    {
        return view('livewire.admin.governorate.show')->layout(ADMIN_LAYOUT);
    }
}
