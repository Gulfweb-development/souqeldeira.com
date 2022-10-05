<?php

namespace App\Http\Livewire\Admin\Policy;

use App\Models\Policy;
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
        permation('policy_view');
    }
    public function delete(Policy $policy)
    {
        permation('policy_delete');
        $policy->delete();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
    }

    public function render()
    {
        $policies = Policy::select('id', toLocale('name'))->search($this->search)->latest()->paginate($this->show);

        return view('livewire.admin.policy.index', [
            'policies' => $policies,
        ])->layout(ADMIN_LAYOUT);
    }
}
