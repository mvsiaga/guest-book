@extends('layouts.app')

@section('content')
@include('layouts.buttons', ['back' => route('guests.index'), 'add_guest' => false])

<div class="card">
  <h5 class="card-header">Create New Guest</h5>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('guests.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="first_name">First name</label>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" placeholder="First name" value="{{ old('first_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last name</label>
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" placeholder="Last name" value="{{ old('last_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone number</label>
                        <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Phone number" value="{{ old('phone_number') }}">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                            <option value="">Select gender</option>
                            @foreach($genders as $gender)
                            <option value="{{ $gender['value'] }}" @if(old('gender') == $gender['value']) selected @endif>{{ $gender['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="1234 Main St" value="{{ old('address') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection