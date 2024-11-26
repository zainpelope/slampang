<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background: #f5f5f5;
            font-family: 'Arial', sans-serif;
        }

        .login-container {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
        }

        .login-form {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            /* Sesuaikan ukuran form */
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 25px;
            border: 1px solid #ddd;
            margin-bottom: 15px;
            padding: 10px 15px;
        }

        .form-check {
            font-size: 14px;
        }

        .btn-primary {
            width: 100%;
            padding: 12px;
            border-radius: 25px;
            font-size: 18px;
            background: #2575fc;
            border: none;
        }

        .btn-primary:hover {
            background: #6a11cb;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #777;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-form">
            <h2>Login Admin</h2>
            <form action="#" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="showPassword" onclick="togglePasswordVisibility()">
                    <label class="form-check-label" for="showPassword">Show Password</label>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            <div class="footer">
                <p>&copy; 2024 Your Company</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            const checkBox = document.getElementById('showPassword');

            // Toggle the password visibility based on the checkbox
            if (checkBox.checked) {
                passwordField.type = 'text'; // Show password
            } else {
                passwordField.type = 'password'; // Hide password
            }
        }
    </script>

</body>

</html>