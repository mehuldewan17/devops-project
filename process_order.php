<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $product_id = 1; // Adjust this based on your product
    $quantity = 1; // Adjust this based on the quantity ordered

    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postal_code = $_POST['postal_code'];
    $country = $_POST['country'];

    // Establish database connection
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "";
    $dbName = "astrology_db";

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert order into database
    $sql = "INSERT INTO orders (user_id, product_id, quantity, address, city, state, postal_code, country) 
            VALUES ($user_id, $product_id, $quantity, '$address', '$city', '$state', '$postal_code', '$country')";

    if ($conn->query($sql) === TRUE) {
        // Order placed successfully
        echo "Order placed successfully!";
        // Redirect or display confirmation message
    } else {
        echo "Error placing order: " . $conn->error;
    }

    $conn->close();
}
?>
