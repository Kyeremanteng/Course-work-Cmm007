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

    $sql = "INSERT INTO recipes (userid, title, description, ingredients, instructions, regionFlag) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo "Error preparing statement: " . $conn->error;
        exit;
    }

    $stmt->bind_param("isssss", $userId, $title, $description, $ingredients, $instructions, $regionFlag);

    try {
        $stmt->execute();
        header("Location: ../chef.php?add=success");
        exit;
    } catch (mysqli_sql_exception $e) {
        if ($conn->errno === 1062) {

            // Handle duplicate entry for the unique title
            $errorMessage = "A recipe with this title already exists.";
            header("Location: ../chef.php?error=" . urlencode($errorMessage));
            exit;

        } else {
            // Handle other SQL errors
            $errorMessage = "Database error: unable to insert record.";
            header("Location: ../chef.php?error=" . urlencode($errorMessage));
            exit;
        }
    } finally {
        $stmt->close();
    }
}
$conn->close();
?>