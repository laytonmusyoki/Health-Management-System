@extends('staff.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Track Expiry - {{ $drug->name }}</h2>

    <div class="card">
        <div class="card-header">
            Drug Details
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $drug->name }}</p>
            <p><strong>Category:</strong> {{ $drug->category }}</p>
            <p><strong>Total Stock:</strong> {{ $drug->stocks->sum('quantity_mL') }} mL</p>
        </div>
    </div>

    <h3 class="mt-4">Expiry Dates</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Batch Number</th>
                <th>Quantity (mL)</th>
                <th>Expiry Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($drug->stocks as $stock)
                <tr>
                    <td>{{ $stock->batch_number }}</td>
                    <td>{{ $stock->quantity_mL }} mL</td>
                    <td>{{ \Carbon\Carbon::parse($stock->expiry_date)->format('d M Y') }}</td>
                    <td>
                        @if(\Carbon\Carbon::parse($stock->expiry_date)->isPast())
                            <span class="badge bg-danger">Expired</span>
                        @elseif(\Carbon\Carbon::parse($stock->expiry_date)->diffInDays(now()) <= 30)
                            <span class="badge bg-warning">Expiring Soon</span>
                        @else
                            <span class="badge bg-success">Valid</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('drugs.index') }}" class="btn btn-primary mt-3">Back to Drugs List</a>
</div>
@endsection
