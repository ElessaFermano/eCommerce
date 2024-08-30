<!DOCTYPE html>
<html lang="en">
<head>
    <title>theeSHOP</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('styles/css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/about.css') }}">
    <style>
        
    </style>
</head>
<body>
    <div class="header">
        <h2>theeSHOP</h2>
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="/login">Login</a></li>
        </ul>
        <div class="icon">
            <div id="cartItem"></div>

            <div class="dropdown">      
                <a class="user" href="#">
                    <img src="{{ asset('image/profile.png') }}" alt="Profile" class="profile-img">
                    <span id="userName">Guest</span>
                </a>
                
            <div class="dropdown-content">
                <div id="myOrder" ></div>
                <a href="#" onclick="logout()">Logout</a>
            </div>

            </div>
        </div>
    </div>

    <div class="main" id="home">
        <div class="">
        </div>
    </div>
    <div class="space"></div>

    <section class="product">
        <h1 class="title">ALL PRODUCTS</h1>
        <div class="row">
            @foreach($items as $product)
            <div class="card">
                <img src="{{ asset('storage/'. $product->image) }}" alt="{{ $product->name }}">
                <div>
                    <h5>{{ $product->name }}</h5>
                    <p>Php {{ $product->price }}</p>
                </div>
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" id="UserID">
                    <button type="submit">Add to Cart</button>
                </form>
                <br><br>
                <a href="{{ route('reviews.show', $product->id) }}" class="review">Show Reviews</a>
            </div>
            @endforeach
        </div>
    </section>

    <section class="about" id="about">
        <div class="about-section">
            <h1>ABOUT US</h1>
            <div class="content">
                <p>
                Welcome to TheeShop, your one-stop destination for fashion and technology! At TheeShop, we believe in the perfect blend of style and innovation, offering you the latest trends in clothing alongside cutting-edge gadgets. <br> <br>Our mission is to provide high-quality products that cater to both your fashion sense and tech-savvy needs. Whether you’re shopping for chic outfits or the newest devices, we strive to deliver a seamless and enjoyable shopping experience. Join us on this exciting journey as we continue to expand our collection and bring you the best in fashion and technology.
                </p>
             
            </div>
        </div>
    </section>

    <div class="space"></div>
    <footer class="footer">
        <div></div>
    </footer>

    <script>
        let userID = localStorage.getItem('user_id');
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
                    document.getElementById('cartItem').innerHTML = `<a href="/cart/${response.id}" class="cart">
                        <img src={{ asset("image/cart.png") }} alt="">
                        <span id="cart"></span>
                    </a>`;
                    document.getElementById('userName').textContent = response.first_name;
                    document.getElementById('cart').textContent = `{{ $cart }}`;
                    document.querySelectorAll('#UserID').forEach(input => {
                        input.value = response.id;

                        document.getElementById('myOrder').innerHTML = `<a href="{{route('orders.show', '')}}/${userID}">My Orders</a>`;
                    });
                })
            } else {
                document.getElementById('cart').textContent = `0`;
                document.getElementById('userName').textContent = 'Guest';
            }
        });

        function logout() {
     
     
        }
    </script>

    <script src={{ asset("js/sweetalert.min.js") }}></script>
</body>
</html>
