<?php

namespace App\Http\Livewire\Admin\Agency;

use App\Models\Agency;
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
        permation('agency_view');
    }

    public function delete($id)
    {
        permation('agency_delete');
        $agency = Agency::findOrFail($id);
        $agency->delete();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
    }

    public function render()
    {
        $agencies = Agency::select('id', 'is_featured', 'user_id', toLocale('name'))->with('user', 'images')->search($this->search)->latest()->paginate($this->show);

        return view('livewire.admin.agency.index', [
            'agencies' => $agencies,
        ])->layout(ADMIN_LAYOUT);
    }
}
