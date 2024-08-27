@extends('dashboard')
@section('content')
<div class="container">
    <h2>ADD NEW SHIPPING</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('shipping.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="province">Province</label>
            <input type="text" name="province" class="form-control" id="province">
        </div>
        <div class="form-group">
            <label for="fee">Fee</label>
            <input type="number" name="fee" class="form-control" id="fee">
        </div>

        <button type="submit" class="addShipping">Save</button>
    </form>
</div>
@endsection