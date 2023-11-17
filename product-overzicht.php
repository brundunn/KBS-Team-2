<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Assortiment</title>
    <script src="js/readmore.js"></script>
    <link href="src/styles.css" rel="stylesheet">
    <link href="src/header.css" rel="stylesheet">
    <link href="src/product-overzicht.css" rel="stylesheet">
    <link href="src/product-raster.css" rel="stylesheet">

</head>
<body>
<?php include 'header.php'
?>
<div class="main-container">
    <!--    Breadcrumbs -->
    <ul class="breadcrumbs">
        <?php
        function breadcrumb($link, $naam, $huidigePagina): string
        {
            $naam = ucfirst($naam);

            if (!$huidigePagina) {
                return "<li><a href=\"$link\">$naam</a></li>";
            } else {
                return "<li>$naam</li>";
            }
        }

        echo breadcrumb('index.php', "Home", false);
        echo breadcrumb('#', 'Assortiment', true);
        ?>
    </ul>
    <hr>
    <!-- Einde breadcrumbs -->

    <h1>Assortiment</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet aspernatur atque esse molestiae
        praesentium, recusandae saepe ullam! A accusantium architecto aspernatur excepturi fugiat molestias obcaecati
        sequi similique voluptatem voluptatum?</p>

        <div class="sidenav">
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Clients</a>
            <a href="#">Contact</a>
        </div>

    <!-- DATABASE CONNECTIE -->
    <?php
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
    // echo "Connected successfully<br>";


    // QUERY
    $sql = "SELECT * FROM product";
    // RESULT
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // PRODUCT RASTER
        echo '<div class="product-raster">';
        $connection = mysqli_connect('127.0.0.1', 'root', '', 'nerdy_gadgets_start', '3306');
        $sql_selectALL = "SELECT * FROM product";
        $res = mysqli_query($connection, $sql_selectALL);

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
    ?>

</body>
</html>
