<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    echo "You must be logged in to perform this action.";
    exit;
}

require_once 'config.php';

// Check if a title was passed
if (isset($_GET['email']) && !empty($_GET['email'])) {
    $userEmail = $_GET['email'];

    // Prepare the SQL statement to prevent SQL injection
    // Use TRIM() and LOWER() to make the deletion case-insensitive and whitespace insensitive
    $stmt = $conn->prepare("DELETE FROM users WHERE TRIM(LOWER(email)) = TRIM(LOWER(?))");
    $stmt->bind_param("s", $userEmail);

    if ($stmt->execute()) {
        // Redirect back to the chef page after successful deletion
        header("Location: ../admin.php?status=deleted");
    } else {
        // Handle error or unsuccessful deletion
        echo "Error: Could not execute.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>