@extends('dashboard')
@section('content')

<div class="container">
    <h3>LIST OF ALL CATEGORIES</h3>
    <div class="table-responsive">
    <table class="table custom-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @php
            $counter = ($categories->currentPage() - 1) * $categories->perPage();
            @endphp
            @foreach($categories as $category)
                <tr>
                <td>{{ $loop->iteration + $counter}}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                       <a href="{{ route('categories.edit', $category->id) }}" class="editButton">Edit</a>
                       
                   </td>
                </tr>
            @endforeach
        </tbody>
    </table>  
    <div class="pagination">{{$categories->links()}}</div>
    <a href="{{ route('categories.create') }}" class="addButton">Add New</a>  
    </div>
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
        })
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
@endsection
