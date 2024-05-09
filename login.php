<?php
session_start();

// Retrieve form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $sql = "SELECT * FROM users1 WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Compare entered plain text password with the one stored in the database
        if ($password === $row['password']) {
            // Start a PHP session
            $_SESSION['username'] = $row['username']; // Store username in session
            $_SESSION['user_id'] = $row['id']; // Assuming 'id' is the column name in your 'users1' table

            // Redirect to products page
            header("Location: products.php");
            exit();
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }

    // Close the database connection
    $conn->close();
}
?>
