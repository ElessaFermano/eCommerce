@extends('dashboard')
@section('content')
<link rel="stylesheet" href="{{ asset('css/user.css') }}">
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<br><br>
<div class="container">
    <div class="h">
        <h3 class="user">USERS TABLE</h3>
        <table class="table">
           <thead>
            <tr>
                <th>id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Course</th>
                <th>Address</th>
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
                   <td>{{ $user->address }}</td>
                   <td>{{ $user->phone }}</td>
                   <td>
                       <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('image/profdef.jpg') }}" alt="Profile" width="50px" height="50px">
                   </td>
                    
                   <td>{{ $user->email }}</td>
                   <td>
                       <button>Edit</button>
                       <button>Delete</button>
                   </td>
               </tr>
               @endforeach
           </tbody>
        </table>
     
    </div>
</div>
@endsection
