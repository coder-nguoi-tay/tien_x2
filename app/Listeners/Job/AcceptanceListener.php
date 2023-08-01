<?php

namespace App\Listeners\Job;

use App\Events\Job\AcceptanceCvEvent;
use App\Mail\AaceptanceCv;
use App\Models\Company;
use Illuminate\Support\Facades\Mail;

class AcceptanceListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(AcceptanceCvEvent $event)
    {
        $company = Company::query()->find($event->company->id_company);
        $mailContents = [
            'employer' => $event->company->name,
            'id' => $company->id,
            'content' => $event->content,
        ];
        Mail::to($event->email)->send(new AaceptanceCv($mailContents));
    }
}
