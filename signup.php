<?php
// Start the session
session_start();

// Placeholder for handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract and sanitize form inputs
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $yearStarted = htmlspecialchars($_POST['yearStarted']);
    $bio = htmlspecialchars($_POST['bio']);

    // Here, add your logic to store the data, such as database insertion
    // For now, let's just print the inputs to demonstrate
    echo "<h2>Your Input:</h2>";
    echo "Name: $name<br>";
    echo "Email: $email<br>";
    echo "Telephone: $telephone<br>";
    echo "Year Cooking Started: $yearStarted<br>";
    echo "Bio: $bio<br>";

    // After storing data, you might want to redirect or perform other actions
}

include 'header.php'; // Include your header file
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
        <h1>Sign Up</h1>
    </div>
    <div class="container-sm custom-container">
        <div class="col">
            <form method="post" action="functions/user_signup.php">
                <h5 class="text-center mb-4">Create a New Account</h5>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="name" class="form-control" id="name" name="name" placeholder="First Last" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com"
                        required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="telephone" class="form-label">Telephone (Optional)</label>
                    <input type="telephone" class="form-control" id="telephone" name="telephone"
                        placeholder="+44 123 456 7890">
                </div>
                <div class="mb-3">
                    <label for="bio" class="form-label">Bio (Optional)</label>
                    <textarea class="form-control" id="bio" name="bio" rows="4"
                        placeholder="Tell us a little bit about yourself..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary d-block mx-auto">Submit</button>
            </form>
            <p class="text-center mt-3">Are you an existing chef? <a href="login.php" class="text-primary">Log In</a></p>
        </div>
    </div>
</body>

</html>
