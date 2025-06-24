<?php
include "header.php";

// Get the category and search query from URL parameters
$category = isset($_GET['category']) ? strtolower($_GET['category']) : '';
$search = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';

// Define food items with their categories
$food_items = [
    [
        'name' => 'Margherita Pizza',
        'price' => 15000,
        'details' => 'Classic tomato sauce, mozzarella, and fresh basil.',
        'image' => 'img/food/MargheritaPizza.jpg',
        'category' => 'pizza'
    ],
    [
        'name' => 'Pepperoni Pizza',
        'price' => 13000,
        'details' => 'Spicy pepperoni, melted cheese, and house-made sauce.',
        'image' => 'img/food/PepperoniPizza.jpg',
        'category' => 'pizza'
    ],
    [
        'name' => 'Tuna Melt Sandwich',
        'price' => 10000,
        'details' => 'Creamy tuna with cheese, grilled to golden perfection.',
        'image' => 'img/food/TunaMeltSandwich.jpg',
        'category' => 'sandwich'
    ],
    [
        'name' => 'Grilled Chicken Sandwich',
        'price' => 8500,
        'details' => 'Grilled chicken breast with lettuce, tomato, and mayo.',
        'image' => 'img/food/GrilledChickenSandwich.jpg',
        'category' => 'sandwich'
    ],
    [
        'name' => 'Beef Burger',
        'price' => 9500,
        'details' => 'Wagyu beef with toasted buns, cheese, tomato, and onion.',
        'image' => 'img/food/BeefBurger.jpg',
        'category' => 'burger'
    ],
    [
        'name' => 'Cheese Chicken Burger',
        'price' => 7500,
        'details' => 'Crispy chicken patty with cheddar and veggies.',
        'image' => 'img/food/CheeseChickenBurger.jpg',
        'category' => 'burger'
    ],
    [
        'name' => 'Spaghetti Bolognese',
        'price' => 18000,
        'details' => 'Rich tomato sauce with minced beef and herbs.',
        'image' => 'img/food/SpaghettiBolognese.jpg',
        'category' => 'spaghetti'
    ],
    [
        'name' => 'Creamy Alfredo Pasta',
        'price' => 23000,
        'details' => 'Pasta in white cream sauce with mushroom and chicken.',
        'image' => 'img/food/CreamyAlfredoPasta.jpg',
        'category' => 'spaghetti'
    ],
    [
        'name' => 'Salmon Nigiri',
        'price' => 6500,
        'details' => 'Fresh salmon over seasoned rice.',
        'image' => 'img/food/SalmonNigiri.jpg',
        'category' => 'sushi'
    ],
    [
        'name' => 'California Rolls',
        'price' => 13500,
        'details' => 'Crab, avocado, cucumber wrapped in seaweed & rice.',
        'image' => 'img/food/CaliforniaRolls.jpg',
        'category' => 'sushi'
    ],
    [
        'name' => 'Vanilla Sundae',
        'price' => 9500,
        'details' => 'Classic vanilla with chocolate syrup and nuts.',
        'image' => 'img/food/VanillaSundae.jpg',
        'category' => 'icecream'
    ],
    [
        'name' => 'Strawberry Delight',
        'price' => 10000,
        'details' => 'Strawberry ice cream with fresh fruit & wafer.',
        'image' => 'img/food/StrawberryDelight.jpg',
        'category' => 'icecream'
    ]
];

// Filter items based on category and search query
if (!empty($category) || !empty($search)) {
    $food_items = array_filter($food_items, function($item) use ($category, $search) {
        $matches_category = empty($category) || $item['category'] === $category;
        $matches_search = empty($search) || 
            strpos(strtolower($item['name']), $search) !== false || 
            strpos(strtolower($item['details']), $search) !== false;
        return $matches_category && $matches_search;
    });
}
?>
<!-- Foods Section Start -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">
                <?php 
                if (!empty($search)) {
                    echo 'Search Results for "' . htmlspecialchars($search) . '"';
                } else if (!empty($category)) {
                    echo ucfirst($category) . ' Menu';
                } else {
                    echo 'Food Menu';
                }
                ?>
            </h2>
            <div class="heading-border"></div>
            <?php if (empty($food_items)): ?>
                <div class="text-center" style="padding: 20px;">
                    <p>No food items found matching your search criteria.</p>
                </div>
            <?php else: ?>
            <div class="grid-2">
                <?php foreach ($food_items as $item): ?>
                <div class="food-menu-box">
                    <form action="" class="add-to-cart-form">
                        <div class="food-menu-img">
                            <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" class="img-responsive img-curve">
                        </div>
                        <div class="food-menu-desc">
                            <h4><?php echo $item['name']; ?></h4>
                            <p class="food-price"><?php echo number_format($item['price']); ?> MMK</p>
                            <p class="food-details"><?php echo $item['details']; ?></p>
                            <input type="number" value="1" min="1">
                            <input type="submit" class="btn-primary" value="Add To Cart">
                        </div>
                    </form>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>
<!-- Foods Section End -->

<script src="cart.js"></script>
<?php
include "footer.php";
?>