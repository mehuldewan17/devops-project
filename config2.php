<?php
ob_start(); // Start output buffering
// Your database connection code goes here
$host = "database"; // Docker service name for the MySQL container
$username = "devuser"; // MySQL username
$password = "root"; // MySQL password
$database = "devops"; // MySQL database name

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}
