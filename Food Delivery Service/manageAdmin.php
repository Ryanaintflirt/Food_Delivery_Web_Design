<?php
include 'Aheader.php';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $username = trim($_POST['username']);
                $password = $_POST['password'];
                
                // Validate input
                if (empty($username) || empty($password)) {
                    $error = "All fields are required";
                } else {
                    // Check if username already exists
                    $stmt = $conn->prepare("SELECT id FROM admin WHERE username = ?");
                    $stmt->bind_param("s", $username);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows > 0) {
                        $error = "Username already exists";
                    } else {
                        // Hash password and insert new admin
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        $stmt = $conn->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
                        $stmt->bind_param("ss", $username, $hashed_password);
                        
                        if ($stmt->execute()) {
                            $success = "Admin added successfully";
                        } else {
                            $error = "Error adding admin: " . $conn->error;
                        }
                    }
                    $stmt->close();
                }
                break;

            case 'delete':
                $admin_id = $_POST['admin_id'];
                
                // Prevent deleting the last admin
                $stmt = $conn->prepare("SELECT COUNT(*) as count FROM admin");
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                
                if ($row['count'] <= 1) {
                    $error = "Cannot delete the last admin account";
                } else {
                    $stmt = $conn->prepare("DELETE FROM admin WHERE id = ?");
                    $stmt->bind_param("i", $admin_id);
                    
                    if ($stmt->execute()) {
                        $success = "Admin deleted successfully";
                    } else {
                        $error = "Error deleting admin: " . $conn->error;
                    }
                }
                $stmt->close();
                break;
        }
    }
}

// Get all admins
$query = "SELECT id, username, created_at FROM admin ORDER BY id DESC";
$result = $conn->query($query);
?>

<div class="admin-content">
    <div class="container">
        <div class="admin-title" style="text-align:center;">
            <h2>Manage Admin</h2>
        </div>

        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (isset($success)): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>

        <!-- Add Admin Form -->
        <div class="form-container">
            <h3>Add New Admin</h3>
            <form method="POST" action="" class="form">
                <input type="hidden" name="action" value="add">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn-primary">Add Admin</button>
            </form>
        </div>

        <!-- Admin List -->
        <div class="admin-list">
            <h3>Admin List</h3>
            <table class="tbl-full">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($admin = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $admin['id']; ?></td>
                                <td><?php echo htmlspecialchars($admin['username']); ?></td>
                                <td><?php echo date('F j, Y g:i A', strtotime($admin['created_at'])); ?></td>
                                <td>
                                    <form method="POST" action="" style="display: inline;">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="admin_id" value="<?php echo $admin['id']; ?>">
                                        <button type="submit" class="btn-danger" 
                                                onclick="return confirm('Are you sure you want to delete this admin?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align: center;">No admins found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
.form-container {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.admin-list {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-group input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.btn-primary, .btn-danger {
    padding: 8px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-right: 5px;
}

.btn-primary {
    background-color: #4CAF50;
    color: white;
}

.btn-danger {
    background-color: #f44336;
    color: white;
}

.success, .error {
    padding: 10px;
    margin: 10px 0;
    border-radius: 4px;
}

.success {
    background-color: #dff0d8;
    color: #3c763d;
}

.error {
    background-color: #f2dede;
    color: #a94442;
}

.tbl-full {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.tbl-full th,
.tbl-full td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.tbl-full th {
    background-color: #f8f9fa;
    font-weight: bold;
}

.tbl-full tr:hover {
    background-color: #f5f5f5;
}
</style>

<?php
include 'Afooter.php';
?>