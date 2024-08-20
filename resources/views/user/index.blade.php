@extends('dashboard')
@section('content')
<link rel="stylesheet" href="{{ asset('css/user.css') }}">
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/userindex.js')}}">
    const tokenn = localStorage.getItem('access_token');
    if (!tokenn) {
        window.location.href = "/";
    }
    fetch("http://127.0.0.1:8000/api/user", {
        method: "GET",
        headers: {
            Authorization: 'Bearer ' + localStorage.getItem('access_token'),
        }
    }).then(response => response.json())
    .then(response => {
        console.log(response);
        if (response.role != 'admin') {
            window.location.href = "/";
        }
    });
</script>
<br><br>
<div class="container">
    <div class="h">
        <h3 class="user">USERS TABLE</h3>
        <a href="{{ route('users.create') }}" class="addButton">Add User</a>
        <br><br>
        <table class="table">
           <thead>
            <tr>
                <th>id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Role</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Profile Picture</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
           </thead>
           <tbody>
               @foreach($users as $user)
               <tr>
                   <td>{{ $user->id }}</td>
                   <td>{{ $user->first_name }}</td>
                   <td>{{ $user->last_name }}</td>
                   <td>{{ $user->role }}</td>
                   <td>{{ $user->address }}</td>
                   <td>{{ $user->phone }}</td>
                   <td>
                       <img src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('image/profdef.jpg') }}" alt="Profile" width="50px" height="50px" style="border-radius: 50%;">
                   </td>
                   <td>{{ $user->email }}</td>
                   <td>
                       <a href="{{ route('users.edit', $user->id) }}" class="editButton">Edit</a>

                       <!-- Delete Button and Form -->
                       <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                           @csrf
                           @method('DELETE')
                           <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $user->id }})">Delete</button>
                       </form>
                   </td>
               </tr>
               @endforeach
           </tbody>
        </table>
    </div>
</div>
@endsection
