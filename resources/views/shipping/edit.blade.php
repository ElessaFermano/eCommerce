@extends('dashboard')
@section('content')
<script>
    const tokenn = localStorage.getItem('access_token');
    if (!tokenn) {
        window.location.href = "/";
    }
</script>
<br><br>
<div class="container">
    <div class="h">
        <h3 class="user">EDIT SHIPPING</h3>
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <form action="{{ route('shipping.update', $shipping->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') 
    <div class="form-group">
        <label for="province">Province:</label>
        <input type="text" name="province" class="form-control" value="{{ $shipping->province }}" required>
    </div>
    <div class="form-group">
        <label for="fee">Fee:</label>
        <input type="text" name="fee" class="form-control" value="{{ $shipping->fee }}" required>
    </div>

    <button type="submit" class="addButton">Update</button>
</form>

@endsection
