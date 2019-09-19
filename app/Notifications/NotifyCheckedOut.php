<?php

namespace App\Notifications;

use App\Attendance;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;

class NotifyCheckedOut extends Notification
{
    public $attendance;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Attendance $attendance)
    {
        $this->attendance = $attendance;
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
            ->warning()
            ->content('Someone have checked out!')
            ->attachment(function ($attachment) {
                $attachment->title('Successful Check Out')
                    ->fields([
                        'User' => $this->attendance->user->name,
                        'Date' => $this->attendance->log->toFormattedDateString(),
                        'Time' => $this->attendance->log->toTimeString(),
                    ]);
            });
    }
}
