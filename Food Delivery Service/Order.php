<?php
include "header.php";
include "dbConnect.php";

$success_message = '';
$error_message = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer_name'];
    $customer_phone = $_POST['customer_phone'];
    $customer_email = $_POST['customer_email'];
    $customer_age = $_POST['customer_age'];
    $customer_address = $_POST['customer_address'];
    $delivery_date = $_POST['delivery_date'];
    $delivery_time = $_POST['delivery_time'];
    $total_amount = $_POST['total_amount'];
    $payment_method = $_POST['payment_method'];
    $cart_items = json_decode($_POST['cart_items'], true);

    // Start transaction
    $conn->begin_transaction();

    try {
        // Insert into orders table with created_at timestamp
        $stmt = $conn->prepare("INSERT INTO orders (customer_name, customer_phone, customer_email, customer_age, customer_address, delivery_date, delivery_time, total_amount, payment_method, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', NOW())");
        $stmt->bind_param("sssisssds", $customer_name, $customer_phone, $customer_email, $customer_age, $customer_address, $delivery_date, $delivery_time, $total_amount, $payment_method);
        $stmt->execute();
        $order_id = $conn->insert_id;

        // Insert order items
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, food_name, quantity, price, subtotal) VALUES (?, ?, ?, ?, ?)");
        
        foreach ($cart_items as $item) {
            $food_name = $item['name'];
            $quantity = $item['quantity'];
            $price = $item['price'];
            $subtotal = $quantity * $price;
            
            $stmt->bind_param("isids", $order_id, $food_name, $quantity, $price, $subtotal);
            $stmt->execute();
        }

        // Commit transaction
        $conn->commit();
        
        // Set success message
        $success_message = "Order placed successfully! Your order number is: " . $order_id;
        
        // Clear the cart using JavaScript
        echo "<script>
            sessionStorage.removeItem('cart');
            // Update cart display
            if (typeof updateCartCount === 'function') updateCartCount();
            if (typeof updateCartDropdown === 'function') updateCartDropdown();
            if (typeof displayCart === 'function') displayCart();
        </script>";
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        $error_message = "Error placing order: " . $e->getMessage();
    }
}
?>
<style>
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    .form-group input,
    .form-group select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .form-group input[type="date"],
    .form-group input[type="time"] {
        width: 200px;
    }
    .message {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 4px;
        text-align: center;
    }
    .success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    .error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
</style>

<!-- Food Order Section Start -->
<section class="order">
    <div class="container">
        <h2 class="text-center">Fill this form to confirm your order</h2>
        
        <?php if ($success_message): ?>
            <div class="message success">
                <?php echo $success_message; ?>
                <br>
                <a href="index.php" class="btn-primary" style="margin-top: 10px; display: inline-block;">Continue Shopping</a>
            </div>
        <?php endif; ?>

        <?php if ($error_message): ?>
            <div class="message error">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <table class="tbl-full" border="0">
            <tr>
                <th>S.N.</th>
                <th>Food</th>
                <th>Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            <!-- Cart items will be dynamically inserted here -->
        </table>
        <form action="" method="POST" class="form" id="orderForm">
            <fieldset>
                <legend>Delivery Details</legend>
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="customer_name" placeholder="Enter your name..." required>
                </div>
                <div class="form-group">
                    <label>Age</label>
                    <input type="number" name="customer_age" min="16" max="70" placeholder="Enter your age..." required>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="customer_phone" placeholder="Enter your phone..." required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="customer_email" placeholder="Enter your email..." required>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="customer_address" placeholder="Enter your address..." required>
                </div>
                <div class="form-group">
                    <label>Delivery Date</label>
                    <input type="date" name="delivery_date" min="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <div class="form-group">
                    <label>Delivery Time</label>
                    <input type="time" name="delivery_time" min="09:00" max="21:00" required>
                </div>
                <div class="form-group">
                    <label>Payment Method</label>
                    <select name="payment_method" required>
                        <option value="cash">Cash on Delivery</option>
                        <option value="card">Card Payment</option>
                    </select>
                </div>
                <input type="hidden" name="total_amount" id="total_amount">
                <input type="hidden" name="cart_items" id="cart_items">
                <input type="submit" value="Confirm Order" class="btn-primary">
            </fieldset>
        </form>
    </div>
</section>
<!-- Food Order Section End -->

<script src="cart.js"></script>
<?php
$conn->close();
include "footer.php";
?>