<link rel="stylesheet" href="src/product-raster.css">
<div class="product-raster">
<?php
    $connection = mysqli_connect('127.0.0.1','root', '','nerdy_gadgets_start', '3306');
    $sql_selectALL = "SELECT * FROM product";



    $res = mysqli_query($connection,$sql_selectALL);
while($row = mysqli_fetch_assoc($res)){
    echo "{$row["id"]} {$row["voornaam"]} {$row["achternaam"]}\n";
}

//    $rows = mysqli_fetch_all($res, MYSQLI_ASSOC);

//    print_r($rows);


//     include 'views/rasteritem_view.php';
mysqli_close($connection);
    ?>
<!--    <div class="raster-item">product 1</div>-->
<!--    <div class="raster-item">product 2</div>-->
<!--    <div class="raster-item">product 3</div>-->
<!--    <div class="raster-item">product 4</div>-->
<!--    <div class="raster-item">product 5</div>-->
<!--    <div class="raster-item">product 6</div>-->
<!--    <div class="raster-item">product 7</div>-->
<!--    <div class="raster-item">product 8</div>-->
<!--    <div class="raster-item">product 9</div>-->



</div>