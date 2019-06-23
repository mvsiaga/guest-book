@extends('layouts.app')

@section('content')
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            Guest Book
        </div>

        <div>
            <a href="{{ route('guests.index') }}" class="btn btn-light">Backend</a>
            <a href="{{ route('guests.frontend.index') }}" class="btn btn-light">Frontend</a>
        </div>
    </div>
</div>
@endsection