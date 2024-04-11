<?php
$host = 'localhost'; // Host name
$dbUser = 'root'; // Database user
$dbPassword = ''; // Database password
$dbName = 'coursework'; // Database name

// Create connection
$conn = new mysqli($host, $dbUser, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>