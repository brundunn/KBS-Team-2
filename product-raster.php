<?php

include 'src/review-functions.php';

function toonProductRaster($query) {
    // DATABASE CONNECTIE
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "nerdy_gadgets_start";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname); // Connect direct met de database ipv alleen met SQL
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $connection = mysqli_connect('127.0.0.1', 'root', '', 'nerdy_gadgets_start', '3306');

    // QUERY
    $sql_selectALL = $query;
    $res = mysqli_query($connection, $sql_selectALL);
//    $sql = "SELECT * FROM product";
    // RESULT
//    $result = $conn->query($sql);

    if ($res->num_rows > 0) {
        // PRODUCT RASTER
        echo '<div class="product-raster">';

//        $sql_selectALL = "SELECT * FROM product WHERE category = 'laptops' ORDER BY price DESC LIMIT 5";


        while ($row = mysqli_fetch_assoc($res)) {
            $productID = $row["id"];
            $productImage = $row["image"];
            $productName = $row["name"];
            $productDesc = $row['description'];
            $productPrice = $row['price'];

            echo "<a href='product.php?id=$productID'>";
            echo "<div class='raster-item'>";
            echo "<div class='raster-img'><img src ='img/product_images/$productImage.jpg' alt='$productID'></div>";
            echo "<h3 class='raster-name'>$productName</h3>";
            gemiddeldeScoreZonderTotaal("SELECT AVG(score) AS avgScore
FROM product_review WHERE product_id = " . $productID, "SELECT COUNT(*) AS amountOfReviews
FROM product_review WHERE product_id = " . $productID);
            echo "<div class='raster-price-and-link-container'>";
            echo "<p class='raster-price'>€$productPrice</p>";
            echo '
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"> 
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"></path> 
                        </svg> 
             ';
            echo "</div>";
            echo "</div>";
            echo "</a>";
        }
        mysqli_close($connection);
        echo "</div>";
    } else {
        echo "0 results";
    }
    $conn->close();
}