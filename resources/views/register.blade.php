<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6" >
                <div class="card mt-5" style="background-color: lightgray">
                    <div class="card-header text-center font-weight-bold fs-4"  style="background-color: lightblue; color: navy; font-family: 'Arial', sans-serif;">REGISTER</div>
                    <div class="card-body">
                        
                        <form id="registerForm" enctype="multipart/form-data">

                            @csrf
                            <div class="form-group mb-2">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                          
                            <div class="form-group mb-2">
                                <label for="phone">Phone</label>
                                <input type="number" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="profile_pic">Profile Image</label>
                                <input type="file" class="form-control" id="profile_pic" name="profile_pic">
                            </div>

                            <input type="hidden" name="role" value="customer">
                            
                            <button type="submit" class="btn btn-primary">Register</button>
                            <p id="errorMessage" style="display:none; color:red;">Invalid Credentials</p>
                        </form>
                    </div>
                </div>
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
                // console.log(data.id);
            //    let userId =
// console.log(userId);
                if (data.message == 'User registered successfully') {
                    localStorage.setItem('role', data.role)
                    localStorage.setItem('access_token', data.access_token);
                    localStorage.setItem('user_id', data.user.id);
                    // console.log(data.user.id);
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
