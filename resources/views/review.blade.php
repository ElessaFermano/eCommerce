<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cart</title>
    <link rel="stylesheet" href="{{ asset('styles/css/welcome.css') }}">
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
    <div class="review-section" id="review">
    <img src="{{asset('storage/'. $product->image)}}" alt="Product Image">
    <div class="review-content">
        <p class="product-name">{{ucfirst($product->name)}}</p>
        <p class="product-price">Php {{$product->price}}</p>
        <div class="review">
            <h5>REVIEWS FROM OUR VALUED CUSTOMERS</h5>
    @foreach($reviews as $review)
    
    <h6> {{$review->user->first_name . " " . $review->user->last_name}}</h6>
        <p>{{ $review->comment }}</p>
        <hr>
    @endforeach
</div>

        <h5><i>  Leave a Comment</i></h5>
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