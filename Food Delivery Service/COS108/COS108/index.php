<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Good Food</title>
</head>
<body>
<?php
include 'header.php';
?>
    <section class="gr">
        <div class="content">
            <div class="content-left">
                <div class="info">
                    <h2>Satisfy Your Cravings <br>Anytime, Anywhere<br></h2>
                    <p>Crave no more—our tasty meals are ready for you!<br>
                        We're always close by with freshly prepared food.</p>
                </div>
                <br>
                <a href="Menu.php" class="btn-primary">Explore Food</a>
            </div>
            <div class="content-right">
                <img src="image/HamburgerLogo.png" alt="">
            </div>
        </div>
    </section>
    <section class="Card">
        <div class="Card-Category">
            <h1>All Your Craving is Here!</h1>
            <div class="image-grid">
                <div class="image-container">
                    <img src="image/PizzaCard.jpg" alt="Nature">
                        <div class="image-overlay">
                            <h3>Pizza</h3>
                            <p>Cheesy, crispy, and loaded with your favorite toppings.</p>
                        </div>
                </div>
                <div class="image-container">
                    <img src="image/BurgerCard.jpg" alt="Nature">
                        <div class="image-overlay">
                            <h3>Hamburger</h3>
                            <p>Juicy beef patty stacked with fresh toppings and soft buns.</p>
                        </div>
                </div>
                <div class="image-container">
                    <img src="image/ChickenCard.jpg" alt="Nature">
                        <div class="image-overlay">
                            <h3>Fried Chicken</h3>
                            <p>Golden, crispy, and irresistibly seasoned to perfection.</p>
                        </div>
                </div>
                <div class="image-container">
                    <img src="image/TacoCard.jpg" alt="Nature">
                        <div class="image-overlay">
                            <h3>Taco</h3>
                            <p>A bold mix of seasoned meat, fresh veggies, and salsa packed into a warm, soft tortilla.</p>
                        </div>
                </div>
                <div class="image-container">
                    <img src="image/PastaCard.jpg" alt="Nature">
                        <div class="image-overlay">
                            <h3>Pasta</h3>
                            <p>Classic Italian dish with rich sauces and perfectly cooked noodles for a comforting, flavorful experience.</p>
                        </div>
                </div>
                <div class="image-container">
                    <img src="image/SushiCard.jpg" alt="Nature">
                        <div class="image-overlay">
                            <h3>Sushi</h3>
                            <p>Fresh fish, vinegared rice, and seaweed come together in elegant, bite-sized Japanese perfection.</p>
                        </div>
                </div>
            </div>
        </div>
    </section>
    <selection class="category">
        <div class="list-items">
            <div class="section-wrapper-index">
                <h3 class="section-title-index">Popular Dishes</h3>
            </div>
            <div class="card-list">
                <div class="card">
                    <img class="food-img" src="image/BeefBurger.png" alt="">
                    <div class="food-title">
                        <h1>Beef Burger</h1>
                    </div>
                    <div class="desc-food">
                        <p>Grilled Wagyu beef with cheese, lettuce, tomato, and onion on toasted buns.</p>
                    </div>
                    <div class="price">
                        <span>6,500 MMK</span><span><i class='bx  bx-plus-circle plus-icon' ></i> </span>
                    </div>
                </div>
                <div class="card">
                    <img class="food-img" src="image/FrenchFries.png" alt="">
                    <div class="food-title">
                        <h1>French Fries</h1>
                    </div>
                    <div class="desc-food">
                        <p>Crispy golden fries, lightly salted, freshly and kindly served .</p>
                    </div>
                    <div class="price">
                        <span>4,500 MMK</span><span><i class='bx  bx-plus-circle plus-icon' ></i> </span>
                    </div>
                </div>
                <div class="card">
                    <img class="food-img" src="image/Chicken.png" alt="">
                    <div class="food-title">
                        <h1>Chicken</h1>
                    </div>
                    <div class="desc-food">
                        <p>Juicy roasted chicken with herbs and a touch of little bit spice.</p>
                    </div>
                    <div class="price">
                        <span>10,000 MMK</span><span><i class='bx  bx-plus-circle plus-icon' ></i> </span>
                    </div>
                </div>
                <div class="card">
                    <img class="food-img" src="image/Steak.png" alt="">
                    <div class="food-title">
                        <h1>Steak</h1>
                    </div>
                    <div class="desc-food">
                        <p>Premium Wagyu steak grilled medium-rare, served with sautéed vegetables</p>
                    </div>
                    <div class="price">
                        <span>13,500 MMK</span><span><i class='bx  bx-plus-circle plus-icon' ></i> </span>
                    </div>
                </div>
            </div>
            <div class="order-btn-wrapper">
                <a href="Menu.php"><h3 class="btn-Order">See All Foods!!!</h3></a> 
            </div>
        </div>
</selection>
</body>
</html>
    
<?php
include 'footer.php';
?>