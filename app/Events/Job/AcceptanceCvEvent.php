<?php

namespace App\Events\Job;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AcceptanceCvEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $email;
    public $company;
    public $content;
    public function __construct($email, $company, $content)
    {
        $this->email = $email;
        $this->company = $company;
        $this->content = $content;
    }
}
