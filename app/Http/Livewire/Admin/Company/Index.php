<?php

namespace App\Http\Livewire\Admin\Company;

use App\Models\User;
use App\Models\Company;
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

    public function delete(User $user)
    {
        $user->deleteFile();
        $user->delete();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
    }

    public function toggleApprove($isApproved, User $user)
    {
        $isApprovedReverseCurrentValue = $isApproved == 1 ? 0 : 1;
        $user->update([
            'is_approved' => $isApprovedReverseCurrentValue,
        ]);
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_updated')]);
    }

    public function render()
    {
        $users = User::select('id', 'name', 'email', 'phone', 'type', 'is_approved')->with('images')->searchCompany($this->search)->latest()->paginate($this->show);

        return view('livewire.admin.user.index', [
            'users' => $users,
        ])->layout(ADMIN_LAYOUT);
    }
}
