<?php
session_start();
require_once 'config.php';

$error_message = ""; // Initialize for potential error messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password']; // Password provided by user

    // Adjust SQL statement to include the userRole column
    $sql = "SELECT userid, uname, email, passwordHash, userRole FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            // Password verification
            if (password_verify($password, $user['passwordHash'])) {
                // Set session variables
                $_SESSION['user_id'] = $user['userid'];
                $_SESSION['user_name'] = $user['uname'];
                $_SESSION['user_role'] = $user['userRole']; // Store the user role

                // Redirect based on user role
                if ($user['userRole'] === 'admin') {
                    header("Location: ../admin.php");
                } else {
                    header("Location: ../chef.php");
                }
                exit;
            } else {
                // Handle incorrect password
                $error_message = "Invalid email or password.";
            }
        } else {
            // Handle user not found
            $error_message = "Invalid email or password.";
        }

        $stmt->close();
    } else {
        $error_message = "Database query failed.";
    }
}
$conn->close();

// Redirect back to the login form with an error message if login failed
if (!empty($error_message)) {
    // Using session to pass error message back to login form
    $_SESSION['login_error'] = $error_message;
    header("Location: ../login.php"); // Adjust as necessary to point to your actual login form
    exit;
}
?>