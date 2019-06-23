@extends('layouts.app')

@section('content')
@include('layouts.buttons', ['back' => route('home'), 'add_guest' => true])

<div class="card mb-5">
  <h5 class="card-header">Guest List</h5>
    <div class="card-body p-0">
        <table class="table table-striped table-hover table-responsive-md">
        <thead>
            <tr>
            <th scope="col">First name</th>
            <th scope="col">Last name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone number</th>
            <th scope="col">Gender</th>
            <th scope="col">Address</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($guests as $guest)
            <tr>
            <td>{{ $guest->first_name }}</td>
            <td>{{ $guest->last_name }}</td>
            <td>{{ $guest->email }}</td>
            <td>{{ $guest->phone_number }}</td>
            <td>{{ $guest->gender_value }}</td>
            <td>{{ Str::limit($guest->address, 20, '...') }}</td>
            <td>
              <a href="{{ route('guests.edit', $guest->id) }}" class="btn btn-primary">Edit</a>
              <form action="{{ route('guests.destroy', $guest->id) }}" method="POST" onsubmit="return confirm('Are your sure?');" class="float-right ml-n2">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </td>
            @endforeach
        </tbody>
        </table>
  </div>
</div>

@endsection