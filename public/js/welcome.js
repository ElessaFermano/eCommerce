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
} 
});
}