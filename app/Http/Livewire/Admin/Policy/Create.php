<?php

namespace App\Http\Livewire\Admin\Policy;

use App\Models\Policy;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class Create extends Component
{

    public $state = [];
    public function mount()
    {
        permation('policy_create');
    }
    public function store()
    {
        Validator::make($this->state, [
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
        ])->validate();
        $this->state['admin_id'] = admin()->id;
        Policy::create($this->state);

        session()->flash('success', __('app.data_created'));
        $this->reset();
        return redirect()->route('admin.policy.index');
    }
    public function render()
    {
        return view('livewire.admin.policy.create')->layout(ADMIN_LAYOUT);
    }
}
