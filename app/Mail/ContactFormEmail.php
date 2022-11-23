<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormEmail extends Mailable
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
        // return $this->view('view.name');
        // return $this->subject($this->dataReceeved['subject'])->view('quote-email-template');
        return $this->html(
            '
                <html>
                    <body>
                        <table>
                        <tr><td>Full Name: </td><td>'.$this->dataReceeved['subject'].'</td></tr>
                        <tr><td>Email: </td><td>'.$this->dataReceeved['email'].'</td></tr>
                        <tr><td>Message: </td><td>'.$this->dataReceeved['message_text'].'</td></tr>
                        </table>
                    </body>
                </html>
            '
        )->from($this->dataReceeved['email'], 'BCB USA')->subject($this->dataReceeved['subject']);
    }
}
