<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RequestTaken extends Notification
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

    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {


        return (new SlackMessage)
            ->error()
            ->content('This request has been taken by ' . $notifiable->taken_by.'!')
            ->attachment(function ($attachment) use ($notifiable) {
                $attachment->title('Request Information (ID: ' . $notifiable->id . ')')
                    ->fields([
                        'E-Mail' => $notifiable->email,
                        'Course' => $notifiable->course,
                        'Reason' => $notifiable->reason,
                        'Time' => $notifiable->startTime,
                        'Notes' => $notifiable->notes,
                        'Taken By' => $notifiable->taken_by,
                    ]);

            });
    }
}
