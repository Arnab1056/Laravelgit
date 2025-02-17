@extends('medicines.layout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Medicine Management</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('medicines.create') }}"> Create New Medicine</a>
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Date</th>
                <th>Details</th>
                <th>Selled</th>
                <th>Quantity</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($medicines as $medicine)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $medicine->name }}</td>
                    <td>{{ $medicine->date }}</td>
                    <td>{{ $medicine->detail }}</td>
                    <td>{{ $medicine->selled }}</td>
                    <td>{{ $medicine->quantity }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('medicines.show', $medicine->id) }}">View</a>
                        <a class="btn btn-primary" href="{{ route('medicines.edit', $medicine->id) }}">Edit</a>
                        <form action="{{ route('medicines.destroy', $medicine->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <form action="{{ route('medicines.sell', $medicine->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-warning">Sell</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        {!! $medicines->links() !!}
    </div>

@endsection