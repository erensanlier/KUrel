<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Request extends Model
{

    use Notifiable;

    protected $guarded = [];

    public function routeNotificationForSlack($notification)
    {
        return 'https://hooks.slack.com/services/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';
    }
}
