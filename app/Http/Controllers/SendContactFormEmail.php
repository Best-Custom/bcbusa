<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormEmail;
use App\Mail\CustomEmailSend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Rules\ReCaptcha;

class SendContactFormEmail extends Controller
{
    public function contactFormEmails(Request $request){
        // $request->validate([
        //     'fullname' => 'required',
        //     'email' => 'required|email',
        //     'subject' => 'required',
        //     'message_text' => 'required',
        //     'g-recaptcha-response' => ['required', new ReCaptcha]
        // ]);
        $body_one = '
                <html>
                    <body>
                        <table>
                        <tr><td>Full Name: </td><td>'.$request->fullname.'</td></tr>
                        <tr><td>Email: </td><td>'.$request->email.'</td></tr>
                        <tr><td>Subject: </td><td>'.$request->subject.'</td></tr>
                        <tr><td>Message: </td><td>'.$request->message_text.'</td></tr>
                        </table>
                    </body>
                </html>
            ';

        $mail = new PHPMailer(); // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        //$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
        $mail->Host = "mail.bestcustomboxes.com";
        $mail->Port = "2525"; // or 587
        $mail->IsHTML(true);
        $mail->Username = "noreply@bestcustomboxes.com";
        $mail->Password = "Ayesha@2011";
        $mail->SetFrom("noreply@bestcustomboxes.com");
        $mail->Subject = 'contact us';
        $mail->Body = $body_one;
        $mail->AddAddress("info@bestcustomboxes.com");
        // $mail->AddAddress("developerbcb@gmail.com");
    
        // $mail->AddAttachment($my_path);
        if(!$mail->Send()){
        echo "Mailer Error: " . $mail->ErrorInfo;
        }
        else{
            return redirect()->to('/thank-you')->with('success', 'Mail Sent !');
        // echo "Message has been sent";
        }
    }
}
