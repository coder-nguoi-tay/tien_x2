<?php

namespace App\Providers;

use App\Events\Job\JobApplyEvent;
use App\Events\User\MailApplyJobEvent;
use App\Events\User\UserEvent;
use App\Listeners\Job\JobApplyListener;
use App\Listeners\User\MailApplyJobListener;
use App\Listeners\User\UserListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserEvent::class => [
            UserListener::class,
        ],
        MailApplyJobEvent::class => [
            MailApplyJobListener::class,
        ],
        JobApplyEvent::class => [
            JobApplyListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
