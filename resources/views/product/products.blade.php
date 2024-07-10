@extends('dashboard')

@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<style>
    .container {
        display: flex;
        justify-content: center;
    }

    .card {
        width: 80%; /* Adjust as needed */
        margin-top: 50px; /* Adjust spacing from the top */
    }
</style>

<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center">
            <h1>Products</h1>
        </div>
        <div class="card-body">
            <table class="table table-striped text-center"> <!-- Added 'text-center' to center align table content -->
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Release Date</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <!-- Add your table rows (tbody and tr elements) here -->
            </table>
        </div>
    </div>
</div>
@endsection
