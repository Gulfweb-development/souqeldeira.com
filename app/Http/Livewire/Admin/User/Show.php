<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use App\Models\UserMessage;
use App\Notifications\AdminToUserNotification;
use Livewire\Component;
use Illuminate\Support\Facades\Notification;

class Show extends Component
{
    protected $listeners = [
        'delete'
    ];
    public $user;
    public $title_en;
    public $title_ar;
    public $message_en;
    public $message_ar;


    public function mount(User $user)
    {
        permation('user_view');
        $this->user = $user->load('images');
    }

    public function toggleApprove($isApproved, User $user)
    {
        permation('user_edit');
        $isApprovedReverseCurrentValue = $isApproved == 1 ? 0 : 1;
        $user->update([
            'is_approved' => $isApprovedReverseCurrentValue,
        ]);
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_updated')]);
        $this->user = $user->load('images');
    }
    public function delete($id)
    {
        permation('user_delete');
        $this->user->deleteFile();
        $this->user->delete();
        session()->flash('success', __('app.data_deleted'));
        return redirect()->route('admin.user.index');
    }

    public function sendNotification()
    {
        permation('notification_create');
        $validatedData = $this->validate([
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'message_en' => 'required|string',
            'message_ar' => 'required|string',
        ]);
        $validatedData['user_id'] = $this->user->id;
        $userMessage = UserMessage::create($validatedData);
        // SEND NOTIFICATION
        Notification::send($this->user, new AdminToUserNotification($userMessage));

        session()->flash('success', __('app.message_sent'));
        $this->dispatchBrowserEvent('success', ['message' => __('app.message_sent')]);
        $this->reset(['title_en','title_ar','message_en','message_ar']);
    }

    public function render()
    {
        return view('livewire.admin.user.show')->layout(ADMIN_LAYOUT);
    }
}
