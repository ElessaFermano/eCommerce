<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>

<link rel="stylesheet" href="{{asset('css/dashboard.css')}}">

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
<style>


</style>
</head>
<body>

<div class="header">
    <h2>ADMIN</h2>
    <div class="header-right">
        
        <div class="notification-icon">
            <a href="/orders">
                <img src="{{ asset('image/notification.png') }}" alt="Notifications">
                <span class="badge" id="notification-badge">0</span>
            </a>
            <a href="#" onclick="logout()" class="logout" >Logout</a>
        </div>
    </div>
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
        <a href="/orders">Orders</a>
      </li>
      <li>
        <a href="/shipping">Shipping Fees</a>
      </li>
      <li>
        <a href="/reviews">Reviews</a>
      </li>
      <li>
        <a href="/suppliers">Suppliers</a>
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

</script>

<script src={{asset("js/sweetalert.min.js")}}></script>
</body>
</html>