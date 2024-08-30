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
       <div class="header">
        <h2>theeSHOP</h2>
        <ul>
            <li><a id="home">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="/login">Login</a></li>
        </ul>
        <div class="icon">
            <div id="cartItem"></div>
            <a class="user" href="#">
                <img src="{{ asset('image/profile.png') }}" alt="">
                <span id="userName"></span>
            </a>
            <a href="#" class="logout"></a>
        </div>
    </div>
    <div class="orderPage">
        <h1>My Orders</h1>

        @if($products->isEmpty())
            <p>You don't have orders yet.</p>
        @else
            <ul class="orderList">
                @foreach ($products as $product)
                <li>
                    <div class="orderContainer">
                        <div class="productImage">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image">
                        </div>
                        <div class="productDetails">
                            <span class="productName">Product Name: {{ $product->name }}</span><br>
                            <span class="productPrice">Product Price: {{ $product->price }}</span>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        @endif
    </div>
    
<script>

let home = localStorage.getItem('current_id');
if (home){
    document.getElementById('home').href = '/customer/' + home;
    }
    document.getElementById('user_id').value = home;

</script>
</body>
</html>
