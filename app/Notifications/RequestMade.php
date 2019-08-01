<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RequestMade extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {


        return (new SlackMessage)
            ->success()
            ->content('New request has been made!')
            ->attachment(function ($attachment) use ($notifiable) {
                $attachment->title('Request Information (ID: ' . $notifiable->id . ')')
                    ->fields([
                        'E-Mail' => $notifiable->email,
                        'Course' => $notifiable->course,
                        'Reason' => $notifiable->reason,
                        'Time' => $notifiable->startTime,
                        'Notes' => $notifiable->notes,
                    ])
                    ->action('Take', route('request.take', ['request' => $notifiable->id]), $style = '');

            });
    }

}
