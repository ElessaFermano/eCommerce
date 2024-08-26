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
        <div class="icon">
            <div id="cartItem"></div>
            <a class="user" href="#">
                <img src="{{ asset('image/profile.png') }}" alt="">
                <span id="userName"></span>
            </a>
            <a href="#" class="logout"></a>
        </div>
    </div>
    
    <div class="cart-container">
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Php {{ $item->product->price }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-container">
            @if ($total)
            <div class="">Subtotal:</div>
            <h3 class="total-label">Php {{ $total }}</h3>
            @else
            <center>
                <h2><b>Your cart is empty.</b></h2>
            </center>
            @endif
        </div>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf

            <input type="hidden" name="user_id" id="user_id">

            <h4>SPECIFIC ADDITIONAL ADDRESS</h4>
            <div class="form-group">
                <label for="country">Country:</label>
                <input type="text" id="country" name="country" value="Philippines" required>
            </div>
            <div class="form-group">
                <label for="province">Province:</label>
                <select id="province" name="shipping_id" required>
            @if(count($provinces) > 0)
                @foreach($provinces as $province)
                    <option value="{{ $province->id }}" data-fee="{{ $province->fee }}">{{ $province->province }}</option>
                @endforeach
            @else
        <option>No provinces available</option>
    @endif
</select>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" required>
            </div>
            <div class="form-group">
                <label for="barangay">Barangay:</label>
                <input type="text" id="barangay" name="brgy" required>
            </div>
            <div class="form-group">
                <label for="zipcode">Zipcode:</label>
                <input type="number" id="zipcode" name="zipcode" required>
            </div>
            <div class="form-group">
                <label for="subtotal">Subtotal:</label>
                <input type="number" id="subtotal" name="subtotal" value="{{ $total }}" readonly>
            </div>
            <div class="form-group">
                <label for="shipping_fee">Shipping Fee:</label>
                <input type="text" id="shipping" name="shipping_fee" readonly>
            </div>
            <div class="form-group">
                <label for="total_amount">Total Amount:</label>
                <input type="number" step="0.01" id="total_amount" name="total_amount" readonly>
            </div>
            <div class="form-group">
                <label for="payment_method">Payment Method:</label>
                <select id="payment_method" name="payment_method" required>
                    <option value="COD">Cash on Delivery (COD)</option>
                    <option value="gcash">Gcash</option>
                </select>
            </div>
            <div class="checkout-container">
                <button type="submit" class="submit-button">PLACE ORDER</button>
            </div>
        </form>
    </div>

<script src={{asset("js/cart.js")}}></script>
</body>
</html>

