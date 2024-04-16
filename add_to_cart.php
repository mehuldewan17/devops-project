<?php
session_start(); // Start session to access session variables

// Check if product_id is submitted via POST
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Initialize or retrieve the shopping cart array in the session
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array(); // Initialize cart if not exists
    }

    // Add the product to the cart (you can modify this logic as per your needs)
    // Here, we use the product_id as the key and store the quantity as the value
    if (isset($_SESSION['cart'][$product_id])) {
        // If product already exists in cart, increment the quantity
        $_SESSION['cart'][$product_id] += 1;
    } else {
        // If product does not exist in cart, add it with quantity = 1
        $_SESSION['cart'][$product_id] = 1;
    }

    // Redirect back to products page or any other page after adding to cart
    header("Location: products.php");
    exit();
} else {
    // Handle invalid requests (e.g., direct access to add_to_cart.php)
    echo "Invalid request";
}
?>
