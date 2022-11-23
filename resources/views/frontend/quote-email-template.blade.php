<!DOCTYPE html>
<html lang="en">
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
<body>
    <center><h3>Detail for product price quotation</h3></center>
    <table id="customers">
        <tr>
            <th>Field Title</th>
            <th>Field Description</th>
        </tr>
        <tr>
            <td>Name</td>
            <td>{{$dataReceeved['your_name']}}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{$dataReceeved['your_email']}}</td>
        </tr>
        <tr>
            <td>Phone</td>
            <td>{{$dataReceeved['your_phone']}}</td>
        </tr>
        <tr>
            <td>Subject</td>
            <td>{{$dataReceeved['subject']}}</td>
        </tr>
        <tr>
            <td>Message</td>
            <td>{{$dataReceeved['your_message']}}</td>
        </tr>
        @if(!empty($dataReceeved['checkBox']))
        <tr>
            <td>Box Style</td>
            <td>{{$dataReceeved['checkBox']}}</td>
        </tr>
        @endif
        @if(!empty($dataReceeved['style_no']))
        <tr>
            <td>Style Chart No</td>
            <td>{{$dataReceeved['style_no']}}</td>
        </tr>
        @endif
    </table>
    <table id="customers">
        <tr>
            <th>Length</th>
            <th>Width</th>
            <th>Height</th>
            <th>Unit</th>
            <th>Quantity</th>
            <th>Colours</th>
            <th>Attachment File</th>
        </tr>
        @foreach(explode("|", $dataReceeved['boxes_detail']) as $item)
        <tr>
            @foreach(explode(",", $item) as $data)
            <td>{!! $data !!}</td>
            @endforeach
        </tr>
        @endforeach
    </table>
</body>
</html>