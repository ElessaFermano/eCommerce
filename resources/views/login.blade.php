<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset("styles/css/login.css")}}">
    <script>
        const token = localStorage.getItem('access_token');

        if (token) {
            window.location.href = '/dashboard';
        }
    </script>
</head>
<body>
    <div class="login-form">
        <h3>theeSHOP</h3>
        <form id="LoginForm">
            <input type="email" name="email" placeholder="Enter your email" required>
            <input type="password" name="password" placeholder="Enter your password" required>
            <p>Don't have an account yet? <a href="/register">SIGN UP</a></p>
            <button type="submit">Login</button>
            <p id="errorMessage" style="display:none; color:red;"></p>
        </form>
    </div>

    <script>
        document.getElementById('LoginForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            fetch("/api/login", {
                method: 'POST',
                body: formData,
                headers: {
                    Accept: 'application/json',
                }
            })
            .then(response => {
                if (!response.ok) {
                    console.error("Login Error:", response);
                    throw new Error('Login failed');
                }
                return response.json();
            })
            .then(data => {
                if (data.status == 'success') {
                    localStorage.setItem('access_token', data.access_token); 
                    
                    fetch('/api/user', {
                        method: 'GET',
                        headers: {
                            'Authorization': `Bearer ${data.access_token}`,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            console.error("User Data Error:", response);
                            throw new Error('Failed to fetch user data');
                        }
                        return response.json();
                    })
                    .then(data => {
                        
                        if (data.role == 'supplier') {
                            localStorage.setItem('role', data.role);
                            localStorage.setItem('access_token', data.access_token);
                            localStorage.setItem('role_id', data.role.id);

                            window.location.href = '/suppliers'; 
                        } else {
                            window.location.href = '/dashboard/'; 
                        }
                    })
                    .catch(error => {
                        console.error("Error", error);
                        document.getElementById('errorMessage').textContent = "An error occurred while fetching user data. Please try again.";
                        document.getElementById('errorMessage').style.display = 'block';
                    });

                } else {
                    document.getElementById('errorMessage').textContent = data.message;
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
