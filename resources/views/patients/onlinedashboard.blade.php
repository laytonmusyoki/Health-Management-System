@extends('patients.base')

@section('title', 'Home')

@section('content')

<style>
    .health{
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        font-size: 60px !important;
        font-weight: bolder;
    }
    .p{
        font-size: 40px !important;
    }
    .hours{
            font-size: 25px !important;
        }
    @media (max-width:768px){
        .health{
            font-size: 35px !important;
        }
        .p{
            font-size: 20px !important;
        }
        .hours{
            font-size: 15px !important;
        }
    }
    

    
</style>
<!-- Hero Section -->
<div class="walkin-container">
    <div class="overlay">
        <div class="content text-center">
            <h1 class="fw-bold health" style="color:rgb(7, 7, 116)">Health Management System Appointment</h1>
            <p class="subtitle text-uppercase p" style="color:rgb(7, 7, 116)">For Adults & Children</p>
            <p class="hours">
                <strong>Monday - Saturday:</strong> 7:00am – 7:30pm <br>
                <strong>Sunday:</strong> 7:00am – 4:30pm
            </p>
            <a href="{{ route('appointments') }}" class="btn btn-primary btn-lg mt-3">Book Now</a>
        </div>
    </div>
</div>

<!-- About Section -->
<div class="container text-center py-5">
    <h2 class="fw-bold text-primary">About Us</h2>
    <p class="about text-center">
        Welcome to our Health Management System (HMS), a comprehensive platform designed to streamline healthcare operations and improve patient care. 
        Our system enables healthcare providers to efficiently manage patient records, appointments, billing, and medical history, ensuring a seamless workflow and data security.
        With user-friendly features and robust security, HMS enhances efficiency in hospitals, clinics, and other healthcare facilities.
    </p>
    <a href="#" class="btn btn-outline-primary mt-4">Read More</a>
</div>

<!-- Features Section -->

<section class="feature-section bg-light py-5 text-center">
    <div class="container" style="max-width: 1200px; margin: 15px auto; display: flex; align-items: center; justify-content: space-evenly;">
        {{-- <div class="row" style="width: 100%"> --}}
        <div class="col-lg-3 text-center">
            <div class="feature">
                <img src="/images/microscope.png" class="img-fluid mb-2" alt="Lab Icon" style="width: 60px;">
                <p class="fw-semibold">On-site <br> Laboratory</p>
            </div>
        </div>
        <div class="col-lg-3 text-center">
            <div class="feature">
                <img src="/images/hospital.jpg" class="img-fluid mb-2" alt="Hospital Icon" style="width: 60px;">
                <p class="fw-semibold">Open <br> 7 Days a Week</p>
            </div>
        </div>
        <div class="col-lg-3 text-center">
            <div class="feature">
                <img src="/images/time.jpg" class="img-fluid mb-2" alt="Time Icon" style="width: 60px;">
                <p class="fw-semibold">Short <br> Waiting Times</p>
            </div>
        </div>
        <div class="col-lg-3 text-center">
            <div class="feature">
                <img src="/images/appointment.jpg" class="img-fluid mb-2" alt="Appointment Icon" style="width: 60px;">
                <p class="fw-semibold">Easy <br> Appointment Booking</p>
            </div>
        </div>
    </div>

</section>


<!-- Services Section -->
<section class="services-section bg-light py-5 text-center">
    <h2 class="fw-bold text-dark">Our Services</h2>
    <p class="text-muted">We provide a range of top-quality healthcare services to meet your needs.</p>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="service-box p-3 border rounded shadow-sm">Urgent Care</div>
            </div>
            <div class="col-md-3">
                <div class="service-box p-3 border rounded shadow-sm">X-Rays & Lab Tests</div>
            </div>
            <div class="col-md-3">
                <div class="service-box p-3 border rounded shadow-sm">Occupational Health</div>
            </div>
            <div class="col-md-3">
                <div class="service-box p-3 border rounded shadow-sm">Travel Vaccines</div>
            </div>
        </div>
    </div>
</section>

@endsection
