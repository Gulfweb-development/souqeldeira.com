<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use phpDocumentor\Reflection\Types\This;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'delete',
    ];

    public $search;
    public $show = 10;
    public $filterApproved = '';
    public $filterFeatured = '';
    public $type = '';


    public function mount()
    {
        permation('user_view');
    }
    public function delete(User $user)
    {
        permation('user_delete');
        $user->deleteFile();
        $user->delete();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
    }

    public function toggleApprove($isApproved,User $user)
    {
        permation('user_edit');
        $isApprovedReverseCurrentValue = $isApproved == 1 ? 0 : 1 ;
        $user->update([
            'is_approved' => $isApprovedReverseCurrentValue,
        ]);
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_updated')]);
    }
    public function toggleFeaturedActions($isFeatured,User $user)
    {
        $isFeaturedReverseCurrentValue = $isFeatured == 1 ? 0 : 1 ;
        $user->update([
            'is_featured' => $isFeaturedReverseCurrentValue,
        ]);
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_updated')]);
    }


    public function render()
    {
        $users = User::select('id', 'name','email','phone','type','is_approved','is_featured')->with('images')->search($this->search, $this->filterApproved, $this->filterFeatured,$this->type)->latest()->paginate($this->show);

        return view('livewire.admin.user.index', [
            'users' => $users,
        ])->layout(ADMIN_LAYOUT);
    }
}
