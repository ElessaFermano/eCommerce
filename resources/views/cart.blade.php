<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
<link rel="stylesheet" href="{{asset('css/cart.css')}}">
</head>
<body>
<div class="cart-container">
    @foreach($cartItems as $item)
        <div class="cart-item">
            <!-- Access the related product's attributes -->
            <div class="item-name">{{ $item->product->name }}</div>
            <div class="item-quantity-price">
                <span class="item-quantity">{{ $item->quantity }} x</span>
                <span class="item-price">Php {{ $item->product->price }}</span>
                
            </div>
        </div>
    @endforeach

    <div class="total-container">
        <span class="total-label">Total:</span>
     
        Php {{ $total }}
        <span class="total-value">
          
        </span>
          
    </div>

    <div class="place-order-container">
        <a href="#" class="place-order-button">PLACE ORDER</a>
    </div>
</div>
</body>
</html>

  