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

// Prepare and execute SQL query to retrieve cart items
$sql = "SELECT ci.product_id, p.name, p.price, ci.quantity FROM cart_items ci INNER JOIN products p ON ci.product_id = p.id WHERE ci.user_id = $user_id";

$result = $conn->query($sql);

// Check if the query was executed successfully
if ($result === false) {
    die("Error executing query: " . $conn->error);
}

// Display cart items
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p>Product: " . $row['name'] . ", Price: $" . $row['price'] . ", Quantity: " . $row['quantity'] . "</p>";
    }
} else {
    echo "Your cart is empty.";
}

// Close the database connection
$conn->close();
?>
