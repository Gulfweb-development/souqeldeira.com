<?php

namespace App\Http\Livewire\Frontend\Policy;

use App\Models\Policy as PolicyModel;
use Livewire\Component;

class Policy extends Component
{
    public $policies;
    public function mount()
    {
      $this->policies = PolicyModel::all();
    }

    public function render()
    {
        return view('livewire.frontend.policy.policy');
    }
}
