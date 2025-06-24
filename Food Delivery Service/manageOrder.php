<?php
session_start();
include "dbConnect.php";

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: signin.php");
    exit;
}

// Handle status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id']) && isset($_POST['status'])) {
    $order_id = $_POST['order_id'];
    $status = strtolower($_POST['status']); // Convert to lowercase to match ENUM values
    
    // Validate status value
    $allowed_statuses = ['pending', 'process', 'done', 'cancel']; // Updated to match actual ENUM values
    if (!in_array($status, $allowed_statuses)) {
        $error_message = "Invalid status value";
    } else {
        $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $order_id);
        
        if ($stmt->execute()) {
            $success_message = "Order status updated successfully!";
        } else {
            $error_message = "Error updating order status: " . $conn->error;
        }
        $stmt->close();
    }
}

// Get all orders with customer details
$query = "SELECT orders.*, 
          GROUP_CONCAT(CONCAT(order_items.food_name, ' (', order_items.quantity, ')') SEPARATOR ', ') as order_items,
          GROUP_CONCAT(CONCAT(order_items.food_name, ' - ', order_items.price, ' MMK x ', order_items.quantity) SEPARATOR '\n') as detailed_items
          FROM orders
          LEFT JOIN order_items ON orders.id = order_items.order_id
          GROUP BY orders.id
          ORDER BY orders.id DESC";
