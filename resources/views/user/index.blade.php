@extends('dashboard')
@section('content')

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
           @php
                $counter = ($users->currentPage() - 1) * $users->perPage();
            @endphp
               @foreach($users as $user)
               <tr>
               <td>{{ $loop->iteration + $counter}}</td>
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

                       <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                           @csrf
                           @method('DELETE')
                           <button type="button" class="deleteButton" onclick="confirmDelete({{ $user->id }})">Delete</button>
                       </form>
                   </td>
               </tr>
               @endforeach
           </tbody>
        </table>
        <div>{{$users->links()}}</div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    
     function confirmDelete(userId) {
        Swal.fire({
            title: 'Are you sure you want to delete?',
            text: "You won't be able to recover this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + userId).submit();
            }
        })
    }
</script>
@endsection
