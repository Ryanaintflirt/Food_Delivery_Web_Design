<?php
// Database credentials
$servername = "127.0.0.1";
$username = "root";
$password = "root";  // Empty password for default XAMPP setup
$dbname = "good_food";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to ensure proper handling of special characters
$conn->set_charset("utf8mb4");
?>
