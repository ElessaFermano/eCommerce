<!DOCTYPE html>
<html lang="en">

<head>
    <title>theeSHOP</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/welcome.css')}}">
    <link rel="icon" href="data:,">

</head>
<body>
    <div class="header">
        <h2>theeSHOP</h2>
        <ul>
            <li><a href="#">Home</a></li>
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

    <div class="main">
        <div class="">
        <img src="{{asset('image/coverphoto.jpg')}}" alt="" class="coverphoto">
        </div>
    </div>
<div class="space"></div>
    <section class="product">
        <h1 class="title">ALL PRODUCTS</h1>
        <div class="row">
            @foreach($items as $product)
            <div class="card">
                <img src="{{asset('storage/'. $product->image)}}" alt="{{ $product->name }}">
                <div>
                    <h5>{{ $product->name }}</h5>
                    <p>Php {{ $product->price }}</p>
                </div>
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" id="UserID">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
            @endforeach
        </div>
    </section>
    <div class="space"> </div>
    <section class="category">
        <h1 class="title">Categories</h1>
        <div class="row">
            @foreach($byCategory as $categories)
            <div>
                <h5>{{$categories->category->name}}</h5>
                <p><a href="{{url('byCategory', $categories->category->id)}}">Go Shop</a></p>
            </div>
            @endforeach
        </div>
    </section>
    <div class="space"></div>
    <footer class="footer">
        <div>
        </div>
    </footer>
 <script>
        const userID = localStorage.getItem('user_id');
        const currentID = new URL(window.location.href).searchParams.get('user_id');

        if (userID && userID != currentID) {
            const url = new URL(window.location.href);
            url.searchParams.set('user_id', userID);
            window.location.href = url.href;
        }

    document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('access_token');
    
    if (token) {
        fetch('/api/user', {
            method: 'GET',
            headers: {
                Authorization: 'Bearer ' + token,
                accept: 'application/json',
            }
        })
        .then(response => response.json())
        
        .then(response => {
            localStorage.setItem('current_id', response.id);
            document.getElementById('cartItem').innerHTML = ` <a href="/cart/${response.id}" class="cart">
              
              <img src={{asset("image/cart.png")}} alt="">
              <span id="cart"></span>
          </a>`;
            document.getElementById('userName').textContent = response.first_name;
            document.getElementById('cart').textContent = `{{ $cart }}`;
            document.querySelectorAll('#UserID').forEach(input => {
                input.value = response.id;
            });
           
        })
    } else {
        document.getElementById('cart').textContent = `0`;
        document.getElementById('userName').textContent = 'Guest';
    }
});

function logout() {
    swal({
        title: "Are you sure you want to logout?",
        icon: "warning",
        buttons: ["Cancel", "Logout"],
        dangerMode: true,
    })
    .then((ifLogout) => {
        if (ifLogout) {
            localStorage.removeItem('access_token');
            localStorage.removeItem('user_id');
            localStorage.removeItem('current_id');
            localStorage.removeItem('role');
            window.location.href = '/';
        } else {
          window.location.href = '/dashboard';
        }
    });
}
    </script>


<script src={{asset("js/sweetalert.min.js")}}></script> 

</body>
</html>
