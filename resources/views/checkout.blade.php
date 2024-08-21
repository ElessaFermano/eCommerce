<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
            <option value="credit_card">Credit Card</option>
            <option value="paypal">PayPal</option>
        </select>
    </div>

    <button type="submit" class="submit-button">Submit</button>
</form>
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