<?php

namespace App\Http\Livewire\Profile\Usermessage;

use Livewire\Component;
use App\Models\UserMessage;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function delete($userMessageId)
    {
        $userMessage = UserMessage::query()->where('user_id', user()->id)->where('id', $userMessageId)->firstOrFail();
        $userMessage->delete();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
    }



    public function render()
    {
        $messages = UserMessage::query()->where('user_id', user()->id)->latest()->paginate(PG);
        return view('livewire.profile.usermessage.index', [
            'messages' => $messages,
        ])->layout(PROFILE_LAYOUT);
    }
}
