<link rel="stylesheet" href="src/product-raster.css">
<div class="product-raster">
    <?php
    $connection = mysqli_connect('127.0.0.1','root', '','nerdy_gadgets_start', '3306');
    $sql_selectALL = "SELECT * FROM product LIMIT 2";
    $res = mysqli_query($connection,$sql_selectALL);

    while($row = mysqli_fetch_assoc($res)){
        $productID = $row["id"];
        $productImage = $row["image"];
        $productName = $row["name"];
        $productDesc = $row['description'];
        $productPrice = $row['price'];

        echo "<a href='product.php?id=$productID'
                <div class='raster-item'>
                <div class='raster-img'><img src ='img/product_images/$productImage.jpg'></div>
                <div class='raster-name'>$productName</div>
                <div class='raster-price'>€$productPrice</div>
                </div>
                </a>";
    }
    mysqli_close($connection);
    ?>
</div>