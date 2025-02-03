<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Otp</title>
    <link rel="stylesheet" href="{{ asset('auth/style.css') }}">
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
                        <h2 class="text-center">One Time Password</h2>
                        <form method="POST" action="" class="w-100">
                            @csrf
                            <div class="mb-3">
                                <label for="">Otp</label>
                                <input type="text" name="otp" placeholder="Enter otp" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-100">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('auth/script.js') }}"></script>
    </div>
</body>
</html>
