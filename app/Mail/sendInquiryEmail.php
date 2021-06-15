<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendInquiryEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $name;
    public $prod_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$name,$prod_name)
    {
        //
        $this->data = $data;
        $this->name = $name;
        $this->prod_name = $prod_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.inquiry.inquiry')->subject('Inquiry Send Notification')->with([
            'data' => $this->data,'name' => $this->name,'prod_name' => $this->prod_name
        ]);
    }
}
