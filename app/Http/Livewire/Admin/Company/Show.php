<?php

namespace App\Http\Livewire\Admin\Company;

use App\Models\User;
use Livewire\Component;

class Show extends Component
{
    protected $listeners = [
        'delete'
    ];
    public $user;


    public function mount(User $user)
    {
        dd($user);
        $this->user = $user->load('images');
    }

    public function toggleApprove($isApproved, User $user)
    {
        $isApprovedReverseCurrentValue = $isApproved == 1 ? 0 : 1;
        $user->update([
            'is_approved' => $isApprovedReverseCurrentValue,
        ]);
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_updated')]);
        $this->user = $user->load('images');
    }
    public function delete($id)
    {
        $this->user->deleteFile();
        $this->user->delete();
        session()->flash('success', __('app.data_deleted'));
        return redirect()->route('admin.user.index');
    }

    public function render()
    {
        return view('livewire.admin.company.show')->layout(ADMIN_LAYOUT);
    }
}
