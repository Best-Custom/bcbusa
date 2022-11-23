<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailProductQuote extends Mailable
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
         return $this->html(
            '
                <html>
                    <body>
                        <table>
                        <tr><td>Full Name: </td><td>'.$this->dataReceeved['your_name'].'</td></tr>
                        <tr><td>Contact Number: </td><td>'.$this->dataReceeved['contact_number'].'</td></tr>
                        <tr><td>Email: </td><td>'.$this->dataReceeved['your_email'].'</td></tr>
                        <tr><td>Product Name: </td><td>'.$this->dataReceeved['product_name'].'</td></tr>
                        <tr><td>Length: </td><td>'.$this->dataReceeved['length'].'</td></tr>
                        <tr><td>Width: </td><td>'.$this->dataReceeved['width'].'</td></tr>
                        <tr><td>Depth: </td><td>'.$this->dataReceeved['depth'].'</td></tr>
                        <tr><td>Message: </td><td>'.$this->dataReceeved['specifications'].'</td></tr>
                        </table>
                    </body>
                </html>
            '
        )->from($this->dataReceeved['your_email'], 'BCB USA PRODUCT QUOTE')->subject($this->dataReceeved['product_name']);
    }
}
