<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $number;

    public function __construct($verification)
    {
        $this->number = $verification;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@bizonair.com', 'Bizonair')->markdown('emails.confirmation.template')->with([
            'url' => url('verify-otp/' . $this->number),'verification_code' =>  $this->number,
        ]);
    }
}
