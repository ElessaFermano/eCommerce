@extends('dashboard')
@section('content')

<div class="container">
    <div class="h">
        <h3>SHIPPING FEES</h3>
       
        <table class="table">
           <thead>
            <tr>
                <th>Id</th>
                <th>Province</th>
                <th>Fee</th>
                <th>Actions</th>
            </tr>
           </thead>
           <tbody>
           @php
                $counter = ($shippings->currentPage() - 1) * $shippings->perPage();
            @endphp
               @foreach($shippings as $shipping)
               <tr>
               <td>{{ $loop->iteration + $counter}}</td>
                   <td>{{ $shipping->province }}</td>
                   <td>{{ $shipping->fee }}</td>
                   <td>
                       <a href="{{ route('shipping.edit', $shipping->id) }}" class="editButton">Edit</a>

                       <form id="delete-form-{{ $shipping->id }}" action="{{ route('shipping.destroy', $shipping->id) }}" method="POST" style="display:inline;">
                           @csrf
                           @method('DELETE')
                           <button type="button" class="deleteButton" onclick="confirmDelete({{ $shipping->id }})">Delete</button>
                       </form>
                   </td>
               </tr>
               @endforeach
           </tbody>
        </table>
        <div class="pagination">{{$shippings->links()}}</div>
    </div>   
    <a href="{{ route('shipping.create') }}" class="addButton">Add New</a>
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
