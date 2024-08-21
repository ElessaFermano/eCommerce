<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="{{asset('css/cart.css')}}">
    <link rel="stylesheet" href="{{asset('css/welcome.css')}}">
    <link rel="icon" href="data:,">
</head>
<script>
let home =localStorage.getItem('current_id');

if(home){
    document.addEventListener('click', function(){
        document.getElementById('home').href = '/customer/' + home;
    })
   
}
</script>
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
            <div id="cartItem"> 
            </div>
           
            <a class="user" href="#">
                <img src={{asset("image/profile.png")}} alt="">
                <span id="userName"></span>
            </a>

            <a href="#" onclick="logout()" class="logout">Logout</a>
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
            <td>{{ $item->quantity }} </td>
            <td>Php {{ $item->product->price }}</td>
        </tr>
        
        @endforeach
        </tbody>
    </table>

    <div class="total-container">
     @if ($total)
    
     <div class="total-label"> Total: 
       <h3> Php {{ $total }}  </h3>
       </div>
     @else
     <center>
        <h2> <b>Your cart is empty.</b> </h2>
        <a href="/" class="browse">Browse Products</a>
     </center>
        
     @endif
            
    </div>
    <br><br><br>
    <form action="#" method="POST">
    @csrf
    <div class="form-group">
        <label for="country">Country:</label>
        <input type="text" id="country" name="country" required>
    </div>

    <div class="form-group">
        <label for="province">Province:</label>
        <input type="text" id="province" name="province" required>
    </div>

    <div class="form-group">
        <label for="city">City:</label>
        <input type="text" id="city" name="city" required>
    </div>

    <div class="form-group">
        <label for="barangay">Barangay:</label>
        <input type="text" id="barangay" name="barangay" required>
    </div>

    <div class="form-group">
        <label for="zipcode">Zipcode:</label>
        <input type="number" id="zipcode" name="zipcode" required>
    </div>

    <div class="form-group">
        <label for="total_price">Total Price:</label>
        <input type="number" step="0.01" id="total_price" name="total_price" required>
    </div>

    <div class="form-group">
        <label for="payment_method">Payment Method:</label>
        <select id="payment_method" name="payment_method" required>
            <option value="COD">Cash on Delivery (COD)</option>
            <option value="credit_card">Gcash</option>
        </select>
    </div>
    
    <div class="checkout-container"> <a href="/checkout" class="checkoutButton">CHECKOUT</a> </div>
   
    <!-- <button type="submit" class="submit-button">Submit</button> -->
</form>
    <div class="checkout-container">
        <!-- <a href="/checkout" class="checkoutButton">CHECKOUT</a> -->
    </div>
</div>

<style>
    form {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

input[type="text"],
input[type="number"],
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

input[type="text"]:focus,
input[type="number"]:focus,
select:focus {
    border-color: #007bff;
    outline: none;
}

.submit-button {
    background-color: #007bff;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    width: 100%;
}

.submit-button:hover {
    background-color: #0056b3;
}

</style>
</body>
</html>

  