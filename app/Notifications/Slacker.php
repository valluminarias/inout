<?php
namespace App\Notifications;

use Illuminate\Notifications\Notifiable;

class Slacker
{

    use Notifiable;

    public function routeNotificationForSlack($notification)
    {
        return env('SLACK_WEBHOOK');
    }


}