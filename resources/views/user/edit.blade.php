@extends('dashboard')
@section('content')
<script>
    const tokenn = localStorage.getItem('access_token');
    if (!tokenn) {
        window.location.href = "/";
    }
</script>
<link rel="stylesheet" href="{{ asset('css/useredit.css') }}">
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<br><br>
<div class="container">
    <div class="h">
        <h3 class="user">EDIT USER</h3>

        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" required>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" required>
            </div>

            <div class="form-group">
                <label for="role">Role:</label>
                <input type="text" name="role" class="form-control" value="{{ $user->role }}" required>
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" name="address" class="form-control" value="{{ $user->address }}" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>

            <div class="form-group">
                <label for="profile_pic">Profile Picture:</label>
                <input type="file" name="profile_pic" class="form-control">
                <img src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('image/profdef.jpg') }}" alt="Profile" width="100px" height="100px" style="border-radius: 50%;">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
