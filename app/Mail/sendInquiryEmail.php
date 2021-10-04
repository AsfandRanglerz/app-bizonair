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
    public $reference_no;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$name,$prod_name,$reference_no)
    {
        //
        $this->data = $data;
        $this->name = $name;
        $this->prod_name = $prod_name;
        $this->reference_no = $reference_no;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        return $this->markdown('emails.inquiry.inquiry')
//            ->attach($this->data['inquiry']->image)
//            ->subject('Inquiry Send Notification')
//            ->with(['data' => $this->data,'name' => $this->name,'prod_name' => $this->prod_name,
//                'reference_no' => $this->reference_no ]);
        $mail = $this->markdown('emails.inquiry.inquiry')
            //->attach($this->data['inquiry']->image)
            ->subject('Inquiry Send Notification')
            ->with(['data' => $this->data,'name' => $this->name,'prod_name' => $this->prod_name,
                'reference_no' => $this->reference_no ]);
            if($this->data['inquiry']->image)
            $mail->attach($this->data['inquiry']->image);
        return $mail;
    }
}
