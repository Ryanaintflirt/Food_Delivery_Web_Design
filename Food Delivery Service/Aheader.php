<?php
session_start();
include "dbConnect.php";

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Good Food</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Admin Header Section Start -->
    <div class="admin-header">
        <div class="container">
            <div class="logo">
                <a href="index.php">
                    <img src="img/logo.png" alt="Good Food Logo" class="img-responsive">
                </a>
            </div>
            <div class="admin-nav">
                <ul>
                    <li><a href="manageOrder.php"><i class="fas fa-shopping-cart"></i> Orders</a></li>
                    <li><a href="manageContact.php"><i class="fas fa-list"></i> Contacts</a></li>
                    <li><a href="manageAdmin.php"><i class="fas fa-user-shield"></i> Admins</a></li>
                    <li><a href="Database.php"><i class="fas fa-database"></i> Database</a></li>
                    <li><a href="adminLogin.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Admin Header Section End -->

    <!-- Admin Content Section Start -->
</body>
</html>
