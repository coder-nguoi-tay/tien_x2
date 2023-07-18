<?php

namespace App\Listeners\User;

use App\Events\User\UserEvent;
use App\Mail\MailActiveUser;

use Illuminate\Support\Facades\Mail;

class UserListener
{
    /**
     * Create the event listener.
     */

    /**
     * Handle the event.
     */
    public function handle(UserEvent $event): void
    {
        $mailContents = [
            'link' => route('activeUser'),
            'email' => $event->email,
        ];
        Mail::to($event->email)->send(new MailActiveUser($mailContents));
    }
}
