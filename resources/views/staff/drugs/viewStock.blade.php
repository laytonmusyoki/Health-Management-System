@extends('staff.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Stock Details for {{ $drug->name }}</h2>

    <a href="{{ route('drugs.index') }}" class="btn btn-secondary mb-3">Back to Drugs List</a>

    <!-- Stock Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Batch Number</th>
                <th>Quantity</th> 
                <th>Expiry Date</th>
                <th>Supplier</th>
            </tr>
        </thead>
        <tbody>
            @forelse($drug->stocks as $stock)
                <tr>
                    <td>{{ $stock->batch_number }}</td>
                    <td>
                        @if ($drug->drug_type === 'tablet')
                            {{ $stock->tablets_added }} tablets
                        @elseif ($drug->drug_type === 'liquid')
                            {{ $stock->quantity_mL }} mL
                        @elseif ($drug->drug_type === 'bottle')
                            {{ $stock->bottles_added }} bottles
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($stock->expiry_date)->format('d M Y') }}</td>
                    <td>{{ $stock->supplier }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No stock available for this drug.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Drug Stock Chart -->
    <div class="card mt-5">
        <div class="card-header bg-info text-white">Stock Quantities of {{ $drug->name }}</div>
        <div class="card-body">
            <canvas id="drugStockChart"></canvas>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('drugStockChart').getContext('2d');

    // Create gradient
    var gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(54, 162, 235, 0.6)');
    gradient.addColorStop(1, 'rgba(54, 162, 235, 0.1)');

    // Create chart
    var drugStockChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($drug->stocks->pluck('batch_number')), // Batch numbers
            datasets: [{
                label: 'Stock Quantities',
                data: @json($drug->stocks->map(function($stock) use ($drug) {
                    if ($drug->drug_type === 'tablet') {
                        return $stock->tablets_added;
                    } elseif ($drug->drug_type === 'liquid') {
                        return $stock->quantity_mL;
                    } elseif ($drug->drug_type === 'bottle') {
                        return $stock->bottles_added;
                    }
                })),
                backgroundColor: gradient,  // Gradient background color for the bars
                borderColor: 'rgba(54, 162, 235, 1)', // Border color
                borderWidth: 1,
                hoverBackgroundColor: 'rgba(54, 162, 235, 0.8)', // Hover effect on bar
                hoverBorderColor: 'rgba(54, 162, 235, 1)', // Hover border effect
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 10, 
                        font: {
                            size: 14,
                            family: 'Arial, sans-serif',
                            weight: 'bold'
                        }
                    },
                    grid: {
                        display: true,
                        color: 'rgba(0, 0, 0, 0.1)', 
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 14,
                            family: 'Arial, sans-serif',
                            weight: 'bold'
                        }
                    },
                    grid: {
                        display: false // Remove grid lines for x-axis
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        font: {
                            size: 16,
                            family: 'Arial, sans-serif',
                            weight: 'bold'
                        },
                        color: '#333' // Darker legend color for better contrast
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw + ' units'; // Custom tooltip label
                        }
                    },
                    backgroundColor: 'rgba(0, 0, 0, 0.7)', // Darker tooltip background
                    titleColor: '#fff', // White title color
                    bodyColor: '#fff' // White body text
                }
            }
        }
    });
</script>
@endsection
