<?php

namespace App\Http\Livewire\Admin\Client;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class Edit extends Component
{
    use WithFileUploads;
    public $state = [];
    public $client;

    public function mount(Client $client)
    {
        permation('client_edit');
        $this->state = $client->load('images')->toArray();
        $this->client = $client;
        $this->state['old_image'] = $this->client->getFile();
    }

    public function update()
    {
        Validator::make($this->state, [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ])->validate();
        $this->state['admin_id'] = admin()->id;
        $this->client->update($this->state);
        if (toExists('image', $this->state)) {
            $this->client->deleteFile();
            $this->client->uploadFile($this->state['image']);
        }
        session()->flash('success', __('app.data_updated'));
        return redirect()->route('admin.client.index');
    }


    public function render()
    {
        return view('livewire.admin.client.edit')->layout(ADMIN_LAYOUT);
    }
}
