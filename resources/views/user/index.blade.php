@extends('dashboard')
@section('content')
<script>
   const tokenn = localStorage.getItem('access_token');
    if (!tokenn) {
        window.location.href = "/";
    }
    fetch("/api/user", {
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
        <h3>LIST OF ALL USERS</h3>
            <div class="table-responsive">
                <table class="table custom-table">
                <thead>
                <tr>
                    <th>id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Role</th>
                    <th>Phone Number</th>
                    <th>Profile</th>
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
                       <td>{{ $user->phone }}</td>
                       <td>
                           <img src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('image/profdef.jpg') }}" alt="Profile" class="profile-img">
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
        </div> 
        <div class="pagination">{{$users->links()}}</div>
    </div>
    <a href="{{ route('users.create') }}" class="addButton">Add User</a>

</div>
<script>

function confirmDelete(userId) {
    Swal.fire({
        title: 'Are you sure you want to delete?',
        text: "You won't be able to recover this!",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + userId).submit();
        }
    });
}
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
