<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order - Good Food</title>
    <link rel="stylesheet" href="Style/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .order-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
        }
        
        .order-section {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .order-table th, .order-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        .order-table img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }
        
        .order-summary {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid #eee;
        }
        
        .order-total {
            font-size: 1.2em;
            font-weight: bold;
        }
        
        .order-form {
            margin-top: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        
        .btn-place-order {
            background: #4CAF50;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        
        .btn-place-order:hover {
            background: #45a049;
        }
        
        .btn-delete {
            color: red;
            text-decoration: none;
            font-weight: bold;
            font-size: 20px;
            padding: 5px 10px;
            border-radius: 50%;
            transition: background-color 0.3s;
        }
        
        .btn-delete:hover {
            background-color: #ffebee;
        }

        .form-group input[type="date"],
        .form-group input[type="time"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .form-group input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #999;
        }

        .form-group label::after {
            
            color: red;
        }

        .form-group label:not([for="notes"])::after {
           
            color: red;
        }
    </style>
</head>
<body>
<?php
include "header.php";
?>

<div class="order-container">
    <div class="order-section">
        <h2>Your Order</h2>
        <table class="order-table">
            <thead>
                <tr>
                    <th>Food</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="order-items">
                <!-- Order items will be populated here -->
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5">Total Amount</th>
                    <th id="order-total">0 MMK</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="order-section">
        <h2>Delivery Information</h2>
        <form class="order-form" id="order-form">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required placeholder="Enter your full name">
            </div>
            <div class="form-group">
                <label for="phone">Telephone Number</label>
                <input type="tel" id="phone" name="phone" required placeholder="Enter your phone number">
            </div>
            <div class="form-group">
                <label for="email">E-Mail Address</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email address">
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" id="age" name="age" required min="1" max="120" placeholder="Enter your age">
            </div>
            <div class="form-group">
                <label for="delivery_date">Delivery Date</label>
                <input type="date" id="delivery_date" name="delivery_date" required min="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="form-group">
                <label for="delivery_time">Delivery Time</label>
                <input type="time" id="delivery_time" name="delivery_time" required>
            </div>
            <div class="form-group">
                <label for="address">Delivery Address</label>
                <textarea id="address" name="address" rows="3" required placeholder="Enter your delivery address"></textarea>
            </div>
            <div class="form-group">
                <label for="notes">Special Instructions (Optional)</label>
                <textarea id="notes" name="notes" rows="2" placeholder="Any special instructions for your order"></textarea>
            </div>
            <button type="submit" class="btn-place-order">Place Order</button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get cart items from localStorage
    let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    const orderItemsContainer = document.getElementById('order-items');
    const orderTotal = document.getElementById('order-total');
    let total = 0;

    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('delivery_date').min = today;

    function updateOrderDisplay() {
        // Clear existing items
        orderItemsContainer.innerHTML = '';
        total = 0;

        // Populate order items
        cartItems.forEach(item => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td><img src="${item.image}" alt="${item.name}"></td>
                <td>${item.name}</td>
                <td>${item.price} MMK</td>
                <td>${item.quantity}</td>
                <td>${item.price * item.quantity} MMK</td>
                <td><a href="#" class="btn-delete" data-name="${item.name}">&times;</a></td>
            `;
            orderItemsContainer.appendChild(row);
            total += item.price * item.quantity;
        });

        // Update total
        orderTotal.textContent = total + ' MMK';

        // Update localStorage
        localStorage.setItem('cartItems', JSON.stringify(cartItems));
    }

    // Initial display
    updateOrderDisplay();

    // Handle item removal
    orderItemsContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-delete')) {
            e.preventDefault();
            const itemName = e.target.dataset.name;
            
            // Remove item from cartItems array
            cartItems = cartItems.filter(item => item.name !== itemName);
            
            // Update display
            updateOrderDisplay();

            // If cart is empty, redirect to menu
            if (cartItems.length === 0) {
                alert('Your cart is empty. Redirecting to menu...');
                window.location.href = 'Menu.php';
            }
        }
    });

    // Handle form submission
    const orderForm = document.getElementById('order-form');
    orderForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form data
        const formData = {
            name: document.getElementById('name').value,
            phone: document.getElementById('phone').value,
            email: document.getElementById('email').value,
            age: document.getElementById('age').value,
            delivery_date: document.getElementById('delivery_date').value,
            delivery_time: document.getElementById('delivery_time').value,
            address: document.getElementById('address').value,
            notes: document.getElementById('notes').value,
            items: cartItems,
            total: total
        };

        // Validate delivery date and time
        const deliveryDateTime = new Date(formData.delivery_date + 'T' + formData.delivery_time);
        const now = new Date();
        
        if (deliveryDateTime <= now) {
            alert('Please select a future delivery date and time');
            return;
        }

        // Here you would typically send this data to your server
        console.log('Order submitted:', formData);
        
        // Clear cart
        localStorage.removeItem('cartItems');
        
        // Show success message
        alert('Order placed successfully!');
        
        // Redirect to home page
        window.location.href = 'index.php';
    });
});
</script>

</body>
</html>
<?php
include "footer.php";
?>
