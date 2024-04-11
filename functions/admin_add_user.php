<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and assign input data
    $name = $conn->real_escape_string(trim($_POST['name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $password = $_POST['password']; // Will be hashed before storage
    $telephone = $conn->real_escape_string(trim($_POST['telephone']));
    $userRole = $conn->real_escape_string(trim($_POST['userRole']));

    // Hash the password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL to prevent SQL injection
    $sql = $conn->prepare("INSERT INTO users (uname, email, passwordHash, telephone, userRole) VALUES (?, ?, ?, ?, ?)");
    $sql->bind_param("sssss", $name, $email, $passwordHash, $telephone, $userRole);

    // Attempt to execute the prepared statement
    if ($sql->execute()) {
        // On success, simply redirect to admin.php without setting session variables for the new user
        header("Location: ../admin.php"); // Adjust the path as needed
        exit;
    } else {
        echo "Something went wrong. Please try again later.";
    }

    // Close statement and connection
    $sql->close();
    $conn->close();
}
?>