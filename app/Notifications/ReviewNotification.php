<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReviewNotification extends Notification
{
    use Queueable;

    public $ad;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ad)
    {
        //
        $this->ad = $ad;
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
            // {{ route('ad.search', [toSlug($ad->translate('title')), $ad->id]) }}
            'route_en' => route('ad.search', [toSlug($this->ad->title_en), $this->ad->id]),
            'route_ar' => route('ad.search', [toSlug($this->ad->title_ar), $this->ad->id]),
            'type' => 'REVIEW',
            'id' => $this->ad->id,
            'title_en' => 'New Review To Your AD',
            'title_ar' => 'تقييم جديد لاعلانك',
        ];
    }
}
