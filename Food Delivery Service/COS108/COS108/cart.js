// Initialize cart from session storage or create empty cart
let cart = JSON.parse(sessionStorage.getItem('cart')) || [];

// Function to format currency
function formatCurrency(amount) {
    return amount.toLocaleString('en-US') + ' MMK';
}

// Update cart count display
function updateCartCount() {
    const cartCount = document.getElementById('cart-count');
    if (cartCount) {
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        cartCount.textContent = totalItems;
    }
}

// Update cart dropdown content
function updateCartDropdown() {
    const cartContent = document.getElementById('cart-content');
    if (!cartContent) return;

    const cartTable = cartContent.querySelector('.cart-table tbody');
    if (!cartTable) return;

    // Clear existing items
    cartTable.innerHTML = '';
    
    let total = 0;

    // Add each item to the dropdown
    cart.forEach((item, index) => {
        const row = document.createElement('tr');
        const itemTotal = item.price * item.quantity;
        total += itemTotal;

        row.innerHTML = `
            <td><img src="${item.image}" alt="${item.name}" style="width: 50px; height: 50px; object-fit: cover;"></td>
            <td>${item.name}</td>
            <td>${formatCurrency(item.price)}</td>
            <td>${item.quantity}</td>
            <td>${formatCurrency(itemTotal)}</td>
            <td>
                <button onclick="removeFromCart(${index})" class="remove-btn">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        `;
        cartTable.appendChild(row);
    });

    // Update total amount
    const totalElement = document.getElementById('cart-total-amount');
    if (totalElement) {
        totalElement.textContent = formatCurrency(total);
    }

    // If cart is empty, hide the dropdown
    if (cart.length === 0) {
        cartContent.classList.remove('show');
    }
}

// Add item to cart
function addToCart(event) {
    event.preventDefault();
    const form = event.target;
    const foodItem = form.closest('.food-menu-box');
    const name = foodItem.querySelector('h4').textContent;
    const price = parseFloat(foodItem.querySelector('.food-price').textContent.replace(/[^0-9.-]+/g, ''));
    const quantity = parseInt(foodItem.querySelector('input[type="number"]').value);
    const image = foodItem.querySelector('img').src;

    console.log('Adding to cart:', { name, price, quantity, image }); // Debug log

    // Check if item already exists in cart
    const existingItem = cart.find(item => item.name === name);
    if (existingItem) {
        existingItem.quantity += quantity;
    } else {
        cart.push({
            name: name,
            price: price,
            quantity: quantity,
            image: image
        });
    }

    // Save to session storage
    sessionStorage.setItem('cart', JSON.stringify(cart));
    console.log('Cart after adding:', cart); // Debug log

    // Update displays
    updateCartCount();
    updateCartDropdown();

    // Show success message
    alert('Item added to cart!');
}

// Remove item from cart
function removeFromCart(index) {
    console.log('Removing item at index:', index); // Debug log
    cart.splice(index, 1);
    sessionStorage.setItem('cart', JSON.stringify(cart));
    console.log('Cart after removing:', cart); // Debug log
    
    // Update displays
    updateCartCount();
    updateCartDropdown();
    displayCart();
}

// Display cart items in order page
function displayCart() {
    const cartTable = document.querySelector('.tbl-full');
    if (!cartTable) return;

    let cartHTML = `
        <tr>
            <th>S.N.</th>
            <th>Food</th>
            <th>Name</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
    `;

    let total = 0;
    cart.forEach((item, index) => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;
        cartHTML += `
            <tr>
                <td>${index + 1}</td>
                <td><img src="${item.image}" alt="${item.name}" width="100"></td>
                <td>${item.name}</td>
                <td>${formatCurrency(item.price)}</td>
                <td>${item.quantity}</td>
                <td>${formatCurrency(itemTotal)}</td>
                <td>
                    <button onclick="removeFromCart(${index})" class="btn-danger">Remove</button>
                </td>
            </tr>
        `;
    });

    cartHTML += `
        <tr>
            <td colspan="5" class="text-right"><strong>Total Amount:</strong></td>
            <td colspan="2"><strong>${formatCurrency(total)}</strong></td>
        </tr>
    `;

    cartTable.innerHTML = cartHTML;

    // Update hidden input fields for order form
    const totalAmountInput = document.getElementById('total_amount');
    const cartItemsInput = document.getElementById('cart_items');
    if (totalAmountInput && cartItemsInput) {
        totalAmountInput.value = total;
        cartItemsInput.value = JSON.stringify(cart);
    }
}

// Initialize cart display when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners to all add-to-cart forms
    const addToCartForms = document.querySelectorAll('.add-to-cart-form');
    addToCartForms.forEach(form => {
        form.addEventListener('submit', addToCart);
    });

    // Initialize all displays
    updateCartCount();
    updateCartDropdown();
    displayCart();

    // Toggle cart dropdown in header
    const cartIcon = document.getElementById('shopping-cart');
    const cartContent = document.getElementById('cart-content');
    
    if (cartIcon && cartContent) {
        // Prevent the default link behavior
        cartIcon.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            cartContent.classList.toggle('show');
        });

        // Close cart when clicking outside
        document.addEventListener('click', function(e) {
            if (!cartIcon.contains(e.target) && !cartContent.contains(e.target)) {
                cartContent.classList.remove('show');
            }
        });

        // Prevent clicks inside the cart from closing it
        cartContent.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
}); 