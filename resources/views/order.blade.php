<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Orders</title>
</head>
<body>
    <h1>My Orders</h1>

    @if ($orders->count())
        <ul>
            @foreach ($orders as $order)
                <li>
                    Order ID: {{ $order->id }}<br>
                    Subtotal: Php {{ $order->subtotal }}<br>
                    Shipping Fee: Php {{ $order->shipping }}<br>
                    Total: Php {{ $order->total }}<br>
                    Status: {{ $order->status }}
                </li>
            @endforeach
        </ul>

        {{ $orders->links() }}
    @else
        <p>You have no orders yet.</p>
    @endif
</body>
</html>
