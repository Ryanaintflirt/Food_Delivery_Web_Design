<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Good Food</title>
</head>
<body>
<?php
include "header.php";
?>
<selection class="category">
        <div class="list-items">
            <div class="section-wrapper">
                <h3 class="section-title">Food Menu</h3>
            </div>
            <div class="card-list">
                <div class="card" data-food="Beef Burger" data-price="6500" data-image="image/BeefBurger.png">
                    <img class="food-img" src="image/BeefBurger.png" alt="">
                    <div class="food-title">
                        <h1>Beef Burger</h1>
                    </div>
                    <div class="desc-food">
                        <p>Grilled Wagyu beef with cheese, lettuce, tomato, and onion on toasted buns.</p>
                    </div>
                    <div class="price">
                        <span>6,500 MMK</span><span><i class='bx bx-plus-circle plus-icon add-to-cart'></i> </span>
                    </div>
                </div>
                <div class="card" data-food="French Fries" data-price="4500" data-image="image/FrenchFries.png">
                    <img class="food-img" src="image/FrenchFries.png" alt="">
                    <div class="food-title">
                        <h1>French Fries</h1>
                    </div>
                    <div class="desc-food">
                        <p>Crispy golden fries, lightly salted, freshly and kindly served .</p>
                    </div>
                    <div class="price">
                        <span>4,500 MMK</span><span><i class='bx bx-plus-circle plus-icon add-to-cart'></i> </span>
                    </div>
                </div>
                <div class="card" data-food="Chicken" data-price="10000" data-image="image/Chicken.png">
                    <img class="food-img" src="image/Chicken.png" alt="">
                    <div class="food-title">
                        <h1>Chicken</h1>
                    </div>
                    <div class="desc-food">
                        <p>Juicy roasted chicken with herbs and a touch of little bit spice.</p>
                    </div>
                    <div class="price">
                        <span>10,000 MMK</span><span><i class='bx bx-plus-circle plus-icon add-to-cart'></i> </span>
                    </div>
                </div>
                <div class="card" data-food="Steak" data-price="13500" data-image="image/Steak.png">
                    <img class="food-img" src="image/Steak.png" alt="">
                    <div class="food-title">
                        <h1>Steak</h1>
                    </div>
                    <div class="desc-food">
                        <p>Premium Wagyu steak grilled medium-rare, served with sautéed vegetables</p>
                    </div>
                    <div class="price">
                        <span>13,500 MMK</span><span><i class='bx bx-plus-circle plus-icon add-to-cart'></i> </span>
                    </div>
                </div>
                <div class="card" data-food="Taco" data-price="8500" data-image="image/Taco.png">
                    <img class="food-img" src="image/Taco.png" alt="">
                    <div class="food-title">
                        <h1>Taco</h1>
                    </div>
                    <div class="desc-food">
                        <p>Crispy or soft shells filled with bold flavors, perfect for any craving.</p>
                    </div>
                    <div class="price">
                        <span>8,500 MMK</span><span><i class='bx bx-plus-circle plus-icon add-to-cart'></i> </span>
                    </div>
                </div>
                <div class="card" data-food="Pasta" data-price="11900" data-image="image/Pasta.png">
                    <img class="food-img" src="image/Pasta.png" alt="">
                    <div class="food-title">
                        <h1>Pasta</h1>
                    </div>
                    <div class="desc-food">
                        <p>Rich sauces, hearty noodles, and classic Italian flavor in every delicious forkful.</p>
                    </div>
                    <div class="price">
                        <span>11,900 MMK</span><span><i class='bx bx-plus-circle plus-icon add-to-cart'></i> </span>
                    </div>
                </div>
                <div class="card" data-food="Sushi" data-price="8000" data-image="image/sushi.png">
                    <img class="food-img" src="image/sushi.png" alt="">
                    <div class="food-title">
                        <h1>Sushi</h1>
                    </div>
                    <div class="desc-food">
                        <p>Fresh fish, sticky rice, and seaweed rolled into a perfect bite-sized experience.</p>
                    </div>
                    <div class="price">
                        <span>8,000 MMK</span><span><i class='bx bx-plus-circle plus-icon add-to-cart'></i> </span>
                    </div>
                </div>
                <div class="card" data-food="Dessert" data-price="9500" data-image="image/Desserts.png">
                    <img class="food-img" src="image/Desserts.png" alt="">
                    <div class="food-title">
                        <h1>Dessert</h1>
                    </div>
                    <div class="desc-food">
                        <p>Sweet, satisfying treats that finish your meal with a burst of indulgent flavor.</p>
                    </div>
                    <div class="price">
                        <span>9,500 MMK</span><span><i class='bx bx-plus-circle plus-icon add-to-cart'></i> </span>
                    </div>
                </div>
            </div>
        </div>
</selection>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const card = this.closest('.card');
            const foodName = card.dataset.food;
            const price = parseInt(card.dataset.price);
            const image = card.dataset.image;
            
            // Get existing cart items from localStorage
            let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
            
            // Check if item already exists in cart
            const existingItem = cartItems.find(item => item.name === foodName);
            
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cartItems.push({
                    name: foodName,
                    price: price,
                    image: image,
                    quantity: 1
                });
            }
            
            // Save updated cart to localStorage
            localStorage.setItem('cartItems', JSON.stringify(cartItems));
            
            // Get the cart table body
            const cartTableBody = document.querySelector('.cart-table tbody');
            
            // Create new row
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td><img src="${image}" alt="${foodName}"></td>
                <td>${foodName}</td>
                <td>${price} MMK</td>
                <td>1</td>
                <td>${price} MMK</td>
                <td><a href="#" class="btn-delete">&times;</a></td>
            `;
            
            // Add the new row to the cart
            cartTableBody.appendChild(newRow);
            
            // Add delete functionality to the new row
            const deleteBtn = newRow.querySelector('.btn-delete');
            deleteBtn.addEventListener('click', function(e) {
                e.preventDefault();
                newRow.remove();
                
                // Remove item from localStorage
                cartItems = cartItems.filter(item => item.name !== foodName);
                localStorage.setItem('cartItems', JSON.stringify(cartItems));
                
                // Update cart count and total
                window.updateCartCount();
                window.updateCartTotal();
            });
            
            // Update cart count and total
            window.updateCartCount();
            window.updateCartTotal();
            
            // Show cart content
            const cartContent = document.getElementById('cart-content');
            cartContent.style.display = 'block';
        });
    });
});
</script>
</body>
</html>
<?php
include "footer.php";
?>