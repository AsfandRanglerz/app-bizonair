<?php

namespace App\Mail;

use App\Invite;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteMemberEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $invite, $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invite, $user)
    {
        $this->invite = $invite;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Membership Invite From '.company_name($this->invite->company_id))
            ->markdown('emails.invite.template')->with([
                'ínvite' => $this->invite,
                'user' => $this->user
            ]);
    }
}
