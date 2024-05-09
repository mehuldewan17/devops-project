<!DOCTYPE html>
<html>
<head>
    <title>Our Services</title>
    <style>
     .product {
            width: 30%; /* Adjust the width as needed */
            float: left;
            margin-right: 2%; /* Adjust the margin as needed */
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        .product:last-child {
            margin-right: 0; /* Remove margin for the last product in each row */
        }

        .product img {
            max-width: 100%;
            height: 500px;
        }

        .review-cart-btn {
            clear: both;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>AstroService</h2>
    <div>
        <?php
        // Sample product data with images
        $products = array(
            array("id" => 1, "name" => "Aspects in Astrology", "price" => 10.00, "image" => "Images\810qoOnEmgL._AC_UF1000,1000_QL80_.jpg"),
            array("id" => 2, "name" => "Astrology  - Planet Personality and Signs", "price" => 15.00, "image" => "Images\astrology-book.jpg"),
            array("id" => 3, "name" => "Decode the Stars", "price" => 20.00, "image" => "Images\image.jpg"),
            array("id" => 4, "name" => "Complete Book Of Astrology", "price" => 25.00, "image" => "Images\p1.jpg"),
            array("id" => 5, "name" => "5 Min Video Call", "price" => 30.00, "image" => "Images\img1.jpg"),
            array("id" => 6, "name" => "10 Min Video Call", "price" => 35.00, "image" => "Images\img1.jpg"),
            array("id" => 7, "name" => "15 Min Video Call", "price" => 40.00, "image" => "Images\img1.jpg"),
            array("id" => 8, "name" => "Personal Meet", "price" => 300.00, "image" => "product8.jpg"),
            array("id" => 9, "name" => "Personal Meet", "price" => 300.00, "image" => "product8.jpg"),

        
        );

        // Display products
        foreach ($products as $product) {
            echo "<div class='product'>";
            echo "<img src='{$product['image']}' alt='{$product['name']}' />";
            echo "<h3>{$product['name']}</h3>";
            echo "<p>Price: $" . number_format($product['price'], 2) . "</p>";
            echo "<form method='post' action='add_to_cart.php'>";
            echo "<input type='hidden' name='product_id' value='{$product['id']}' />";
            echo "<input type='submit' value='Add to Cart' />";
            echo "</form>";
            echo "</div>";
        }
        ?>
    </div>
     <!-- "Review Cart" button -->
     <div class="review-cart-btn">
        <a href="cart.php" class="btn btn-primary">Review Cart</a>
    </div>

</body>
</html>
