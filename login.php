<?php
session_start();

// Establish a connection to your MySQL database
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "astrology_db";

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$username = $_POST['username'];
$password = $_POST['password'];  // Plain text password

// Query to check if the user exists
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Compare entered plain text password with the one stored in the database
    if ($password === $row['password']) {
        echo "Login successful!";
        // You can set session variables here if needed
    } else {
        echo "Invalid password";
    }
} else {
    echo "User not found";
}

// Close the database connection
$conn->close();
?>
