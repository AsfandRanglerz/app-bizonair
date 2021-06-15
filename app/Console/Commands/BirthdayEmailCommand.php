<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\BirthdayEmail;
use Illuminate\Support\Facades\Mail;

class BirthdayEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'birthday:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto birthday wishing through email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $members = \App\User::whereDay('birthday', now()->day)->whereMonth('birthday', now()->month)->get();
        foreach ($members as $member) {
            Mail::to($member->email)->send(new BirthdayEmail($member));
        }
    }
}
