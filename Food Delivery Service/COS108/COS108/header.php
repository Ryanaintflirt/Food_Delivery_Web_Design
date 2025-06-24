<!-- Header Section -->
<link rel="stylesheet" href="Style/style.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<style>
    #cart-count {
        background: red;
        color: white;
        padding: 2px 6px;
        border-radius: 50%;
        font-size: 12px;
        position: relative;
        top: -10px;
        left: -5px;
        display: none;
    }
    
    .cart-content {
        display: none;
        position: absolute;
        right: 0;
        top: 100%;
        background: white;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        z-index: 1000;
        min-width: 400px;
    }
    
    .cart-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .cart-table td, .cart-table th {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    
    .cart-table img {
        width: 50px;
        height: 50px;
        object-fit: cover;
    }
    
    .btn-delete {
        color: red;
        text-decoration: none;
        font-weight: bold;
    }
    
    .btn-primary {
        display: block;
        width: 100%;
        padding: 10px;
        background: #4CAF50;
        color: white;
        text-align: center;
        text-decoration: none;
        margin-top: 10px;
        border-radius: 5px;
    }
</style>

<header class="menu">
    <nav>
        <div class="logo"><a>G</a>ood<b>Food</b></div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="Menu.php">Menu</a></li>
            <li><a href="Order.php">Order</a></li>
            <li><a href="Service.php">Services</a></li>
            <li><a href="Contact.php">Contact Us</a></li>
            <li>
                <a id="shopping-cart" class="shopping-cart">
                    <i class='bx bx-cart'></i>
                    <span id="cart-count">0</span>
                </a>
                <div id="cart-content" class="cart-content">
                    <h3 class="text-center">Shopping Cart</h3>
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Food</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Cart items will be added here dynamically -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">Total</th>
                                <th id="cart-total">0 MMK</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                    <a href="Order.php" class="btn-primary">Confirm Order</a>
                </div>
            </li>
        </ul>
        <div class="auth-buttons">
            <a href="SignIn.php"><button class="signin">Sign In</button></a>
            <a href="SignUp.php"><button class="signup">Sign Up</button></a>
        </div>
    </nav>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const cartToggle = document.getElementById("shopping-cart");
            const cartContent = document.getElementById("cart-content");

            cartToggle.addEventListener("click", function (e) {
                e.preventDefault();
                cartContent.style.display = cartContent.style.display === "block" ? "none" : "block";
            });

            document.addEventListener("click", function (event) {
                if (!cartContent.contains(event.target) && !cartToggle.contains(event.target)) {
                    cartContent.style.display = "none";
                }
            });

            // Function to update cart count
            window.updateCartCount = function() {
                const itemCount = document.querySelectorAll(".cart-table tbody tr").length;
                const cartCount = document.getElementById("cart-count");
                cartCount.textContent = itemCount;
                cartCount.style.display = itemCount > 0 ? "inline-block" : "none";
            }

            // Function to update cart total
            window.updateCartTotal = function() {
                const rows = document.querySelectorAll(".cart-table tbody tr");
                let total = 0;
                
                rows.forEach(row => {
                    // Get the price from the total column (5th column, index 4)
                    const priceText = row.cells[4].textContent;
                    // Remove 'MMK' and convert to number
                    const price = parseInt(priceText.replace(' MMK', ''));
                    if (!isNaN(price)) {
                        total += price;
                    }
                });
                
                // Update the total in the footer
                const totalCell = document.getElementById("cart-total");
                totalCell.textContent = total + " MMK";
            }

            // Initialize cart count
            updateCartCount();
        });
    </script>
</header>
