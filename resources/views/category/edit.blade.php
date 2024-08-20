@extends('dashboard')
@section('content')
<script>
    const tokenn = localStorage.getItem('access_token');
    if (!tokenn) {
        window.location.href = "/";
    }
</script>
<link rel="stylesheet" href="{{ asset('css/useredit.css') }}">
<br><br>
<div class="container">
    <div class="h">
        <h3 class="user">EDIT CATEGORY</h3>
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') 
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>

@endsection
