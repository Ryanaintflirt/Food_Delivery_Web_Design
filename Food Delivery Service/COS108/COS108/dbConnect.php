<?php
// Database credentials
$servername = "127.0.0.1:3308";
$username = "root";        // default XAMPP username
$password = "";            // default XAMPP password
$dbname = "goodfooddb";    // your database name

// Create connection
$connect = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Set charset
$connect->set_charset("utf8mb4");
?>
