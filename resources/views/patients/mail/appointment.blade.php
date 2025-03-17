<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Appointment Status</title>
    <style>
        body{
            background: white;
        }
        .card{
            background-color: white !important;
            border-radius: 5px;
            box-shadow: 0px,0px,5px black;
        }
        .card-body{
            padding: 10px;
        }
        h3{
            color: blue;
            font-weight: bold;
        }
        .title{
            text-align: center;

        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-body">

            <p>Your appointment has been received and we will get back to you soon</p><br>

            <h4>Appointment schedule</h3>
                <p>Doctor: {{ $mailData['doctor'] }}</p>
            <p> Time : {{$mailData['time']}}</p><br>
            <p>Date : {{$mailData['date']}}</p><br>
           
            <h3>Cancelled</h3>
            <p>Your appointment has been Cancelled </p><br>

            Thanks,<br>
            

           <div class="title">
            @ Health Management System
           </div>

        </div>
    </div>
</body>
</html>
