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
    <h3>LIST OF ALL ORDERS</h3>
    <br><br>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Customer Name</th>
                <th>Shipping Address</th>
                <th>Payment Method</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @php
            $counter = ($orders->currentPage() - 1) * $orders->perPage();
        @endphp
            @foreach($orders as $order)
                <tr>
                <td>{{ $loop->iteration + $counter}}</td>
                    <td>{{ $order->user->first_name . " " . $order->user->last_name}}</td>
                    <td>{{ $order->shippingAddress->brgy . " " . $order->shippingAddress->city . " " . $order->shippingAddress->zipcode}}</td>
                    <td>{{ $order->payment_method }}</td>
                    <td>{{ $order->total }}</td>
                    <td>
                        <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()">
                                <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                                <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <a href="#" class="btn btn-danger" onclick="confirmDelete({{ $order->id }})">Delete</a>
                        <form id="delete-form-{{ $order->id }}" action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="pagination">{{$orders->links()}}</div>
</div>
<script>
    function confirmDelete(orderId) {
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
                document.getElementById('delete-form-' + orderId).submit();
            }
        })
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
@endsection
