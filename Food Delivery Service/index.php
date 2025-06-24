<?php
include "header.php";
include "dbConnect.php";

// Fetch categories from database
$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
?>
<style>
.btn-Order {
  display: inline-block;
  padding: 14px 32px;
  text-decoration: none;
  background-color: #ff511c;
  color: #ffffff;
  border-radius: 6px;
  font-size: 1.1rem;
  font-weight: bold;
  transition: all 0.3s ease;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}
.order-btn-wrapper {
  display: flex;
  justify-content: center;
  margin: auto;
  margin-top:3rem;
  margin-bottom: 1px;
}
</style>
<!-- Food Search Section Start -->
    <section class="food-search text-center" >
        <div class="container">
            <form action="Menu.php" method="GET">
                <input type="search" name="search" placeholder="Search for food..." required>
                <input type="submit" value="Search" class="btn-primary">
            </form>
        </div>
    </section>
<!-- Food Search Section End -->

<!-- Category Section Start -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <div class="heading-border"></div>

            <div class="grid-3">
                <a href="Menu.php?category=pizza">
                    <div class="float-container">
                        <img src="img/category/pizza.jpg" class="img-responsive" alt="">
                        <h3 class="float-text text-white">Pizza</h3>
                    </div>
                </a>
                <a href="Menu.php?category=sandwich">
                    <div class="float-container">
                        <img src="img/category/sandwich.jpg" class="img-responsive" alt="">
                        <h3 class="float-text text-white">Sandwich</h3>
                    </div>
                </a>
                <a href="Menu.php?category=burger">
                    <div class="float-container">
                        <img src="img/category/burger.jpg" class="img-responsive" alt="">
                        <h3 class="float-text text-white">Burger</h3>
                    </div>
                </a>
                <a href="Menu.php?category=spaghetti">
                    <div class="float-container">
                        <img src="img/category/Spaghetti.jpg" class="img-responsive" alt="">
                        <h3 class="float-text text-white">Spaghetti</h3>
                    </div>
                </a>
                <a href="Menu.php?category=sushi">
                    <div class="float-container">
                        <img src="img/category/sushi.jpg" class="img-responsive" alt="">
                        <h3 class="float-text text-white">Sushi</h3>
                    </div>
                </a>
                <a href="Menu.php?category=icecream">
                    <div class="float-container">
                        <img src="img/category/IceCream.jpg" class="img-responsive" alt="">
                        <h3 class="float-text text-white">Ice Cream</h3>
                    </div>
                </a>
            </div>
        </div>
    </section>
<!-- Category Section End -->

<!-- Popular Dishes Start -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Popular Dishes</h2>
            <div class="heading-border"></div>
            <div class="grid-2">
                <div class="food-menu-box">
                    <form action="" class="add-to-cart-form">
                        <div class="food-menu-img">
                            <img src="img/food/PepperoniPizza.jpg" alt="" class="img-responsive img-curve">
                        </div>
                        <div class="food-menu-desc">
                            <h4>Pepperoni Pizza</h4>
                            <p class="food-price">13,000 MMK</p>
                            <p class="food-details">Spicy pepperoni, melted cheese, and house-made sauce.</p>
                            <input type="number" value="1" min="1">
                            <input type="submit" class="btn-primary" value="Add To Cart">
                        </div>
                    </form>
                </div>
                <div class="food-menu-box">
                    <form action="" class="add-to-cart-form">
                        <div class="food-menu-img">
                            <img src="img/food/TunaMeltSandwich.jpg" alt="" class="img-responsive img-curve">
                        </div>
                        <div class="food-menu-desc">
                            <h4>Tuna Melt Sandwich</h4>
                            <p class="food-price">10,000 MMK</p>
                            <p class="food-details">Creamy tuna with cheese, grilled to golden perfection.</p>
                            <input type="number" value="1" min="1">
                            <input type="submit" class="btn-primary" value="Add To Cart">
                        </div>
                    </form>
                </div>
                <div class="food-menu-box">
                    <form action="" class="add-to-cart-form">
                        <div class="food-menu-img">
                            <img src="img/food/BeefBurger.jpg" alt="" class="img-responsive img-curve">
                        </div>
                        <div class="food-menu-desc">
                            <h4>Beef Burger</h4>
                            <p class="food-price">7,500 MMK</p>
                            <p class="food-details">Wagyu beef with toasted buns, cheese, tomato, and onion.</p>
                            <input type="number" value="1" min="1">
                            <input type="submit" class="btn-primary" value="Add To Cart">
                        </div>
                    </form>
                </div>
                <div class="food-menu-box">
                    <form action="" class="add-to-cart-form">
                        <div class="food-menu-img">
                            <img src="img/food/SalmonNigiri.jpg" alt="" class="img-responsive img-curve">
                        </div>
                        <div class="food-menu-desc">
                            <h4>Salmon Nigiri</h4>
                            <p class="food-price">6,500 MMK</p>
                            <p class="food-details">Fresh salmon over seasoned rice.</p>
                            <input type="number" value="1" min="1">
                            <input type="submit" class="btn-primary" value="Add To Cart">
                        </div>
                    </form>
                </div>
                <div class="food-menu-box">
                    <form action="" class="add-to-cart-form">
                        <div class="food-menu-img">
                            <img src="img/food/SpaghettiBolognese.jpg" alt="" class="img-responsive img-curve">
                        </div>
                        <div class="food-menu-desc">
                            <h4>Spaghetti Bolognese</h4>
                            <p class="food-price">18,000 MMK</p>
                            <p class="food-details">Rich tomato sauce with minced beef and herbs.</p>
                            <input type="number" value="1" min="1">
                            <input type="submit" class="btn-primary" value="Add To Cart">
                        </div>
                    </form>
                </div>
                <div class="food-menu-box">
                    <form action="" class="add-to-cart-form">
                        <div class="food-menu-img">
                            <img src="img/food/StrawberryDelight.jpg" alt="" class="img-responsive img-curve">
                        </div>
                        <div class="food-menu-desc">
                            <h4>Strawberry Delight</h4>
                            <p class="food-price">10,000 MMK</p>
                            <p class="food-details">Strawberry ice cream with fresh fruit & wafer.</p>
                            <input type="number" value="1" min="1">
                            <input type="submit" class="btn-primary" value="Add To Cart">
                        </div>
                    </form>
                </div>
            </div>
            <div class="order-btn-wrapper">
                <a href="Menu.php"><h3 class="btn-Order">See All Foods!!!</h3></a> 
            </div>
        </div>
    </section>
<!-- Popular Dishes End -->

<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<!-- Jquery UI -->
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<!-- Custom JS -->
<script src="js/custom.js"></script>
<!-- Cart JS -->
<script src="cart.js"></script>
<!-- Navigation Section End -->
<?php
$conn->close();
include "footer.php";
?>