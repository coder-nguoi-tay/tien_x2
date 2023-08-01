<?php

namespace App\Listeners\Job;

use App\Events\Job\JobApplyEvent;
use App\Mail\MailApplyJob;
use App\Models\Company;
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
        $company = Company::query()->find($event->employer->id_company);
        $mailContents = [
            'employer' => $event->employer->name,
            'id' => $company->id,
        ];
        Mail::to($event->email)->send(new MailApplyJob($mailContents));
    }
}
