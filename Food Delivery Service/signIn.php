<?php
require_once 'config.php';
include 'header.php';
include 'dbConnect.php';

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validation
    if (empty($username) || empty($password)) {
        $error = "All fields are required";
    } else {
        // Check user credentials
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            // Verify password
            if (password_verify($password, $user['password'])) {
                // Store user data in session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                
                // Redirect to home page
                header("Location: index.php");
                exit();
            } else {
                $error = "Invalid username or password";
            }
        } else {
            $error = "Invalid username or password";
        }
        $stmt->close();
    }
}
?>

<div class="signin-container">
    <div class="signin-box">
        <h2>Welcome Back</h2>
        
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="signin-form">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required 
                       value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="signin-btn">Sign In</button>
        </form>

        <div class="signup-link">
            Don't have an account? <a href="signUp.php">Sign up here</a>
        </div>
    </div>
</div>

<style>
.signin-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f5f5f5;
    padding: 20px;
}

.signin-box {
    background: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
}

.signin-box h2 {
    text-align: center;
    color: #333;
    margin-bottom: 30px;
    font-size: 24px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    color: #555;
    font-weight: 500;
}

.form-group input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
    transition: border-color 0.3s ease;
}

.form-group input:focus {
    border-color: #4CAF50;
    outline: none;
}

.signin-btn {
    width: 100%;
    padding: 12px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.signin-btn:hover {
    background-color: #45a049;
}

.signup-link {
    text-align: center;
    margin-top: 20px;
    color: #666;
}

.signup-link a {
    color: #4CAF50;
    text-decoration: none;
    font-weight: 500;
}

.signup-link a:hover {
    text-decoration: underline;
}

.alert {
    padding: 12px;
    border-radius: 5px;
    margin-bottom: 20px;
    text-align: center;
}

.alert-danger {
    background-color: #fdecea;
    color: #e74c3c;
    border: 1px solid #fadbd8;
}

.alert-success {
    background-color: #e8f6e8;
    color: #2ecc71;
    border: 1px solid #d4efdf;
}
</style>

<?php include 'footer.php'; ?>
