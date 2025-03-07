@extends('staff.app')
@section('title', 'Users')
@section('content')

<style>
    .card-row {
        display: grid;
        grid-template-columns: repeat(8, 1fr);
        align-items: center;
        gap: 5px;
        overflow-x: auto;
        overflow-y: hidden;
    }

    .card-col .card {
        width: 170px;
        height: 140px !important;
        height: auto;
    }

    .custom h6 {
        margin-top: 10px;
        text-align: center;
        color: #555;
        font-size: 10px;
        font-weight: bold;
    }

    .p {
        min-height: 100px !important;
    }

    @media (max-width: 768px) {
        .card-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }

        body, html {
            width: 100% !important;
            overflow-x: hidden !important;
        }
    }

    .custom .image {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
    }

    .custom h6 {
        margin-top: 15px;
        text-align: center;
        color: #555;
        font-size: 13px;
        font-weight: bold;
    }
</style>

<!-- Breadcrumb -->
<div class="row d-flex justify-content-between align-items-center">
    <div class="col-lg-6 page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="row">
            <div class="breadcrumb-title pe-3">Today's Visits <a href="">({{ $todays_patients }})</a></div>
        </div>
    </div>
    <div class="col-lg-6 page-breadcrumb d-none d-sm-flex align-items-center mb-3" >
        <div class="row">
            <div class="breadcrumb-title pe-3" style="float: right">Total Visits of all <a href="">({{ $total_visits }})</a></div>
        </div>
    </div>
</div>
<!-- End Breadcrumb -->

<!-- Card Row -->
<div class="card-row">
    @foreach ($filteredModules as $module)
        @if ($module['name'] !== 'Patient Tracking' && $module['name'] !== 'Registration')
            <div class="card-col">
                <div class="card">
                    <a href="{{ route('tracking.show', $module['queue']) }}">
                        <div class="card-body custom">
                            <div class="image">
                                <img src="{{ asset('images/' . $module['image']) }}" width="30" class="img-fluid" alt="">
                            </div>
                            <div class="text-center">
                                <h6 class="card-title">{{ $module['name'] }}</h6>
                                <h6 class="card-title p">
                                    @php
                                        $count = \App\Models\registration::where('status', $module['queue'])->count();
                                        echo $count;
                                    @endphp
                                </h6>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endif
    @endforeach
</div>

<!-- Weekly Patients Graph -->
<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info text-white">Number of Patients in the Last 7 Days</div>
            <div class="card-body">
                <canvas id="weeklyPatientsChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('weeklyPatientsChart').getContext('2d');
    var weeklyPatientsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($week_labels) !!}, 
            datasets: [{
                label: 'Patients',
                data: {!! json_encode($week_data) !!}, 
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection


