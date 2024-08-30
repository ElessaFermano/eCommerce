@extends('dashboard')
@section('content')

<div class="container">
    <div class="h">
        <h3>LIST OF ALL ORDERS</h3>
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Customer Name</th>
                        <th>Shipping Address</th>
                        <th>Payment Method</th>
                        <th>Number of Products</th>
                        <th>Total Amount</th>
                        <th>Date</th>
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
                            <td>{{ $loop->iteration + $counter }}</td>
                            <td>{{ $order->user->first_name . " " . $order->user->last_name }}</td>
                            <td>{{ $order->shippingAddress->brgy . " " . $order->shippingAddress->city . " " . $order->shippingAddress->zipcode }}</td>
                            <td>{{ $order->payment_method }}</td>
                            <td>{{ $order->product_count }}</td>
                            <td>{{ $order->total_amount }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->first_order_date)->format('F d, Y h:i A') }}</td> 
                            <td>
                                <form action="{{ route('orders.updateStatus', $order->user_id) }}" method="POST">
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
                                <form id="delete-form-{{ $order->user_id }}" action="{{ route('orders.destroy', $order->user_id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')        
                                    <button type="button" class="deleteButton" onclick="confirmDelete({{ $order->user_id }})">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">{{ $orders->links() }}</div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(orderId) {
        Swal.fire({
            title: 'Are you sure you want to delete?',
            text: "You won't be able to recover this!",
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
