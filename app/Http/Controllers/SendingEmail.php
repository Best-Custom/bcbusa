<?php

namespace App\Http\Controllers;

use App\Mail\CustomEmailSend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Rules\ReCaptcha;

class SendingEmail extends Controller
{
    public function productQuoteEmail(Request $request){

    $data = $request->all();
    $boxes_arr = array();
	$profileImage = array();
    $destination = 'frontend-assets/assets/email_attachments/';
    $img_arr_index = array();
    $checkBox = "";
    $style_no = "";


	if ($request->hasfile('upload_file_image')) {
        $img_arr_index = array_keys($request->upload_file_image);
        foreach($request->file('upload_file_image') as $key=>$image)
        {
            $name = date('YmdHis') . uniqid()."." . $image->getClientOriginalExtension();
            $image->move($destination, $name);  
            $profileImage[$key] = '<a href="https://bestcustomboxes.com/'.$destination.$name.'">view</a>';
        }
    }

    for($i=0; $i < count($request->length) ; $i++){
        if(!empty($profileImage)){
            if(in_array($i, $img_arr_index)){
                $boxes_arr+= [$i=>$request->length[$i].",".$request->width[$i].",".$request->height[$i].",".$request->dimention[$i].",".$request->quantity[$i].",".$request->colours[$i].",".$profileImage[$i]];
            }else{
                $boxes_arr+= [$i=>$request->length[$i].",".$request->width[$i].",".$request->height[$i].",".$request->dimention[$i].",".$request->quantity[$i].",".$request->colours[$i].","."0"];
            }
        }else{
                $boxes_arr+= [$i=>$request->length[$i].",".$request->width[$i].",".$request->height[$i].",".$request->dimention[$i].",".$request->quantity[$i].",".$request->colours[$i].","."0"];
        }
    }

    if(strlen($request->checkBx) > 0){
        $checkBox = $request->checkBx;
        $style_no = implode($request->style_no);
    }

    $final_arr = ["your_name" => $request->your_name, "your_email" => $request->your_email, "your_phone" => $request->your_phone, "subject" => $request->subject, "your_message" => $request->your_message, "boxes_detail" => implode("|", $boxes_arr), "checkBox" => $checkBox, "style_no" => $style_no ];

        Mail::to('info@bestcustomboxes.com')->send(new CustomEmailSend($final_arr));
        return redirect()->to('/thank-you')->with('success', 'Mail Sent !');
    }
    // new function
    public function sendqouteform(Request $request){
        // $request->validate([
        //     'g-recaptcha-response' => ['required', new ReCaptcha]
        // ]);

        $data = $request->all();
        $boxes_arr = array();
        $profileImage = array();
        $destination = 'frontend-assets/assets/email_attachments/';
        $img_arr_index = array();
        $checkBox = "";
        $style_no = "";
    
    
        if ($request->hasfile('upload_file_image')) {
            $img_arr_index = array_keys($request->upload_file_image);
            foreach($request->file('upload_file_image') as $key=>$image)
            {
                $name = date('YmdHis') . uniqid()."." . $image->getClientOriginalExtension();
                $image->move($destination, $name);  
                $profileImage[$key] = '<a href="https://bestcustomboxes.com/'.$destination.$name.'">view</a>';
            }
        }
    
        for($i=0; $i < count($request->length) ; $i++){
            if(!empty($profileImage)){
                if(in_array($i, $img_arr_index)){
                    $boxes_arr+= [$i=>$request->length[$i].",".$request->width[$i].",".$request->height[$i].",".$request->dimention[$i].",".$request->quantity[$i].",".$request->colours[$i].",".$profileImage[$i]];
                }else{
                    $boxes_arr+= [$i=>$request->length[$i].",".$request->width[$i].",".$request->height[$i].",".$request->dimention[$i].",".$request->quantity[$i].",".$request->colours[$i].","."0"];
                }
            }else{
                    $boxes_arr+= [$i=>$request->length[$i].",".$request->width[$i].",".$request->height[$i].",".$request->dimention[$i].",".$request->quantity[$i].",".$request->colours[$i].","."0"];
            }
        }
    
        if(strlen($request->checkBx) > 0){
            $checkBox = $request->checkBx;
            $style_no = implode($request->style_no);
        }
    
        // $final_arr = ["your_name" => $request->your_name, "your_email" => $request->your_email, "your_phone" => $request->your_phone, "subject" => $request->subject, "your_message" => $request->your_message, "boxes_detail" => implode("|", $boxes_arr), "checkBox" => $checkBox, "style_no" => $style_no ];
        
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
                
                #customers td, #customers th {
                  border: 1px solid #ddd;
                  padding: 8px;
                }
                
                #customers tr:nth-child(even){background-color: #f2f2f2;}
                
                #customers tr:hover {background-color: #ddd;}
                
                #customers th {
                  padding-top: 12px;
                  padding-bottom: 12px;
                  text-align: left;
                  background-color: #042a7a;
                  color: white;
                }
            </style>
        </head>
        <body>';
        $htmltemp2 = '</body>
        </html>';
        $body_one = '<center><h3>Detail for product price quotation</h3></center>
        <table id="customers">
            <tr>
                <th>Field Title</th>
                <th>Field Description</th>
            </tr>
            <tr>
                <td>Name</td>
                <td>'.$request->your_name.'</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>'.$request->your_email.'</td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>'.$request->your_phone.'</td>
            </tr>
            <tr>
                <td>Subject</td>
                <td>'.$request->subject.'</td>
            </tr>
            <tr>
                <td>Message</td>
                <td>'.$request->your_message.'</td>
            </tr>
            <tr>
                <td>Box Style</td>
                <td>'.$checkBox.'</td>
            </tr>
            <tr>
                <td>Style Chart No</td>
                <td>'.$style_no.'</td>
            </tr></table>';

            $body_two = '<table id="customers">
            <tr>
                <th>Length</th>
                <th>Width</th>
                <th>Height</th>
                <th>Unit</th>
                <th>Quantity</th>
                <th>Colours</th>
                <th>Attachment File</th>
            </tr>';
            foreach($boxes_arr as $item)
            {
                $body_two .= '<tr>';
                foreach(explode(",",$item) as $new){
                    $body_two .= '<td>'.$new.'</td>';
                }
                $body_two .= '</tr>';
            }
            $body_two .= '</table>';
    
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
        $mail->Subject = 'get a quote';
        $mail->Body = $htmltemp1.$body_one.$body_two.$htmltemp2;
        $mail->AddAddress("info@bestcustomboxes.com");
        // $mail->AddAddress("developerbcb@gmail.com");
    
        // $mail->AddAttachment($my_path);
        if(!$mail->Send()){
        echo "Mailer Error: " . $mail->ErrorInfo;
        }
        else{
        // echo "Message has been sent";
        return redirect()->to('/thank-you')->with('success', 'Mail Sent !');
        }
    }
}
