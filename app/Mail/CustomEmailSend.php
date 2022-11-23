<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomEmailSend extends Mailable
{
    use Queueable, SerializesModels;
    public $dataReceeved;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->dataReceeved = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->dataReceeved['your_email'], 'BCB USA FREE QUOTE')->subject($this->dataReceeved['subject'])->view('frontend.quote-email-template');
    }
}
