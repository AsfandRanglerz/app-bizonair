<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompanyRemoveUserGroup extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $usercompany;
    public function __construct($usercompany)
    {
        $this->usercompany = $usercompany;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.company_remove_user_from_group')
                                ->with('usercompany',$this->usercompany)
                                ->subject('User Removed From Company');
    }
}
