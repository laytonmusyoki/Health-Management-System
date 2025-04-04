<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Set new password</title>
    <link rel="icon" href="{{ asset('images/hms-logo.png') }}">
    <link rel="stylesheet" href="{{ asset('auth/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="auth">
        <div class="container2 vh-100 d-flex align-items-center justify-content-center">
            <div class="row w-100">
                <!-- This will be hidden on small screens -->
                <div class="col-md-6 d-none d-md-flex flex-column align-items-center justify-content-center text-center p-5 ">
                    <div class="about">
                        <h2>About Our Health Management System</h2>
                        <p>Our Health Management System provides seamless healthcare solutions, allowing users to book appointments, access medical records, and connect with healthcare professionals.</p>
                        <img src="{{ asset('auth/images/onlinedoctor.jpeg') }}" alt="Healthcare Overview" class="img-fluid">
                    </div>
                </div>

                <!-- This will be visible on small screens only -->
                <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
                    <div class="card">
                        <h2 class="text-center">Set new password</h2>
                        <form method="post" action="{{ route('reset',$token) }}" class="w-100">
                            @csrf
                            <div class="mb-3">
                                <label for="password">Enter New Password</label>
                                <input type="password" id="password" name="password"  placeholder="Create new password" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation">Confirm New Password</label>
                                <input type="password" id="passwords" name="password_confirmation"  placeholder="Confirm your password" required>
                            </div>
                            <div class="check">
                                <input type="checkbox" class="form-check-input" id="showPassword">
                                <label for="" class="form-check-label">Show password</label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-100">Reset Password</button>
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
