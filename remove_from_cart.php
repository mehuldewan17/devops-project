<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
}

// Check if item_id is provided via POST
if (isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];

    // Establish a connection to your MySQL database
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "";
    $dbName = "astrology_db";

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

    // Check the database connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL query to remove item from cart
    $sql = "DELETE FROM cart_items WHERE id = $item_id AND user_id = {$_SESSION['user_id']}";

    if ($conn->query($sql) === TRUE) {
        // Item removed successfully
        header("Location: cart.php");
        exit();
    } else {
        // Error occurred while removing item
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // Handle invalid requests
    echo "Invalid request";
}
?>
