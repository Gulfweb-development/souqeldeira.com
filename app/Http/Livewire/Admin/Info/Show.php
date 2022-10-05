<?php

namespace App\Http\Livewire\Admin\Info;

use App\Models\Info;
use Livewire\Component;

class Show extends Component
{
    protected $listeners = [
        'delete'
    ];
    public $info;


    public function mount(Info $info)
    {
        permation('contact_info_view');
        $this->info = $info;
    }
    // public function delete($id)
    // {
    //     $this->info->delete();
    //     session()->flash('success', __('app.data_deleted'));
    //     return redirect()->route('admin.info.index');
    // }

    public function render()
    {
        return view('livewire.admin.info.show')->layout(ADMIN_LAYOUT);
    }
}
