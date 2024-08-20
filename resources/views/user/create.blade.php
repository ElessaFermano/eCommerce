@extends('dashboard')
@section('content')
<link rel="stylesheet" href="{{ asset('css/usercreate.css') }}"></div>

<div class="container">
    <h3>ADD NEW USER</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" name="address" id="address" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="number" name="phone" id="phone" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="profile_pic">Profile Picture:</label>
            <input type="file" name="profile_pic" id="profile_pic" class="form-control">
        </div>
        <input type="hidden" name="role" value="supplier">
        <button type="submit"> Add User</button>
    </form>
</div>
@endsection
