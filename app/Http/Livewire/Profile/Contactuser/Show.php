<?php

namespace App\Http\Livewire\Profile\Contactuser;

use App\Models\ContactUser;
use Livewire\Component;

class Show extends Component
{
    public $message;
    public function mount($contactUserId)
    {

        $this->message = ContactUser::where('user_to', user()->id)->where('id', $contactUserId)->firstOrFail();
        // MARK AS READ
        foreach (user()->unReadNotifications as $notification) {
            if ($notification->data['id'] == $contactUserId && $notification->data['type'] == 'FROM_USER_AD') {
                $notification->markAsRead();
            }
        }
    }

    public function render()
    {
        return view('livewire.profile.contactuser.show')->layout(PROFILE_LAYOUT);
    }
}
