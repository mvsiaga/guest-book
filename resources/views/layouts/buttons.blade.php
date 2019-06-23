<div class="card mt-5 mb-4">
  <div class="card-body">
    <a href="{{ $back }}" class="btn btn-secondary">Back</a>
    @if($add_guest)
      <a href="{{ route('guests.create') }}" class="btn btn-success">Add Guest</a>
    @endif
  </div>
</div>

@if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $error }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endforeach
@endif

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif