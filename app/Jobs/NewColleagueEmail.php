<?php

namespace App\Jobs;

use App\User;
use App\Mail\NewColleagueRegistered;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class NewColleagueEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 600;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    protected $newUser;

    protected $teamsEmails;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($newUser, $teamsEmails)
    {
        $this->newUser = $newUser;
        $this->teamsEmails = $teamsEmails;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Mail::to($this->teamsEmails)->send(new NewColleagueRegistered($this->newUser));
    }
}
