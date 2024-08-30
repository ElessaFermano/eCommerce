let home = localStorage.getItem('current_id');
if (home) {
    document.getElementById('home').href = '/customer/' + home;
}

document.getElementById('user_id').value = home;