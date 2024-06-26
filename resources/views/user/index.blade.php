@extends('dashboard')
@section('content')
<link rel="stylesheet" href="css/user.css">
<script src="js/sweetalert.min.js"></script>
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
                <th>Image</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
           </thead>
           <tbody id="tableBody">
         
           </tbody>
        </table>
       <button id="addUserButton" type="button">Add User</button>
    </div>
</div>

<script>

fetch('/api/user', {
    method: 'GET'
}).then(response => response.json())
  .then(data => {
    let tableBody = document.getElementById('tableBody');
    tableBody.innerHTML = '';

    data.forEach(user => {
        let tableRow = `
            <tr>
                <td>${user.id}</td>
                <td>${user.firstname}</td>
                <td>${user.lastname}</td>
                <td>${user.role}</td>
                <td>${user.address}</td>     
                <td>${user.phone}</td>
                <td>${user.email}</td>
                <td>
                    <a class="editUserButton" href="updateUser/${user.id}">Edit</a>
                    <button class="deleteUserButton" data-id="${user.id}">Delete</button>
                </td>
            </tr>`;
        tableBody.innerHTML += tableRow;
    });

    document.getElementById('addUserButton').addEventListener('click', function() {
        window.location.href = '/user/create';
});

    document.querySelectorAll('.deleteUserButton').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this user!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    fetch(`/api/user/${userId}`, {
                        method: 'DELETE'
                    }).then(response => response.json())
                      .then(data => {
                            window.location.reload();             
                    });
                }
                });
             });
        });
    });

</script>
@endsection
