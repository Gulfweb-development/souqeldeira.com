<?php

namespace App\Http\Livewire\Admin\Buildingstatus;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\BuildingStatus;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'delete',
    ];

    public $search;
    public $show = 10;

    public function delete(BuildingStatus $buildingstatus)
    {
        $buildingstatus->delete();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
    }

    public function render()
    {
        $buildingStatuses = BuildingStatus::select('id', toLocale('name'))->search($this->search)->latest()->paginate($this->show);

        return view('livewire.admin.buildingstatus.index', [
            'buildingStatuses' => $buildingStatuses,
        ])->layout(ADMIN_LAYOUT);
    }
}
