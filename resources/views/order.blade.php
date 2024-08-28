<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cart</title>
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="icon" href="data:,">
</head>
<body>
    <div class="header">
        <h2>theeSHOP</h2>
        <ul>
            <li><a id="home">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="/login">Login</a></li>
        </ul>
    </div>

    <div class="orderPage">
        <h1>My Orders</h1>
        <ul>
            @php
            use App\Models\Order;
            @endphp

            @foreach ($pr as $order)
            <li>
                <div class="orderContainer">
                    @php
                    $m = Order::where('product_id', $order->id);
                    $orderDetail = $m->first();
                    @endphp
                    <span><img src="{{asset('storage/'. $order->image)}}" alt="Product Image"></span><br><br>
                    <span>Product Name:</span> {{ $order->name }}<br>
                    <span>Product Price:</span> {{ $order->price }}<br>
                    <span>Quantity: </span> <br>
                </div>
            </li>
            @endforeach
            <div class="space" style="height:50px"></div>
            <span>Subtotal:</span> Php {{ $orderDetail->subtotal }}<br>
            <span>Shipping Fee:</span> Php {{ $orderDetail->shipping }}<br>
            <div class="total">
                <span class="total">Total:</span> Php {{ $orderDetail->total }}<br>
            </div>
            <div class="space" style="height:50px"></div>
            <span>Status:</span>
            <span class="order-status {{ strtolower($order->status) }}">{{ ucfirst($order->status) }}</span>
        </ul>
    </div>

    <style>
 
        h1 {
            text-align: center;
            color: #333;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        .orderContainer {
            background-color: whitesmoke;
            margin: 15px 0;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 3px 8px black;
            text-align: center;
        }

        li br {
            margin-bottom: 10px;
        }

        li span {
            font-weight: bold;
            color: black;
        }

        li .order-status {
            margin-top: 10px;
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
        }

        img {
            width: 60px;
            height: 60px;
            border: #333 0.5px solid;
        }

        .orderPage {
            max-width: 500px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .total {
            color: red;
        }
    </style>

    <script src={{asset("js/cart.js")}}></script>
</body>
</html>
