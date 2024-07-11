<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<link rel="stylesheet" href="css/dashboard.css">
<script src="js/sweetalert.min.js"></script>
<script>
  const token = localStorage.getItem('access_token');
  if(!token){
    window.location.href = '/login';
  }
</script>
</head>

<div class="header">
    <h2>WELCOME</h2>
</div>

<div class="sidebar">
    <ul>
      <li>
      <a href="/dashboard">Dashboard</a>
      </li>
      <li>
      <a href="/user">Users</a>
      </li>
      <li>
        <a href="#">Products</a>
      </li>
      <li>
        <a href="showcategory">Categories</a>
      </li>
      <li>
        <a href="/productlist">Products</a>
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

</script>