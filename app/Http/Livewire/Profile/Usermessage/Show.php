<?php

namespace App\Http\Livewire\Profile\Usermessage;

use App\Models\UserMessage;
use Livewire\Component;

class Show extends Component
{
    public $message;
    public function mount($userMessageId)
    {
        $this->message = UserMessage::where('id', $userMessageId)->firstOrFail();
        // MARK AS READ
        foreach (user()->unReadNotifications as $notification) {
            if ($notification->data['id'] == $userMessageId && $notification->data['type'] == 'FROM_ADMIN') {
                $notification->markAsRead();
            }
        }
    }

    public function render()
    {
        return view('livewire.profile.usermessage.show')->layout(PROFILE_LAYOUT);
    }
}
