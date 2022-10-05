<?php

namespace App\Http\Livewire\Admin\Subscriptions;

use App\Models\Subscriptions as SubscriptionsModel;
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

    public function delete($id)
    {
        $ubscription = SubscriptionsModel::findOrFail($id);
        $ubscription->delete();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
    }

    public function render()
    {
        $lists = SubscriptionsModel::select('id', toLocale('name'),'status')->search($this->search)->latest()->paginate($this->show);

        return view('livewire.admin.subscriptions.index', [
            'lists' => $lists,
        ])->layout(ADMIN_LAYOUT);
    }
}
