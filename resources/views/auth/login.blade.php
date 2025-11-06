<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('auth/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" href="{{ asset('images/hms-logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="auth">
        <div class="container2 vh-100 d-flex align-items-center justify-content-center">
            <div class="row w-100">
                <!-- This will be hidden on small screens -->
                <div class="col-md-6 d-none d-md-flex flex-column align-items-center justify-content-center text-center p-5 bg-light">
                    <div class="about">
                    <h2>Welcome to Our EHR-System</h2>
                    <p>Access your account by entering your email and password. Stay connected and enjoy seamless access to your personalized dashboard. Forgot your password? Reset it easily. Log in now and continue exploring the features designed just for you!.</p>
                    <img src="{{ asset('auth/images/onlinedoctor.jpeg') }}" alt="Healthcare Overview" class="img-fluid">

                    </div>
                </div>

                <!-- This will be visible on small screens only -->
                <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
                    <div class="card">
                        <h2 class="text-center">Login</h2>
                        <form method="POST" action="{{route('loginpost')}}" class="w-100">
                            @csrf
                            <div class="mb-3">
                                <label for="">Email</label>
                                <input type="text" name="email" value="{{old('email')}}" placeholder="Email" >
                            </div>
                            <div class="mb-3">
                                <label for="">Password</label>
                                <input type="password" name="password" id="password" placeholder="Password" >
                            </div>
                            <div class="check">
                                <input type="checkbox" class="form-check-input" id="showPassword">
                                <label for="" class="form-check-label">Show password</label>
                                <a href="{{ route('forgot') }}" style="float: right">Forgot password ?</a>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-100">Sign In</button>
                                <p class="mt-3">Don't have an account? <a href="{{ route('register') }}">Register</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('auth/script.js') }}"></script>
    </div>

<x-sweet-alert/>

</body>
</html>
