create database if not exists good_food;    
use good_food;

-- Create categories table
CREATE TABLE IF NOT EXISTS categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    image VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create food_items table
CREATE TABLE IF NOT EXISTS food_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255) NOT NULL,
    category_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Create contacts table
CREATE TABLE IF NOT EXISTS contacts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    subject VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'replied') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create contacts table
CREATE TABLE IF NOT EXISTS contacts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    subject VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'replied') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create orders table
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    customer_phone VARCHAR(20) NOT NULL,
    customer_email VARCHAR(100) NOT NULL,
    customer_age INT NOT NULL,
    customer_address TEXT NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'processing', 'delivered', 'cancelled') DEFAULT 'pending',
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    payment_method ENUM('cash', 'card') DEFAULT 'cash',
    payment_status ENUM('pending', 'paid') DEFAULT 'pending'
);

-- Create order_items table
CREATE TABLE IF NOT EXISTS order_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    food_item_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (food_item_id) REFERENCES food_items(id)
);

-- Create admin table
CREATE TABLE IF NOT EXISTS admin (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert sample categories
INSERT INTO categories (name, image) VALUES
('Pizza', 'img/category/pizza.jpg'),
('Sandwich', 'img/category/sandwich.jpg'),
('Burger', 'img/category/burger.jpg'),
('Spaghetti', 'img/category/Spaghetti.jpg'),
('Sushi', 'img/category/sushi.jpg'),
('Ice Cream', 'img/category/IceCream.jpg');

-- Insert sample food items
INSERT INTO food_items (name, description, price, image, category_id) VALUES
('Margherita Pizza', 'Classic tomato sauce, mozzarella, and fresh basil.', 15000.00, 'img/food/MargheritaPizza.jpg', 1),
('Pepperoni Pizza', 'Spicy pepperoni, melted cheese, and house-made sauce.', 13000.00, 'img/food/PepperoniPizza.jpg', 1),
('Tuna Melt Sandwich', 'Creamy tuna with cheese, grilled to golden perfection.', 10000.00, 'img/food/TunaMeltSandwich.jpg', 2),
('Grilled Chicken Sandwich', 'Grilled chicken breast with lettuce, tomato, and mayo.', 8500.00, 'img/food/GrilledChickenSandwich.jpg', 2),
('Beef Burger', 'Wagyu beef with toasted buns, cheese, tomato, and onion.', 9500.00, 'img/food/BeefBurger.jpg', 3),
('Cheese Chicken Burger', 'Crispy chicken patty with cheddar and veggies.', 7500.00, 'img/food/CheeseChickenBurger.jpg', 3),
('Spaghetti Bolognese', 'Rich tomato sauce with minced beef and herbs.', 18000.00, 'img/food/SpaghettiBolognese.jpg', 4),
('Creamy Alfredo Pasta', 'Pasta in white cream sauce with mushroom and chicken.', 23000.00, 'img/food/CreamyAlfredoPasta.jpg', 4),
('Salmon Nigiri', 'Fresh salmon over seasoned rice.', 6500.00, 'img/food/SalmonNigiri.jpg', 5),
('California Rolls', 'Crab, avocado, cucumber wrapped in seaweed & rice.', 13500.00, 'img/food/CaliforniaRolls.jpg', 5),
('Vanilla Sundae', 'Classic vanilla with chocolate syrup and nuts.', 9500.00, 'img/food/VanillaSundae.jpg', 6),
('Strawberry Delight', 'Strawberry ice cream with fresh fruit & wafer.', 10000.00, 'img/food/StrawberryDelight.jpg', 6);



INSERT INTO admin (username, password) VALUES 
('admin', 'admin'),
('admin1','admin123'); 
