@extends('layout')

@section('content')
    <div class="container text-center mt-5">
        <h2>Are You</h2>
        <div class="d-flex justify-content-center mt-4" style="gap: 20px;">
            <a href="{{ route('login') }}" class="btn btn-primary">Medicine Maker</a>
            <a href="{{ route('route2') }}" class="btn btn-secondary">User</a>
            <a href="{{ route('route3') }}" class="btn btn-success">Pharmaciest</a>
        </div>
    </div>
@endsection