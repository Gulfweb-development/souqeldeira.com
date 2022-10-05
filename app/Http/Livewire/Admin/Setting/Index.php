<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Setting;
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
    public function mount()
    {
        permation('setting_view');
    }
    // public function delete(Setting $setting)
    // {
    //     $setting->delete();
    //     $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
    // }

    public function render()
    {
        $settings = Setting::latest()->search($this->search)->paginate($this->show);

        return view('livewire.admin.setting.index', [
            'settings' => $settings,
        ])->layout(ADMIN_LAYOUT);
    }
}
