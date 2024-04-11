<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['user_id'];
 
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $ingredients = $conn->real_escape_string($_POST['ingredients']);
    $instructions = $conn->real_escape_string($_POST['instructions']);
    $regionFlag = $conn->real_escape_string($_POST['regionFlag']);

    // Update SQL to modify an existing record based on title and userID
    $sql = "UPDATE recipes SET description = ?, ingredients = ?, instructions = ?, regionFlag = ? WHERE title = ? AND userid = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo "Error preparing statement: " . $conn->error;
        exit;
    }

    $stmt->bind_param("ssssss", $description, $ingredients, $instructions, $regionFlag, $title, $userId);

    try {
        $stmt->execute();
        // Check if the update was successful
        if ($stmt->affected_rows === 0) {
            // No rows updated, which could mean the original title doesn't exist or doesn't belong to the user
            $errorMessage = "No recipe was updated. Please check the title.";
            header("Location: ../admin.php?error=" . urlencode($errorMessage));
            exit;
        }
        header("Location: ../admin.php?update=successfulEdit");
        exit;
    } catch (mysqli_sql_exception $e) {
        $errorMessage = "Database error: unable to update the recipe.";
        header("Location: ../admin.php?error=" . urlencode($errorMessage));
        exit;
    } finally {
        $stmt->close();
    }
}

$conn->close();
?>