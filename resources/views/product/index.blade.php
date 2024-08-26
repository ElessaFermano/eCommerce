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
<div class="container">
    <h1>Products List</h1>
    <a href="{{ route('products.create') }}" class="addProduct">Add New Product</a>
    <br><br>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                       <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('image/profdef.jpg') }}" alt="Product Image" width="50px" height="50px" style="border-radius: 50%;">
                   </td>
                    <td>{{ $product->category->name }}</td>
                  <td>
                       <a href="{{ route('products.edit', $product->id) }}" class="editButton">Edit</a>

                       <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                           @csrf
                           @method('DELETE')
                           <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $product->id }})">Delete</button>
                       </form>
                   </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
@endsection
