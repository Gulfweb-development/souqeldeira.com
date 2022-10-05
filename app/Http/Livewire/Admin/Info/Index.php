<?php

namespace App\Http\Livewire\Admin\Info;

use App\Models\Info;
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
        permation('contact_info_view');
    }
    // public function delete(Info $info)
    // {
    //     $info->delete();
    //     $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
    // }

    public function render()
    {
        $infos = Info::latest()->paginate($this->show);

        return view('livewire.admin.info.index', [
            'infos' => $infos,
        ])->layout(ADMIN_LAYOUT);
    }
}
