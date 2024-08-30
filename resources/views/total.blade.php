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
<div class="dashboard-stats">
    <div class="stat">
        <h3>Total Users</h3>
        <p>{{ $totalUsers }}</p>
    </div>
    <div class="stat">
        <h3>Total Orders</h3>
        <p>{{ $totalOrders }}</p>
    </div>
    <div class="stat">
        <h3>Total Reviews</h3>
        <p>{{ $totalReviews }}</p>
    </div>
    <div class="stat">
        <h3>Total Products</h3>
        <p>{{ $totalProducts }}</p>
    </div>
    <div class="stat">
        <h3>Total Categories</h3>
        <p>{{ $totalCategories }}</p>
    </div>
</div>

</div>
@endsection
