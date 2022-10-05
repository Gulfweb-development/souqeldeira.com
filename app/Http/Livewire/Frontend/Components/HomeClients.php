<?php

namespace App\Http\Livewire\Frontend\Components;

use App\Models\Client;
use Livewire\Component;

class HomeClients extends Component
{
    public $clients;
    public function mount()
    {
      $this->clients = Client::with('images')->get();
    }
    public function render()
    {
        return view('livewire.frontend.components.home-clients');
    }
}
