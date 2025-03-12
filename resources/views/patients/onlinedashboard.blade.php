@extends('patients.base')
@section('title', 'Home')
@section('content')
<div class="walkin-container">
    <div class="overlay">
        <div class="content">
            <h1>HMS <br> Appointment</h1>
            <p class="subtitle">FOR ADULTS & CHILDREN</p>
            <p class="hours">
                Monday - Saturday: 7:00am – 7:30pm <br>
                Sunday: 7:00am – 4:30pm
            </p>
            <a href="{{ route('appointments') }}"  class="book-now-btn">Book Now</a>
        </div>
    </div>
</div>
<div class="about-container">
    <h2>ABOUT US</h2>
    <p class="about-text">
        Welcome to our Health Management System (HMS), a comprehensive platform designed to streamline healthcare operations and improve patient care. <br>
        Our system enables healthcare providers to efficiently manage patient records, appointments, billing, and medical history, ensuring seamless workflow and data security. <br>
        With user-friendly features and robust security, HMS enhances efficiency in hospitals, clinics, and other healthcare facilities. <br>
        We are committed to innovation and excellence in healthcare technology, helping professionals focus on delivering quality medical care.
    </p>

    <div class="features">
        <div class="feature">
            <img src="/images/microscope.png" alt="Lab Icon">
            <p>On site <br> laboratory</p>
        </div>
        <div class="feature">
            <img src="/images/hospital.jpg" alt="Calendar Icon">
            <p>Open 7 days <br> a week</p>
        </div>
        <div class="feature">
            <img src="/images/time.jpg" alt="Time Icon">
            <p>Short waiting <br> times</p>
        </div>
        <div class="feature">
            <img src="/images/appointment.jpg" alt="Appointment Icon">
            <p>Book appointment <br> needed</p>
        </div>
    </div>

    <a href="#" class="read-more-btn">Read More</a>
</div>
<section class="services-section">
    <h2>SERVICES</h2>
    <p>We provide a range of top-quality healthcare services to meet your needs.</p>
    <div class="services-list">
        <div class="service-box">Urgent Care</div>
        <div class="service-box">X-Rays & Lab Test</div>
        <div class="service-box">Occupational Health</div>
        <div class="service-box">Travel Vaccines</div>
    </div>
</section>
@endsection