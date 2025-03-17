@extends('patients.base')

@section('title', 'Book Appointment')



@section('content')


<style>
    .navbar {
    transform: translateY(0.2%);
    transition: transform 0.3s ease-in-out !important;
}
@media (max-width:768px){
    .navbar {
    transform: translateY(1.2%) !important;
    transition: transform 0.3s ease-in-out;
}
}
</style>
<div class="bok-appointment">
    {{-- Appointment Booking Form (Hidden initially) --}}
    <div id="appointmentModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            
            <form action="{{ route('appointmentsPost') }}" method="POST">
                <h3>Book an Appointment</h3>
                @csrf
                <input type="hidden" id="doctor_id" name="doctor_id">
                <input type="hidden" id="patient_id" name="user_id" value="{{ auth()->user()->id }}">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="Doctor Name">Doctor Name</label>
                        <input type='text' class="form-control" id="doctor_name" name="doctorName"  readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">Full Name:</label>
                        <input type="text" class="form-control" id="name" name="patientName" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="phone">Phone Number:</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="date">Preferred Date:</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="time">Preferred Time:</label>
                        <input type="time" class="form-control" id="time" name="time" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="message">Additional Message:</label>
                        <textarea class="form-control" id="message" name="reason"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top: 10px">Book Appointment</button>
            </form>
        </div>
    </div>
</div>
<h3 class="text-center">Available Doctors</h3>
<div class="container">
    <div class="row">
        @foreach ($doctors as $clinician)
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body"><div class="image"> <img src="{{ asset('images/clinician.png') }}" style="width:50px; height:50px" alt="Doctor Image"></div>
                <h5 class="card-title">{{ $clinician->name }}</h5>
                    <p class="card-text">{{ $clinician->speciality }}</p>
                    <p class="card-text">{{ $clinician->phone }}</p>
                    <p class="card-text">{{ $clinician->email }}</p>  
                    <button class="btn btn-primary" onclick="openModal({{ $clinician->id }}, '{{ $clinician->name }}')">
                        Book Appointment
                    </button>
                </div>  
                    
            </div>
        </div>
        @endforeach
    </div>
</div>
<x-sweet-alert/>

{{-- JavaScript for Modal --}}
<script>
    function openModal(doctorId, doctorName) {
        document.getElementById('appointmentModal').style.display = 'block';
        document.getElementById('doctor_id').value = doctorId;
        document.getElementById('doctor_name').value = doctorName;
        document.getElementById('name').value = ''; // Clear name field
        document.getElementById('email').value = ''; // Clear email field
        document.getElementById('phone').value = ''; // Clear phone field
    }

    function closeModal() {
        document.getElementById('appointmentModal').style.display = 'none';
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        let modal = document.getElementById('appointmentModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>

{{-- Modal CSS --}}
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
    }

    .modal-content {
        background-color: #fff;
        margin: 10% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 60%;
        box-shadow: 0px 0px 10px #a09e9e;
        border-radius: 10px;
    }
    input{
        margin: 10px 0
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover {
        color: black;
    }
    @media (max-width: 768px) {
        .modal-content {
            width: 90%;
        }
    }
</style>
@endsection
