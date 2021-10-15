<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExpiryEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $members = null;
    public $user = null;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($members,$user)
    {
        $this->members = $members;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.expiry-deal.expire')
            ->with('members',$this->members)
            ->with('user',$this->user)
            ->subject('Deal Expired');
    }
}
