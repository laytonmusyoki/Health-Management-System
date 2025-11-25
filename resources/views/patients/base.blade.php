<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Health Management System')</title>
    <link rel="stylesheet" href="{{ asset('onlinepatients/app.css') }}">
    <link href="/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/plugins/metismenu/metisMenu.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/plugins/metismenu/mm-vertical.css">
    <link rel="stylesheet" type="text/css" href="/assets/plugins/simplebar/css/simplebar.css">
    <!--bootstrap css-->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    <!--main css-->
    <link href="/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="/sass/main.css" rel="stylesheet">
    <link href="/sass/dark-theme.css" rel="stylesheet">
    <link href="/sass/semi-dark.css" rel="stylesheet">
    <link href="/sass/bordered-theme.css" rel="stylesheet">
    <link href="/sass/responsive.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" href="{{ asset('images/hms-logo.png') }}">
    <style>
        /* Navbar Styles */

.navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color: #034774;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    color: #fff;
    padding: 1rem;
    z-index: 50;
    transform: translateY(-100%);
    transition: transform 0.3s ease-in-out;
}

.navbar.active {
    transform: translateY(0);
}

.small-navbar{
    display: none !important;
}



.main{
    min-height: 100vh !important;
}

/* Logo Section */
.logo {
    display: flex;
    align-items: center;
    gap: 10px;
}

.cross {
    position: relative;
    width: 40px;
    height: 40px;
    background-color: transparent;
    display: flex;
    align-items: center;
    justify-content: center;
}

.horizontal,
.vertical {
    position: absolute;
    background-color: white;
}

.horizontal {
    width: 30px;
    height: 8px;
}

.vertical {
    width: 8px;
    height: 30px;
}

.center-dot {
    position: absolute;
    width: 10px;
    height: 10px;
    color: turquoise;
    border-radius: 50%;
}


/* Navigation Links */




 a {
    color: white;
    text-decoration: none;
    font-size: 16px;
    transition: color 0.3s;
    margin-left: 20px;
}

.nav-links a:hover {
    color: rgb(58, 240, 2);
}

.navbar a .active {
    color: #4CAF50; /* Green active link */
}

/* User Login */
.user-section {
    display: flex;
    align-items: center;
    gap: 8px;
}

.user-icon {
    background-color: white;
    color: #000e91;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 16px;
}

.user-section a {
    color: white;
    text-decoration: none;
}

.user-section a:hover {
    color: lightgray;
}

.walkin-container {
    position: relative;
    width: 100%;
    height: 90vh;
    background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),url('/images/clinic.jpg') no-repeat center center/cover;display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
}

.overlay {
    
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.content {
    padding: 20px;
}

.content h1 {
    font-size: 42px;
    color: #020202;
    font-weight: bold;
}

.subtitle {
    font-size: 18px;
    color: #020202;
    font-weight: bold;
    margin-top: -10px;
}

.hours {
    font-size: 16px;
    color: #fdfcfc;
    margin: 15px 0;
}

.book-now-btn {
    display: inline-block;
    background: #3128a7;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    font-size: 18px;
    border-radius: 5px;
    transition: background 0.3s ease-in-out;
}

.book-now-btn:hover {
    background: #218838;
}

.about-container {
    text-align: center;
    background: #F2FAFC;
    padding: 50px 20px;
}

.about-container h2 {
    font-size: 28px;
    color: #005A9C;
    font-weight: bold;
}

.about-text {
    font-size: 16px;
    color: #333;
    max-width: 800px;
    margin: 0 auto 30px;
    line-height: 1.6;
}

.features {
    display: flex;
    justify-content: center;
    gap: 40px;
    flex-wrap: wrap;
    margin-bottom: 30px;
}



.feature img {
    width: 50px;
    height: 50px;
    margin-bottom: 10px;
}

.feature p {
    font-size: 14px;
    color: #005A9C;
    font-weight: bold;
}

.read-more-btn {
    display: inline-block;
    background: #14A38B;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    font-size: 16px;
    border-radius: 5px;
    transition: background 0.3s ease-in-out;
}

.read-more-btn:hover {
    background: #11806A;
}
.services-section {
            padding: 50px 20px;
            font-family: Arial, sans-serif;
            background-color: #f8fdfd;
            text-align: center;
        }
        .services-section h2 {
            color: #005580;
            font-size: 24px;
            margin-bottom: 15px;
        }
        .services-section p {
            color: #555;
            font-size: 14px;
            max-width: 600px;
            margin: 0 auto 30px;
        }
        .services-list {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        .service-box {
            background: white;
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            font-weight: bold;
            color: #005580;
            min-width: 150px;
        }
        .bok-appointment{
            margin-top: 20px;
            margin:20px 10px;
            padding: 20px 10px;
        }
        
        .doctor-card{
            align-items: center;
            justify-content: center;
            padding: 20px;
            border-radius: 8px;
            margin: 10px
        }
        .doctor-card img{
            width: 100%;
            height: 200px;
            border-radius: 8px;
        }
        @media (max-width:768px){
    .navbar{
        
    }
    
    .small-active{
        left: 0;
        transition: all 0.6s ease;
    }
    .smallTset{
        display: none;
    }
    .user-icon{
        display: none;
    }
    
}

    </style>
</head>
<body>
    
    <nav class="navbar" id="scrollNavbar">
        <div class="container">
            <!-- Logo Section -->
            <div class="logo">
                <div class="cross">
                    <div class="horizontal"></div>
                    <div class="vertical"></div>
                    <div class="center-dot">+</div>
                </div>
                <span class="text smallTset">EHR</span>
            </div>
            
    
            <!-- Navigation Links -->
            {{-- <ul class="nav-links"> --}}
                <div class="center">
                    <a href="{{ route('OnlineDashboard') }}" class="{{ request()->routeIs('OnlineDashboard') ? 'active' : '' }}">Home</a>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard'? 'active' : '') }}">My Dashboard</a>
                </div>
            {{-- </ul> --}}
    
            <!-- User Login -->
            <div class="user-section">
                <span class="user-icon">👤</span>
                @if(auth()->check())
                    <a href="{{ route('logout') }}">👤 Log Out</a>
                @else
                    <a href="{{ route('login') }}">👤 Log In</a>
                @endif
            </div>
            
        </div>
    </nav>

    <div class="small-navbar">

    </div>
    
    <div class="main">
        @yield('content')
    </div>


    <div class="footer p-3" style="background: #034774; color: white; display: flex; align-items: center; justify-content: center;">
        <p class="text-center">&copy; {{ config('app.name') }} 
            <script>
                document.write(new Date().getFullYear());
            </script>
        </p>
    </div>

    <script src="{{ asset('onlinepatients/app.js') }}"></script>

    <script>
        const navbar = document.getElementById("scrollNavbar");
        let lastScrollY = 0;

        window.addEventListener("scroll", () => {
            const currentScrollY = window.scrollY;

            if (currentScrollY > 50) {
                navbar.classList.add("active");
                navbar.classList.remove("hidden");
            } else {
                navbar.classList.remove("active");
                navbar.classList.add("hidden");
            }

            lastScrollY = currentScrollY;
        });
    </script>
</body>
</html>