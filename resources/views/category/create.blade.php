@extends('dashboard')
@section('content')
<div class="container">
    <h2>ADD NEW CATEGORY</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name">
        </div>

        <button type="submit" class="addProduct">Save</button>
    </form>
</div>
@endsection