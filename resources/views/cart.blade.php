<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <style>
        /* Existing styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        .cart-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #dddddd;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-name {
            font-weight: bold;
            color: #333333;
        }

        .item-quantity-price {
            display: flex;
            align-items: center;
            color: #777777;
        }

        .item-quantity {
            font-weight: bold;
            margin-right: 5px;
            color: #333333;
        }

        .item-price {
            color: #ff6b6b;
            margin-right: 20px;
        }

        .delete-button {
            padding: 5px 10px;
            background-color: #dc3545;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .delete-button:hover {
            background-color: #c82333;
        }

        .total-container {
            margin-top: 20px;
            text-align: right;
        }

        .total-label {
            font-weight: bold;
            color: #333333;
            font-size: 18px;
        }

        .total-value {
            font-size: 20px;
            font-weight: bold;
            color: #ff6b6b;
        }

        /* Styles for the PLACE ORDER button */
        .place-order-button {
            display: inline-block;
            padding: 12px 25px;
            background-color: #28a745;
            color: #ffffff;
            text-align: center;
            font-weight: bold;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .place-order-button:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }

        .place-order-button:active {
            background-color: #1e7e34;
            transform: translateY(0);
        }

        .place-order-button:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(72, 180, 97, 0.4);
        }

        /* Align the button */
        .place-order-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
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

  