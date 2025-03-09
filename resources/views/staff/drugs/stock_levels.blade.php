@extends('staff.app')
@section('title', 'Stock Levels')

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Stock Levels</div>
</div>

<div class="card">
    <div class="card-header">
        <h5>Current Stock Levels</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Bottles in Stock</th>
                    <th>Total Quantity (mL)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($drugs as $drug)
                <tr>
                    <td>{{ $drug->name }}</td>
                    <td>{{ $drug->bottles_in_stock }}</td>
                    <td>{{ $drug->total_quantity_mL }} mL</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
