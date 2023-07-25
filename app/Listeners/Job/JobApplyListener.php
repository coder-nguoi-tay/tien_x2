<?php

namespace App\Listeners\Job;

use App\Events\Job\JobApplyEvent;
use App\Mail\MailApplyJob;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class JobApplyListener
{
    /**
     * Create the event listener.
     */

    /**
     * Handle the event.
     */
    public function handle(JobApplyEvent $event): void
    {
        $mailContents = [
            'time' => Carbon::now(),
        ];
        Mail::to($event->email)->send(new MailApplyJob($mailContents));
    }
}
