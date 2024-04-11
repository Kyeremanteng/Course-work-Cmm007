<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_role'])) {
    // User is already logged in; redirect based on role
    $redirectPage = ($_SESSION['user_role'] === 'admin') ? 'admin.php' : 'chef.php';
    header("Location: $redirectPage");
    exit;
}

// Placeholder for error message
$error_message = "";

// Example login check (You should replace this with your actual login check logic)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username']; // You should sanitize this
    $password = $_POST['password']; // And this

    // Here you should check the credentials against a database or other storage
    if ($username == 'demo' && $password == 'demo') { // Placeholder credentials
        $_SESSION['user_id'] = $username; // Set session variable or other login token
        header("Location: chef.php"); // Redirect on successful login
        exit;
    } else {
        $error_message = "Invalid username or password."; // Error message on failure
    }
}

include 'header.php'; // Include your header file
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .custom-container {
            margin-top: 50px;
        }

        .custom-container .col {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-primary:hover {
            background-color: #495057;
            border-color: #495057;
        }

        .text-primary {
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="container text-center">
        <h1>Login</h1>
    </div>
    <div class="container-sm custom-container">
        <div class="col">
            <form method="post" action="functions/user_login.php">
                <h5 class="text-center mb-4">Login to Your Account</h5>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com"
                        required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary d-block mx-auto">Submit</button>
                <?php if (isset($_SESSION['login_error'])): ?>
                <p class="text-danger mt-3"><?php echo $_SESSION['login_error']; unset($_SESSION['login_error']); ?></p>
                <?php endif; ?>
            </form>
            <p class="text-center mt-3"> <a href="signup.php" class="text-primary">Sign Up</a></p>
        </div>
    </div>
</body>

</html>

</body>

</html>