@extends('medicines.layout')

@section('content')

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow-lg w-50">
            <h2 class="text-center mb-4">Add New Medicine</h2>
            <form action="{{ route('medicines.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label>Date</label>
                    <input type="date" name="date" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label>Details</label>
                    <textarea name="detail" class="form-control" rows="4" required></textarea>
                </div>

                <div class="form-group mb-3">
                    <label>Selled</label>
                    <input type="number" name="selled" class="form-control" required>
                </div>

                <div class="form-group mb-4">
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="form-control" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Add Medicine</button>
                </div>
            </form>
        </div>
    </div>

@endsection