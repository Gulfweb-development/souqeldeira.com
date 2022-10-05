<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminToUserTypeNotification extends Notification
{
    use Queueable;


    public $state;

    public $userMessage;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($state, $userMessage)
    {
        //
        $this->state = $state;
        $this->userMessage = $userMessage;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'route' => route('profile.user-message.show', [$this->userMessage->id]),
            'type' => 'FROM_ADMIN',
            'id' => $this->userMessage->id,
            'title_en' => $this->state['title_en'],
            'title_ar' => $this->state['title_ar'],
            'message_en' => $this->state['message_en'],
            'message_ar' => $this->state['message_ar'],
        ];
    }
}
