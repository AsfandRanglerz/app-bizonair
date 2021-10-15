<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\ExpiryEmail;
use Illuminate\Support\Facades\Mail;
class ExpireDealEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deal expire notification through email';

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
        $memb = \App\BuySell::whereBetween('date_expire',
            [Carbon::now()->setTime(0,0)->format('Y-m-d H:i:s'),
                Carbon::now()->setTime(23,59,59)->format('Y-m-d H:i:s')])->get();
        foreach ($memb as $member) {
                $user = \App\User::where('id', $member->user_id)->first();
                $members = \App\BuySell::where('id',$member->id)->first();
                Mail::to($user->email)->send(new ExpiryEmail($members,$user));
        }

    }
}
