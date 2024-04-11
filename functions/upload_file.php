<?php
session_start();
require_once 'config.php'; 

// Initialize a variable to hold potential messages
$message = "";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    $message = "You must be logged in to upload files.";
} else {
    // Validate if title parameter is present
    if (!isset($_POST['title']) || empty($_POST['title'])) {
        $message = "Recipe title is required.";
    } else {
        $title = $_POST['title'];
        $targetDir = "../uploads/";

        // Sanitize the file name to prevent directory traversal or any unwanted script execution
        $fileName = basename($_FILES["fileToUpload"]["name"]);
        $sanitizedFileName = preg_replace("/[^a-zA-Z0-9.\-_]/", "", $fileName);
        $targetFile = $targetDir . $sanitizedFileName;

        // Define allowed file types
        $allowedTypes = ['jpg', 'png', 'jpeg', 'gif', 'pdf'];
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Validate file type
        if (!in_array($fileType, $allowedTypes)) {
            $message = "Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed.";
        } elseif ($_FILES["fileToUpload"]["size"] > 5000000) { // Check file size (5MB limit)
            $message = "Sorry, your file is too large.";
        } elseif (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            // File upload was successful, now update the database
            $stmt = $conn->prepare("UPDATE recipes SET imagePath = ? WHERE title = ? AND userid = ?");
            $stmt->bind_param("ssi", substr($targetFile, 3), $title, $_SESSION['user_id']);
            
            if ($stmt->execute()) {
                $message = "The file " . htmlspecialchars($sanitizedFileName) . " has been uploaded and the recipe updated.";
            } else {
                $message = "Database error: unable to update record.";
            }
            $stmt->close();
        } else {
            $message = "Sorry, there was an error uploading your file.";
        }
    }
}

// Check if there's any message to display
if (!empty($message)) {
    $_SESSION['message'] = $message;
}

// Redirect to chef.php regardless of the outcome
header('Location: ../chef.php');
exit;

?>