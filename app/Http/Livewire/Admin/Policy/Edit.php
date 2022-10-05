<?php

namespace App\Http\Livewire\Admin\Policy;

use App\Models\Policy;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class Edit extends Component
{
    public $state = [];
    public $policy;

    public function mount(Policy $policy)
    {
        permation('policy_edit');
        $this->state = $policy->toArray();
        $this->policy = $policy;
    }

    public function update()
    {
        Validator::make($this->state, [
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
        ])->validate();
        $this->state['admin_id'] = admin()->id;
        $this->policy->update($this->state);
        session()->flash('success', __('app.data_updated'));
        return redirect()->route('admin.policy.index');
    }


    public function render()
    {
        return view('livewire.admin.policy.edit')->layout(ADMIN_LAYOUT);
    }
}
