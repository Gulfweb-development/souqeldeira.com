<?php

namespace App\Http\Livewire\Profile\Contactuser;

use App\Models\Agency;
use App\Models\ContactUser;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function delete($contactUserId)
    {
        $contactUser = ContactUser::where('id', $contactUserId)->where('user_to', user()->id)->firstOrFail();
        $contactUser->delete();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
    }



    public function render()
    {
        $messages = ContactUser::with('user')->where('user_to',user()->id)->latest()->paginate(PG);
        return view('livewire.profile.contactuser.index', [
            'messages' => $messages,
        ])->layout(PROFILE_LAYOUT);
    }
}
