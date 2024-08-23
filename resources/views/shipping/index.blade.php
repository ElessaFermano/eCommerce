@extends('dashboard')
@section('content')

<br><br>
<div class="container">
    <div class="h">
        <h3 class="user">SHIPPING FEES</h3>
        <a href="{{ route('shipping.create') }}" class="addButton">Add</a>
        <br><br>
        <table class="table">
           <thead>
            <tr>
                <th>id</th>
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
        <div>{{$shippings->links()}}</div>
    </div>
</div>
@endsection
