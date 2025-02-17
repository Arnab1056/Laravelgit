<!-- resources/views/pharmacies/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>All Pharmacies</h1>
    <a href="{{ route('pharmacies.create') }}" class="btn btn-primary">Add Pharmacy</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pharmacies as $pharmacy)
                <tr>
                    <td>{{ $pharmacy->name }}</td>
                    <td>{{ $pharmacy->address }}</td>
                    <td>{{ $pharmacy->phone }}</td>
                    <td>{{ $pharmacy->email }}</td>
                    <td>
                        <a href="{{ route('pharmacies.edit', $pharmacy->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('pharmacies.destroy', $pharmacy->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection