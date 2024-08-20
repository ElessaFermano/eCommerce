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
        .then(response => {
            if (!response.ok) {
                throw new Error('Unauthorized');
            }
            return response.json();
        })
        .then(response => {
            localStorage.setItem('current_id', response.id);
            document.getElementById('userName').textContent = response.first_name;
            document.getElementById('cart').textContent = `{{ $cart ?? 0 }}`;
            document.querySelectorAll('#UserID').forEach(input => {
                input.value = response.id;
            });

        })
        .catch(error => {
            console.error('Error fetching user:', error);
            localStorage.removeItem('access_token');
            localStorage.removeItem('user_id');
            document.getElementById('userName').textContent = 'Guest';
            document.getElementById('cart').textContent = '0';
        });
    } else {
        document.getElementById('userName').textContent = 'Guest';
        document.getElementById('cart').textContent = '0';
    }
});