<?php

namespace App\Http\Controllers;
use App\Mail\SendEmailProductQuote;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Rules\ReCaptcha;

class SendProductQuoteEmail extends Controller
{
    public function productQuoteFormEmail(Request $request){

    // $request->validate([
    //     'g-recaptcha-response' => ['required', new ReCaptcha]
    // ]);
    $data = $request->all();
    // print_r($data); exit();
    $htmltemp1 = '<html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <style>
                #customers {
                  font-family: Arial, Helvetica, sans-serif;
                  border-collapse: collapse;
                  width: 100%;
                }
                
                #customers td {
                  border: 1px solid #ddd;
                  padding: 8px;
                }
                
                #customers tr:nth-child(even){background-color: #f2f2f2;}
                
                #customers tr:hover {background-color: #ddd;}
                
                #customers td:nth-child(1) { background-color: #112955; color:white; width: 30%; }
            </style>
        </head>
        <body>';
    $htmltemp2 = '</body>
        </html>';
    $body_one = '
        <h3>Detail from single product page</h3>
        <table id="customers">
        <tr><td>Full Name: </td><td>'.$request->your_name.'</td></tr>
        <tr><td>Contact Number: </td><td>'.$request->contact_number.'</td></tr>
        <tr><td>Email: </td><td>'.$request->your_email.'</td></tr>
        <tr><td>Product Name: </td><td>'.$request->product_name.'</td></tr>
        <tr><td>Length: </td><td>'.$request->length.'</td></tr>
        <tr><td>Width: </td><td>'.$request->width.'</td></tr>
        <tr><td>Depth: </td><td>'.$request->depth.'</td></tr>
        <tr><td>Unit: </td><td>'.$request->measurement_unit.'</td></tr>
        <tr><td>Quantity: </td><td>'.$request->qty.'</td></tr>
        <tr><td>Message: </td><td>'.$request->specifications.'</td></tr>
        </table>';

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
        $mail->Subject = 'product quote';
        $mail->Body = $htmltemp1.$body_one.$htmltemp2;
        $mail->AddAddress("info@bestcustomboxes.com");
        // $mail->AddAddress("developerbcb@gmail.com");
        // $mail->AddAttachment($my_path);
        if(!$mail->Send()){
        echo "Mailer Error: " . $mail->ErrorInfo;
        }
        else{
        // echo "Message has been sent";
        return Response::json(['success' => 'successfully sent'], 200);
        }
    }
}