$result = $conn->query($query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'delete':
                $order_id = $_POST['order_id'];
                
                // Start transaction
                $conn->begin_transaction();
                
                try {
                    // Delete order items first (due to foreign key constraint)
                    $stmt = $conn->prepare("DELETE FROM order_items WHERE order_id = ?");
                    $stmt->bind_param("i", $order_id);
                    $stmt->execute();
                    
                    // Delete the order
                    $stmt = $conn->prepare("DELETE FROM orders WHERE id = ?");
                    $stmt->bind_param("i", $order_id);
                    
                    if ($stmt->execute()) {
                        $conn->commit();
                        $success_message = "Order Updated successfully!";
                    } else {
                        throw new Exception($conn->error);
                    }
                } catch (Exception $e) {
                    $conn->rollback();
                    $error_message = "Error deleting order: " . $e->getMessage();
                }
                $stmt->close();
                break;
                
            case 'update_status':
                $order_id = $_POST['order_id'];
                $status = strtolower($_POST['status']);
                // ... existing code ...
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders - Good Food Admin</title>
    <link rel="stylesheet" href="../css/admin.css">
    <style>
        .orders-container {
            padding: 20px;
        }

        .order-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            padding: 20px;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .order-id {
            font-weight: bold;
            color: #2c3e50;
            font-size: 1.2em;
        }

        .order-date {
            color: #7f8c8d;
            font-size: 0.9em;
        }

        .order-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 15px;
        }

        .detail-group {
            margin-bottom: 10px;
        }

        .detail-label {
            font-weight: 500;
            color: #34495e;
            margin-bottom: 5px;
        }

        .detail-value {
            color: #2c3e50;
        }

        .order-items {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .detailed-items {
            white-space: pre-line;
            font-family: monospace;
            font-size: 0.9em;
            color: #2c3e50;
        }

        .status-form {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }

        .status-select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: white;
        }

        .update-btn {
            padding: 8px 15px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .update-btn:hover {
            background: #2980b9;
        }

        .btn-danger {
            padding: 8px 15px;
            background: #e74c3c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
            margin-left: 10px;
        }

        .btn-danger:hover {
            background: #c0392b;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.9em;
            font-weight: 500;
        }

        .status-pending {
            background: #ffeaa7;
            color: #d35400;
        }

        .status-process {
            background: #81ecec;
            color: #00b894;
        }

        .status-done {
            background: #55efc4;
            color: #00b894;
        }

        .status-cancel {
            background: #fab1a0;
            color: #d63031;
        }

        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .order-summary {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-top: 15px;
        }

        .order-summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .order-summary-label {
            font-weight: 500;
            color: #34495e;
        }

        .order-summary-value {
            color: #2c3e50;
        }

        @media (max-width: 768px) {
            .order-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .order-details {
                grid-template-columns: 1fr;
            }

            .status-form {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <?php include 'Aheader.php'; ?>
    <div class="admin-content">
        <div class="container">
            <div class="admin-title" style="text-align:center;">
                Manage Order
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="orders-container">
            <h1>Manage Orders</h1>

            <?php if (isset($success_message)): ?>
                <div class="message success"><?php echo $success_message; ?></div>
            <?php endif; ?>

            <?php if (isset($error_message)): ?>
                <div class="message error"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <?php if ($result->num_rows > 0): ?>
                <?php while ($order = $result->fetch_assoc()): ?>
                    <div class="order-card">
                        <div class="order-header">
                            <div>
                                <span class="order-id">Order #<?php echo $order['id']; ?></span>
                                <span class="order-date">Placed on: <?php echo isset($order['created_at']) ? date('F j, Y g:i A', strtotime($order['created_at'])) : 'N/A'; ?></span>
                            </div>
                            <span class="status-badge status-<?php echo strtolower($order['status']); ?>">
                                <?php echo ucfirst($order['status']); ?>
                            </span>
                        </div>

                        <div class="order-details">
                            <div class="detail-group">
                                <div class="detail-label">Customer Information</div>
                                <div class="detail-value">
                                    Name: <?php echo htmlspecialchars($order['customer_name']); ?><br>
                                    Age: <?php echo isset($order['customer_age']) ? htmlspecialchars($order['customer_age']) : 'N/A'; ?><br>
                                    Phone: <?php echo htmlspecialchars($order['customer_phone']); ?><br>
                                    Email: <?php echo htmlspecialchars($order['customer_email']); ?>
                                </div>
                            </div>
                            <div class="detail-group">
                                <div class="detail-label">Delivery Information</div>
                                <div class="detail-value">
                                    Address: <?php echo htmlspecialchars($order['customer_address']); ?><br>
                                    Date: <?php echo isset($order['delivery_date']) ? date('F j, Y', strtotime($order['delivery_date'])) : 'N/A'; ?><br>
                                    Time: <?php echo isset($order['delivery_time']) ? date('g:i A', strtotime($order['delivery_time'])) : 'N/A'; ?>
                                </div>
                            </div>
                        </div>

                        <div class="order-items">
                            <div class="detail-label">Order Items</div>
                            <div class="detailed-items"><?php echo htmlspecialchars($order['detailed_items'] ?? 'No items found'); ?></div>
                        </div>

                        <div class="order-summary">
                            <div class="order-summary-item">
                                <span class="order-summary-label">Payment Method:</span>
                                <span class="order-summary-value"><?php echo ucfirst($order['payment_method'] ?? 'N/A'); ?></span>
                            </div>
                            <div class="order-summary-item">
                                <span class="order-summary-label">Total Amount:</span>
                                <span class="order-summary-value"><?php echo isset($order['total_amount']) ? number_format($order['total_amount'], 0, ',', '.') . ' MMK' : 'N/A'; ?></span>
                            </div>
                        </div>

                        <form class="status-form" method="POST">
                            <input type="hidden" name="action" value="update_status">
                            <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                            <select name="status" class="status-select">
                                <option value="pending" <?php echo $order['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                                <option value="process" <?php echo $order['status'] === 'process' ? 'selected' : ''; ?>>Processing</option>
                                <option value="done" <?php echo $order['status'] === 'done' ? 'selected' : ''; ?>>Completed</option>
                                <option value="cancel" <?php echo $order['status'] === 'cancel' ? 'selected' : ''; ?>>Cancelled</option>
                            </select>
                            <button type="submit" class="update-btn">Update Status</button>
                            
                            <!-- Add Delete Button -->
                            <form method="POST" action="" style="display: inline;">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                <button type="submit" class="btn-danger" 
                                        onclick="return confirm('Are you sure you want to delete this order? This action cannot be undone.')">
                                    Delete Order
                                </button>
                            </form>
                        </form>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No orders found.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php include 'Afooter.php'; ?>
</body>
</html> 