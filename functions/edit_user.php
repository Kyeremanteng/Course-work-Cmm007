<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['user_id'];
 
    $name = $conn->real_escape_string($_POST['name']); 
    $telephone = $conn->real_escape_string($_POST['telephone']);
    $bio = $conn->real_escape_string($_POST['bio']);
    $email = $conn->real_escape_string($_POST['email']);

    // Update SQL to modify an existing record based on title and userID
    $sql = "UPDATE users SET uname = ?, telephone = ?, bio = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo "Error preparing statement: " . $conn->error;
        exit;
    }

    // Bind the new title and other parameters to the statement, including the original title for the WHERE clause
    $stmt->bind_param("ssss", $name, $telephone, $bio, $email);

    try {
        $stmt->execute();
        // Check if the update was successful
        if ($stmt->affected_rows === 0) {
            // No rows updated, which could mean the original title doesn't exist or doesn't belong to the user
            $errorMessage = "No user was updated.";
            header("Location: ../admin.php?error=" . urlencode($errorMessage));
            exit;
        }
        header("Location: ../admin.php?update=successfulEditU");
        exit;
    } catch (mysqli_sql_exception $e) {
        $errorMessage = "Database error: unable to update the user.";
        header("Location: ../admin.php?error=" . urlencode($errorMessage));
        exit;
    } finally {
        $stmt->close();
    }
}

$conn->close();
?>