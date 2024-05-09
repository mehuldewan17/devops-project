<?php
$servername = "127.0.0.1"; // Use MySQL server IP address
$port = "3306"; // MySQL server port (default is 3306)
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "astrology_db"; // Your database name

// Create connection
$conn = new mysqli($servername . ":" . $port, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully";
}
?>
