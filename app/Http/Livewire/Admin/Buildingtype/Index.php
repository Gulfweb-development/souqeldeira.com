<?php

namespace App\Http\Livewire\Admin\Buildingtype;

use Livewire\Component;
use App\Models\BuildingType;
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
        permation('building_type_view');
    }
    public function delete($id)
    {
        permation('building_type_delete');
        $buildingType = BuildingType::findOrFail($id);
        $buildingType->delete();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
    }

    public function render()
    {
        $buildingTypes = BuildingType::select('id', toLocale('name'))->search($this->search)->latest()->paginate($this->show);

        return view('livewire.admin.buildingtype.index', [
            'buildingTypes' => $buildingTypes,
        ])->layout(ADMIN_LAYOUT);
    }
}
