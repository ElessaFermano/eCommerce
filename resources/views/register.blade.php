<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
<link rel="stylesheet" href="{{asset('css/register.css')}}">
</head>
<body>
    <div class="container">
        <div class="card">
            <h3>theeSHOP</h3>
            <div class="card-body">
                <form id="registerForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="number" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="profile_pic">Profile Image</label>
                        <input type="file" id="profile_pic" name="profile_pic">
                    </div>
                    <input type="hidden" name="role" value="customer">
                    <button type="submit" class="btn">Register</button>
                    <p id="errorMessage">Invalid Credentials</p>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            fetch("/api/register", {
                method: 'POST',
                body: formData,
                headers: {
                    Accept: 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.message == 'User registered successfully') {
                    localStorage.setItem('role', data.role);
                    localStorage.setItem('access_token', data.access_token);
                    localStorage.setItem('user_id', data.user.id);
                    
                    window.location.href = '/customer/' + data.user.id; 
                } else {
                    document.getElementById('errorMessage').textContent = data.errors ? JSON.stringify(data.errors) : 'An error occurred';
                    document.getElementById('errorMessage').style.display = 'block';
                }
            })
            .catch(error => {
                console.error("Error", error);
                document.getElementById('errorMessage').textContent = "An error occurred. Please try again.";
                document.getElementById('errorMessage').style.display = 'block';
            });
        });
    </script>
</body>
</html>
