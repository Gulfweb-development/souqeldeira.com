<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminToUserNotification extends Notification
{
    use Queueable;

    public $userMessage;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($userMessage)
    {
        //
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
            'title_en' => $this->userMessage->title_en,
            'title_ar' => $this->userMessage->title_ar,
            'message_en' => $this->userMessage->message_en,
            'message_ar' => $this->userMessage->message_ar,
        ];
    }
}
