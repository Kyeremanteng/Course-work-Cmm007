<?php


session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $comment = $conn->real_escape_string($_POST['comment']);
    $author = $conn->real_escape_string($_POST['author']);
    $datePosted = date('Y-m-d H:i:s'); // Current time

    $sql = "INSERT INTO comments (title, comment, author, datePosted) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss",$title, $comment, $author, $datePosted);

    if ($stmt->execute()) {
        header("Location: ../forum.php?success=1");
    } else {
        header("Location: ../forum.php?error=" . urlencode($conn->error));
    }

    $stmt->close();
}
$conn->close();
?>