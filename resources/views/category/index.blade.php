@extends('dashboard')
@section('content')
<link rel="stylesheet" href="{{asset('css/product.css')}}">
<script src="js/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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
<div class="container">
    <h1>Category List</h1>
    <a href="{{ route('categories.create') }}" class="addCategory">Add New Category</a>
    <br><br>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                       <a href="{{ route('categories.edit', $category->id) }}" class="editButton">Edit</a>
                   </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
