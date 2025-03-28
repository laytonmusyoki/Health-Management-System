<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Otp</title>
    <link rel="stylesheet" href="{{ asset('auth/style.css') }}">
    <link rel="icon" href="{{ asset('images/hms-logo.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="auth">
        <div class="container2 vh-100 d-flex align-items-center justify-content-center">
            <div class="row w-100">
                <!-- This will be hidden on small screens -->
                <div class="col-md-6 d-none d-md-flex flex-column align-items-center justify-content-center text-center p-5 bg-light">
                    <div class="about">
                    <h2>About Our Health Management System</h2>
                    <p>Our Health Management System provides seamless healthcare solutions, allowing users to book appointments, access medical records, and connect with healthcare professionals.</p>
                    <img src="{{ asset('auth/images/onlinedoctor.jpeg') }}" alt="Healthcare Overview" class="img-fluid">

                    </div>
                </div>

                <!-- This will be visible on small screens only -->
                <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
                    <div class="card" style="height: auto">
                        <div class="text-center">
                            <img src="{{ asset('auth/images/otp.jpg') }}" alt="Forgot Password" class="img-fluid" style="width:150px ;heigth:150px;">
                        </div>
                        <h3 class="text-center">Two-Step-Verification</h3>
                        <h5 class="text-center">One Time Password</h5>
                        <form method="POST" action="{{route('otppost',$remainingTime)}}" class="w-100">
                            @csrf
                            <div class="mb-3">
                                <label for="">Otp</label>
                                <input type="text" name="otp" placeholder="Enter otp" value="{{old('otp')}}">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-100">Submit</button>
                            </div>

                            <p id="timer"></p>
                            <p id="Resend" style="display:none;"><a href="{{route('resend')}}">Resend link</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
       <script>
        var remainingTime = {{$remainingTime}};
    function startOtpCountdown(){
        var timer =document.getElementById('timer');
        var resend =document.getElementById('Resend');
        var interval =setInterval(function () {
            var minutes = Math.floor(remainingTime / 60);
            var seconds = Math.floor(remainingTime % 60);
            timer.innerHTML ='Otp expires in ' + minutes + ':' + seconds;
            if(remainingTime<0){
                clearInterval(interval);
                timer.innerHTML='Otp has expired';
                resend.style.display='block';
            }
            else{
                remainingTime--;
            }
        },1000);
    }
    window.onload =function(){
        if(remainingTime>0){
            startOtpCountdown();
        }
        else{
            document.getElementById('timer').innerHTML='Otp has expired';
            document.getElementById('Resend').style.display='block';
        }
    }
       </script>

    </div>
    <x-sweet-alert/>
</body>
</html>
