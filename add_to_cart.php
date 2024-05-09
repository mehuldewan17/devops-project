<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
}

// Retrieve user_id from session
$user_id = $_SESSION['user_id'];

// Check if product_id is submitted via POST
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Establish a database connection
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "";
    $dbName = "astrology_db";

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

    // Check the database connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL query to insert into cart_items
    $stmt = $conn->prepare("INSERT INTO cart_items (user_id, product_id) VALUES (?, ?)");

    // Check if the prepared statement was successfully created
    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("ii", $user_id, $product_id);

        if ($stmt->execute()) {
            // Cart item added successfully, redirect back to products page
            header("Location: products.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Error: Unable to prepare statement.";
    }

    // Close database connection
    $conn->close();
} else {
    // Handle invalid requests
    echo "Invalid request";
}
?>
