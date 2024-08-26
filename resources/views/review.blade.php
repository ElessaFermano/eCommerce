<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cart</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="icon" href="data:,">
</head>
<style>
    .review-section {
    background-color: #f8f9fa;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 20px;
    width: 400px;
    margin: 20px auto;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
}

.review-section img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    margin-bottom: 15px;
}

.review-section h3 {
    font-size: 18px;
    color: #333;
    margin-bottom: 10px;
}

.review-section p.product-name {
    font-size: 16px;
    color: #555;
    margin: 0;
}

.review-section p.product-price {
    font-size: 14px;
    color: #888;
    margin: 5px 0 15px 0;
}

.review-section textarea {
    width: 100%;
    height: 80px;
    padding: 10px;
    font-size: 14px;
    border-radius: 4px;
    border: 1px solid #ccc;
    margin-bottom: 10px;
    resize: none;
}

.review-section button.submit-comment {
    background-color: #28a745;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s ease;
    width: 100%;
}

.review-section button.submit-comment:hover {
    background-color: #218838;
}

.review-section .review-content {
    text-align: left;
}

</style>
<!-- <script>
    document.addEventListener('DOMContentLoaded', function(){

        fetch('http://127.0.0.1:8000/api/user', {
            method: 'GET',
            headers: {
                Authorization: 'Bearer ' +localStorage.getItem('access_token'),
                accept: 'application/json',
            }
        }).then(response => response.json())
        .then(response => {
            document.getElementById('currentUser').innerHTML = response.first_name;
        })
    });
</script> -->
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
    <div class="review-section" id="review">
    <img src="{{asset('storage/'. $product->image)}}" alt="Product Image">
    <div class="review-content">
        <p class="product-name">{{ucfirst($product->name)}}</p>
        <p class="product-price">Php {{$product->price}}</p>
        <div>
    @foreach($reviews as $review)
    
    <h3 > {{$review->user->first_name}}</h3>
        <p>{{ $review->comment }}</p>
        <hr>
    @endforeach
</div>

        <h3>Leave a Comment</h3>
        <form action="{{route('reviews.store')}}" method="post">
            @csrf
            <input type="hidden" name="user_id" id="user_id">
            <input type="hidden" name="product_id" value="{{$product->id}}">
        <textarea id="comment" name="comment" placeholder="Write your comment here..."></textarea>
        <button class="submit-comment">Submit Comment</button>
        </form>
    </div>
</div>
<script>
    let home = localStorage.getItem('current_id');
    if (home) {
        document.getElementById('home').href = '/customer/' + home;
    }

    document.getElementById('user_id').value = home;
</script>
</body>
</html>