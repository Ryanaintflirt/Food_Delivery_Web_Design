<?php
session_start();
include "dbConnect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Securely check user credentials (assuming plain text password for now)
    $stmt = $connect->prepare("SELECT * FROM admin WHERE Username = ? AND Password = ?");
    $stmt->bind_param("ss", $username, $password); // Use password hashing for production
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION['username'] = $username;
        header("Location: Menu.php");
        exit();
    } else {
        echo "<script>alert('Invalid username or password'); window.location.href='SignIn.php';</script>";
        exit();
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Good Food</title>
</head>
<body>
<?php include "header.php"; ?>

<!-- Login Section Start -->
<section class="login">
    <div class="container">
        <h2 class="text-center">Login</h2>
        <div class="heading-border"></div>

        <form action="SignIn.php" method="POST" class="form">
            <fieldset> 
                <legend>Login</legend>
                <p class="label">Username</p>
                <input type="text" name="username" id="username" placeholder="Enter your username..." required>

                <p class="label">Password</p>
                <input type="password" name="password" id="password" placeholder="Enter your password..." required>

                <input type="submit" value="Login" class="btn-primary">
            </fieldset>
        </form>
    </div>
</section>
<!-- Login Section End -->

<?php include "footer.php"; ?>
</body>
</html>
