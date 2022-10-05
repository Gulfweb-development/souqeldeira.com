<?php

namespace App\Http\Livewire\Admin\Governorate;

use App\Models\Governorate;
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
        permation('governorate_view');
    }

    public function delete($id)
    {
        permation('governorate_delete');
        $governorate = Governorate::findOrFail($id);
        $governorate->deleteFile();
        $governorate->delete();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
    }

    public function render()
    {
        $governorates = Governorate::select('id',toLocale('name'))->with('images')->search($this->search)->latest()->paginate($this->show);

        return view('livewire.admin.governorate.index',[
            'governorates' => $governorates,
        ])->layout(ADMIN_LAYOUT);
    }
}
