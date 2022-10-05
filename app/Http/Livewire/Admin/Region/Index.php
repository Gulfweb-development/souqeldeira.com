<?php

namespace App\Http\Livewire\Admin\Region;

use App\Models\Region;
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
        permation('region_view');
    }
    public function delete($id)
    {
        permation('region_delete');
        $region = Region::findOrFail($id);
        $region->delete();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
    }

    public function render()
    {
        $regions = Region::select('id', 'governorate_id', toLocale('name'))->with('governorate')->search($this->search)->latest()->paginate($this->show);

        return view('livewire.admin.region.index', [
            'regions' => $regions,
        ])->layout(ADMIN_LAYOUT);
    }
}
