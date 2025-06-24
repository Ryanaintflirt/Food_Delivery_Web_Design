<!-- Favicon -->
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    
<!-- Fontawesome CSS -->
<link rel="stylesheet" href="css/font-awesome/css/font-awesome.css">
    
<!-- Hover CSS -->
<link rel="stylesheet" href="css/hover-min.css">
    
<!-- Custom CSS -->
<link rel="stylesheet" href="css/style.css">

<style>
.auth-buttons {
  gap: 10px;
  display:inline;
  float:right;
  margin-left:100px;
  margin-right:-180px;
}

.auth-buttons .signin {
  background: transparent;
  border: none;
  font-weight: 600;
  font-size: 15px;
  cursor: pointer;
  color:#ff511c;
  margin-left:10px;
}
.auth-buttons .signup {
  background-color: #ff511c;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 6px;
  font-size: 15px;
  cursor: pointer;
  transition: background-color 0.3s;
}
.auth-buttons .signup:hover {
  background-color:rgb(249, 140, 97);
}



/* Cart Dropdown Styles */
.cart-content {
  display: none;
  position: absolute;
  right: 0;
  background-color: white;
  min-width: 300px;
  box-shadow: 0 8px 16px rgba(0,0,0,0.1);
  z-index: 1000;
  padding: 15px;
  border-radius: 8px;
  margin-top: 10px;
}

.cart-content.show {
  display: block !important;
}

.cart-table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 15px;
}

.cart-table th, .cart-table td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

.cart-table img {
  width: 50px;
  height: 50px;
  object-fit: cover;
  border-radius: 4px;
}

.cart-total {
  font-weight: bold;
  text-align: right;
  padding: 10px 0;
  border-top: 2px solid #ddd;
}

.cart-actions {
  text-align: right;
  margin-top: 10px;
}

.cart-actions .btn-primary {
  background-color: #ff511c;
  color: white;
  padding: 8px 15px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  text-decoration: none;
  display: inline-block;
}

.cart-actions .btn-primary:hover {
  background-color: #e6450f;
}

.remove-btn {
  background: none;
  border: none;
  color: #dc3545;
  cursor: pointer;
  padding: 5px;
}

.remove-btn:hover {
  color: #c82333;
}


</style>
<!-- Navigation Section Start -->
<header class="navbar">
        <nav id="site-top-nav" class="navbar-menu navbar-fixed-top">
            <div class="container">
                <!-- logo -->
                <div class="logo">
                    <a href="index.php" title="Logo">
                        <img src="img/logo.png" alt="Logo" class="img-responsive">
                    </a>
                </div>
                <!-- Main Menu -->
                <div class="menu text-right">
                    <ul>
                        <li><a class="hvr-underline-from-center" href="index.php">Home</a></li>
                        <li><a class="hvr-underline-from-center" href="Menu.php">Menu</a></li>
                        <li><a class="hvr-underline-from-center" href="Order.php">Order</a></li>
                        <li><a class="hvr-underline-from-center" href="Service.php">Service</a></li>
                        <li><a class="hvr-underline-from-center" href="Contact.php">Contact</a></li>
                        <li>
                            <a id="shopping-cart" class="shopping-cart">
                                <i class="fa fa-cart-arrow-down"></i>
                                <span id="cart-count" class="badge">0</span>
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
                                        <!-- Cart items will be dynamically inserted here -->
                                    </tbody>
                                </table>
                                <div class="cart-total">
                                    Total: <span id="cart-total-amount">0 MMK</span>
                                </div>
                                <div class="cart-actions">
                                    <a href="Order.php" class="btn-primary">View Cart</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="auth-buttons">
                                <a href="signIn.php"><button class="signin">SignIn</button></a>
                                <a href="signUp.php"><button class="signup">SignUp</button></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
</header>
<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<!-- Jquery UI -->
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<!-- Custom JS -->
<script src="js/custom.js"></script>
<!-- Navigation Section End -->