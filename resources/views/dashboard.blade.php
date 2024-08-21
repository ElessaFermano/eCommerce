<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>

<link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
<link rel="stylesheet" href="{{asset('css/product.css')}}">
<link rel="stylesheet" href="{{ asset('css/user.css') }}">

<script>
  const token = localStorage.getItem('access_token');
  const role =localStorage.getItem('role')
  if(role == 'customer'){
    window.location.href = '/';
  }
  if(!token){
    window.location.href = '/login';
  }
</script>
</head>
<body>

<div class="header">
    <h2>WELCOME</h2>
</div>

<div class="sidebar">
    <ul>
      <li>
      <a href="/dashboard">Dashboard</a>
      </li>
      <li>
      <a href="/users">Users</a>
      </li>
      <li>
        <a href="/products">Products</a>
      </li>
      <li>
        <a href="/categories">Categories</a>
      </li>
      <li>
        <a href="#">Suppliers</a>
      </li>
      <li>
        <a href="#">Orders</a>
      </li>
      <li>
        <a href="#">Reviews</a>
      </li>
      <li>
        <a href="#" onclick="logout()">Logout</a>
      </li>
    </ul>
</div>

<div>
  @yield('content')
</div>

<script>
  function logout() {
    swal({
        title: "Are you sure you want to logout?",
        icon: "warning",
        buttons: ["Cancel", "Logout"],
        dangerMode: true,
    })
    .then((ifLogout) => {
        if (ifLogout) {
            localStorage.removeItem('access_token');
            window.location.href = '/';
        } else {
          window.location.href = '/dashboard';
        }
    });
}


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

<script src={{asset("js/sweetalert.min.js")}}></script> 

</body>
</html>