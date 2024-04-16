<?php
session_start(); // Start session to access session variables

// Display cart items
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    echo "<h2>Your Shopping Cart</h2>";
    echo "<ul>";
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        // Fetch product details from your database using $product_id
        // Display product name, price, quantity, etc.
        echo "<li>Product ID: {$product_id}, Quantity: {$quantity}</li>";
    }
    echo "</ul>";
} else {
    echo "<p>Your cart is empty</p>";
}
?>
