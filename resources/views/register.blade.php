<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        /* General styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
        }

        .card {
            background-color: lightgray;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: lightblue;
            color: navy;
            text-align: center;
            font-weight: bold;
            font-size: 24px;
            padding: 15px;
            border-radius: 8px 8px 0 0;
        }

        .card-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .btn {
            width: 100%;
            background-color: navy;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: darkblue;
        }

        #errorMessage {
            display: none;
            color: red;
            margin-top: 10px;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .card-header {
                font-size: 20px;
            }

            .btn {
                font-size: 16px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 10px;
            }

            .card-header {
                font-size: 18px;
            }

            .btn {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">REGISTER</div>
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
