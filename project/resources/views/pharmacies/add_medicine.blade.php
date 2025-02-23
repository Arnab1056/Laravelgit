@extends('pharmacies.layout')

@section('content')
    <div class="container">
        <h1>All Medicines</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Details</th>
                    <th>Sold</th>
                    <th>Quantity</th>
                    <th>Pharmacy</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medicines as $medicine)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $medicine->name }}</td>
                        <td>{{ $medicine->date }}</td>
                        <td>{{ $medicine->detail }}</td>
                        <td>{{ $medicine->selled }}</td>
                        <td>{{ $medicine->quantity }}</td>
                        <td>{{ $medicine->pharmacy->name ?? 'N/A' }}</td>
                        <td>
                            <a class="btn btn-success" href="{{ route('pharmacies.add_medicine_details', $medicine->id) }}">Add</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="container">
        <h1>Add Medicine</h1>
        <form action="{{ route('pharmacies.store_medicine') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="medicine_id">Medicine</label>
                <select name="medicine_id" id="medicine_id" class="form-control">
                    @foreach($medicines as $medicine)
                        <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Medicine</button>
        </form>
    </div>
@endsection
