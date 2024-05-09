<!DOCTYPE html>
<html>
<head>
    <title>My Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .cart-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .cart-item {
            border-bottom: 1px solid #ddd;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-item img {
            max-width: 80px;
            height: auto;
            margin-right: 10px;
        }

        .cart-item-details {
            flex-grow: 1;
        }

        .cart-actions {
            text-align: right;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-remove {
            background-color: #ff6347;
            color: #ffffff;
        }

        .btn-proceed {
            background-color: #4caf50;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="cart-container">
        <h2>My Cart</h2>

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
        $sql = "SELECT ci.id, p.name, p.price, p.image_url FROM cart_items ci INNER JOIN products p ON ci.product_id = p.id WHERE ci.user_id = $user_id";

        $result = $conn->query($sql);

        // Check if the query was executed successfully
        if ($result === false) {
            die("Error executing query: " . $conn->error);
        }

        // Display cart items
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='cart-item'>";
                echo "<img src='{$row['image_url']}' alt='{$row['name']}' />";
                echo "<div class='cart-item-details'>";
                echo "<p><strong>{$row['name']}</strong></p>";
                echo "<p>Price: $" . number_format($row['price'], 2) . "</p>";
                echo "</div>";
                echo "<div class='cart-actions'>";
                echo "<form method='post' action='remove_from_cart.php'>";
                echo "<input type='hidden' name='item_id' value='{$row['id']}' />";
                echo "<button type='submit' class='btn btn-remove'>Remove</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
            }

            // Display "Proceed to Shipping Details" button
            echo "<div class='cart-actions'>";
            echo "<form method='post' action='shipping_details.php'>";
            echo "<button type='submit' class='btn btn-proceed'>Proceed to Shipping Details</button>";
            echo "</form>";
            echo "</div>";
        } else {
            echo "<p>Your cart is empty.</p>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>
</html>
