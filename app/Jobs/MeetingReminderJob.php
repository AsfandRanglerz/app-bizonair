<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\MeetingReminderEmail;
use Illuminate\Support\Facades\Mail;

class MeetingReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $member = null;
    public $meeting = null;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($member, $meeting)
    {
        $this->member = $member;
        $this->meeting = $meeting; 
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->member->email)->send(new MeetingReminderEmail($this->member, $this->meeting));
    }
}
