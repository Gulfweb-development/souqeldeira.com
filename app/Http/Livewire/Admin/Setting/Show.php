<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Setting;
use Livewire\Component;

class Show extends Component
{
    protected $listeners = [
        'delete'
    ];
    public $setting;


    public function mount(Setting $setting)
    {
        permation('setting_view');
        $this->setting = $setting->load('admin');
    }
    // public function delete($id)
    // {
    //     $this->setting->delete();
    //     session()->flash('success', __('app.data_deleted'));
    //     return redirect()->route('admin.setting.index');
    // }

    public function render()
    {
        return view('livewire.admin.setting.show')->layout(ADMIN_LAYOUT);
    }
}
