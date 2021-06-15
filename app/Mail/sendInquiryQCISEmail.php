<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendInquiryQCISEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $name;
    public $prod_name;
    public $email;
    public $phone;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$name,$prod_name,$email,$phone)
    {
        //
        $this->data = $data;
        $this->name = $name;
        $this->prod_name = $prod_name;
        $this->email = $email;
        $this->phone = $phone;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.inquiry.inquirytobizonair')->subject('Send Inquiry To Bizonair')->with([
            'data' => $this->data,'name' => $this->name,'prod_name' => $this->prod_name,'email' => $this->email,'phone' => $this->phone ]);
    }
}
