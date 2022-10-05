<?php

namespace App\Http\Livewire\Admin\Client;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class Create extends Component
{
    use WithFileUploads;

    public $state = [];
    public function mount()
    {
        permation('client_create');
    }
    public function store()
    {

        Validator::make($this->state, [
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ])->validate();
        $this->state['admin_id'] = admin()->id;
        $this->state['name_ar'] = 'name_ar text';
        $this->state['name_en'] = 'name_en text';
        $client = Client::create($this->state);
        if (toExists('image', $this->state)) {
            $client->uploadFile($this->state['image']);
        }
        session()->flash('success', __('app.data_created'));
        $this->reset();
        return redirect()->route('admin.client.index');
    }
    public function render()
    {
        return view('livewire.admin.client.create')->layout(ADMIN_LAYOUT);
    }
}
