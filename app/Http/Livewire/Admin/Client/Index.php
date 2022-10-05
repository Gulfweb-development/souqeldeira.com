<?php

namespace App\Http\Livewire\Admin\Client;

use App\Models\Client;
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
        permation('client_view');
    }
    public function delete(Client $client)
    {
        $client->deleteFile();
        $client->delete();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
    }

    public function render()
    {
        $clients = Client::select('id')->with('images')->latest()->paginate($this->show);

        return view('livewire.admin.client.index', [
            'clients' => $clients,
        ])->layout(ADMIN_LAYOUT);
    }
}
