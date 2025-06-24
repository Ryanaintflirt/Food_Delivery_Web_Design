// Order page functionality
document.addEventListener('DOMContentLoaded', function() {
    // Get cart from localStorage
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const orderTable = document.querySelector('.tbl-full');
    
    // Clear existing table rows except header
    while (orderTable.rows.length > 1) {
        orderTable.deleteRow(1);
    }
    
    let totalAmount = 0;
    
    // Add cart items to table
    cart.forEach((item, index) => {
        const row = orderTable.insertRow();
        const itemTotal = item.price * item.quantity;
        totalAmount += itemTotal;
        
        row.innerHTML = `
            <td>${index + 1}</td>
            <td><img src="${item.image}" alt="${item.name}" style="width: 100px; height: 100px; object-fit: cover;"></td>
            <td>${item.name}</td>
            <td>${item.price.toLocaleString()} MMK</td>
            <td>${item.quantity}</td>
            <td>${itemTotal.toLocaleString()} MMK</td>
            <td><button class="btn-delete" onclick="removeItem(${index})">&times;</button></td>
        `;
    });
    
    // Add total row
    const totalRow = orderTable.insertRow();
    totalRow.innerHTML = `
        <th colspan="5">Total</th>
        <th>${totalAmount.toLocaleString()} MMK</th>
        <th></th>
    `;
    
    // Handle form submission
    const orderForm = document.querySelector('.form');
    orderForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (cart.length === 0) {
            alert('Your cart is empty!');
            return;
        }
        
        const formData = {
            fullName: this.querySelector('input[type="text"]').value,
            phone: this.querySelector('input[type="contact"]').value,
            email: this.querySelector('input[type="email"]').value,
            address: this.querySelectorAll('input[type="text"]')[1].value,
            items: cart,
            totalAmount: totalAmount,
            orderDate: new Date().toISOString()
        };
        
        // Here you would typically send this data to your server
        console.log('Order submitted:', formData);
        
        // Clear cart after successful order
        localStorage.removeItem('cart');
        alert('Order placed successfully!');
        window.location.href = 'index.php';
    });
});

// Function to remove item from cart
function removeItem(index) {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(cart));
    
    // Refresh the page to update the table
    location.reload();
} 