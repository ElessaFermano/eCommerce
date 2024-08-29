@extends('dashboard')
@section('content')

<div class="container">
    <div class="h">
        <h3>LIST OF ALL REVIEWS</h3>
        <table class="table">
           <thead>
            <tr>
                <th>Id</th>
                <th>User Name</th>
                <th>Product Name</th>
                <th>Comment</th>
                <th>Actions</th>
            </tr>
           </thead>
           <tbody>
           @php
                $counter = ($reviews->currentPage() - 1) * $reviews->perPage();
            @endphp
               @foreach($reviews as $review)
               <tr>
               <td>{{ $loop->iteration + $counter}}</td>
                   <td>{{ $review->user->first_name }}</td>
                   <td>{{ $review->product->name }}</td>
                   <td>{{ $review->comment }}</td>
                   <td>
                       <a href="{{ route('reviews.edit', $review->id) }}" class="editButton">Edit</a>

                       <form id="delete-form-{{ $review->id }}" action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display:inline;">
                           @csrf
                           @method('DELETE')
                           <button type="button" class="deleteButton" onclick="confirmDelete({{ $review->id }})">Delete</button>
                       </form>
                   </td>
               </tr>
               @endforeach
           </tbody>
        </table>
        <div>{{$reviews->links()}}</div>
    </div>
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
