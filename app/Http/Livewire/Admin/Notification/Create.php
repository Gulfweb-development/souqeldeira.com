<?php

namespace App\Http\Livewire\Admin\Notification;

use App\Models\User;
use Livewire\Component;
use App\Models\UserMessage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AdminToUserTypeNotification;

class Create extends Component
{


    public $state = [
        'is_approved' => 1,
        'type' => 'USER',
    ];

    public function mount()
    {
        permation('notification_create');
    }
    public function store()
    {

        Validator::make($this->state, [
            'type' => 'required|in:ALL,USER,COMPANY',
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'message_en' => 'required|string',
            'message_ar' => 'required|string',
        ])->validate();
        // $validatedData['user_id'] = $this->user->id;
        if ($this->state['type'] == 'USER') {
            $users = User::where('type','USER')->get();
            if ($users->count() < 1) {
                dd('THIS USERS TYPE NOT FOUND');
            }
            foreach ($users as $user) {
                // COMMIT TRANSACTION
                $userMessage = UserMessage::create([
                    'user_id' => $user->id,
                    'title_en' => $this->state['title_en'],
                    'title_ar' => $this->state['title_ar'],
                    'message_en' => $this->state['message_en'],
                    'message_ar' => $this->state['message_ar'],
                ]);
                Notification::send($user, new AdminToUserTypeNotification($this->state, $userMessage));
            }
            $this->dispatchBrowserEvent('success', ['message' => __('app.message_sent')]);
            return  $this->reset();
        }elseif ($this->state['type'] == 'COMPANY') {
            $users = User::where('type', 'COMPANY')->get();
            if ($users->count() < 1) {
                dd('THIS USERS TYPE NOT FOUND');
            }
            foreach ($users as $user) {
                // COMMIT TRANSACTION
                $userMessage = UserMessage::create([
                    'user_id' => $user->id,
                    'title_en' => $this->state['title_en'],
                    'title_ar' => $this->state['title_ar'],
                    'message_en' => $this->state['message_en'],
                    'message_ar' => $this->state['message_ar'],
                ]);
                Notification::send($user, new AdminToUserTypeNotification($this->state, $userMessage));
            }
            $this->dispatchBrowserEvent('success', ['message' => __('app.message_sent')]);
            return  $this->reset();
        }else {
            $users = User::all();
            if ($users->count() < 1) {
                dd('THIS USERS TYPE NOT FOUND');
            }
            foreach ($users as $user) {
                // COMMIT TRANSACTION
                $userMessage = UserMessage::create([
                    'user_id' => $user->id,
                    'title_en' => $this->state['title_en'],
                    'title_ar' => $this->state['title_ar'],
                    'message_en' => $this->state['message_en'],
                    'message_ar' => $this->state['message_ar'],
                ]);
                Notification::send($user, new AdminToUserTypeNotification($this->state, $userMessage));
            }
            $this->dispatchBrowserEvent('success', ['message' => __('app.message_sent')]);
            return  $this->reset();
        }
        // $userMessage = UserMessage::create($validatedData);
        // SEND NOTIFICATION
        // Notification::send($this->user, new AdminToUserTypeNotificatioessage));
        // $this->dispatchBrowserEvent('success', ['message' => __('app.message_sent')]);
        // $this->reset();
    }
    public function render()
    {
        return view('livewire.admin.notification.create')->layout(ADMIN_LAYOUT);
    }


}
