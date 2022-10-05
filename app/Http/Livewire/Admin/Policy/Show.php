<?php

namespace App\Http\Livewire\Admin\Policy;

use App\Models\Policy;
use Livewire\Component;

class Show extends Component
{
    protected $listeners = [
        'delete'
    ];
    public $policy;


    public function mount(Policy $policy)
    {
        permation('policy_view');
        $this->policy = $policy->load('admin');
    }
    public function delete($id)
    {
        permation('policy_delete');
        $this->policy->delete();
        session()->flash('success', __('app.data_deleted'));
        return redirect()->route('admin.policy.index');
    }

    public function render()
    {
        return view('livewire.admin.policy.show')->layout(ADMIN_LAYOUT);
    }
}
