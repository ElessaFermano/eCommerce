<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Orders</title>
    <link rel="stylesheet" href="{{ asset('styles/css/order.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/css/cart.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/css/welcome.css') }}">
    <link rel="icon" href="data:,">
</head>
<body>
    <div class="orderPage">
        <h1>My Orders</h1>

        @if($products->isEmpty())
            <p>You don't have orders yet.</p>
        @else
            <ul>
                @foreach ($products as $product)
                <li>
                    <div class="orderContainer">
                        <span><img src="{{ asset('storage/' . $product->image) }}" alt="Product Image"></span><br><br>
                        <span>Product Name:</span> {{ $product->name }}<br>
                        <span>Product Price:</span> {{ $product->price }}<br>

                    </div>
                </li>
                @endforeach
            </ul>
        @endif
    </div>

    <script src="{{ asset('js/cart.js') }}"></script>
</body>
</html>
