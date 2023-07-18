<?php

namespace App\Listeners\User;

use App\Events\User\MailApplyJobEvent;
use App\Mail\MailNotifyCV;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailApplyJobListener
{
    /**
     * Create the event listener.
     */

    /**
     * Handle the event.
     */
    public function handle(MailApplyJobEvent $event): void
    {
        $emailCompany = Job::query()->join('employer', 'employer.id', '=', 'job.employer_id')
            ->join('users', 'users.id', '=', 'employer.user_id')
            ->select('users.email as email')->first();
        $firstJob = Job::query()->find($event->id);
        $mailContents = [
            'job' => $firstJob
        ];
        Mail::to($emailCompany->email)->send(new MailNotifyCV($mailContents));
    }
}
