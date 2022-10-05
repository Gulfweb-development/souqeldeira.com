<?php

namespace App\Http\Livewire\Admin\Client;

use App\Models\Client;
use Livewire\Component;

class Show extends Component
{
    protected $listeners = [
        'delete'
    ];
    public $client;


    public function mount(Client $client)
    {
        permation('client_view');
        $this->client = $client->load('images', 'admin');
    }
    public function delete($id)
    {
        permation('client_delete');
        $this->client->deleteFile();
        $this->client->delete();
        session()->flash('success', __('app.data_deleted'));
        return redirect()->route('admin.client.index');
    }

    public function render()
    {
        return view('livewire.admin.client.show')->layout(ADMIN_LAYOUT);
    }
}
