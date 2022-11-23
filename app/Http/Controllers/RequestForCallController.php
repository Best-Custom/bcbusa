<?php

namespace App\Http\Controllers;

use App\Mail\ReqForCall;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Rules\ReCaptcha;

class RequestForCallController extends Controller
{
    public function ReqForCall(){
        return view('frontend.request-for-call');
    }
    // public function RequestForACall(Request $request){
    //     $data = $request->all();
    //     Mail::to('info@bestcustomboxes.com')->send(new ReqForCall($data));
    //     // Mail::to('info@bestcustomboxes.co.uk')->send(new ReqForCall($data));
    //     return redirect()->to('/thank-you')->with('success', 'Mail Sent !');
    // }
    public function RequestForACalls(Request $request){
        // $request->validate([
        //     'g-recaptcha-response' => ['required', new ReCaptcha]
        // ]);
        $data = $request->all();
        $body_one = '
        <html>
            <body>
                <table>
                <tr><td>Full Name: </td><td>'.$request->yourname.'</td></tr>
                <tr><td>Email: </td><td>'.$request->email.'</td></tr>
                <tr><td>Phone No: </td><td>'.$request->phone.'</td></tr>
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
        $mail->Subject = 'request a call';
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
