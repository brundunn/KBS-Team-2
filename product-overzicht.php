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
    <link href="src/Assortiment.css" rel="stylesheet">


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

        echo breadcrumb('index.php', 'Home', false);
        echo breadcrumb('#', 'Assortiment', true)
        ?>
    </ul>
    <hr>
    <!-- Einde breadcrumbs -->

    <h1>Assortiment</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet aspernatur atque esse molestiae
        praesentium, recusandae saepe ullam! A accusantium architecto aspernatur excepturi fugiat molestias obcaecati
        sequi similique voluptatem voluptatum?</p>

    <!-- DATABASE CONNECTIE -->
<!--    --><?php
//    $servername = "localhost";
//    $username = "root";
//    $password = "";
//    $dbname = "nerdy_gadgets_start";

//    // Create connection
//    $conn = new mysqli($servername, $username, $password, $dbname); // Connect direct met de database ipv alleen met SQL
//    // Check connection
//    if ($conn->connect_error) {
//        die("Connection failed: " . $conn->connect_error);
//    }
//    // echo "Connected successfully<br>";
//
//
//    // QUERY
//    $sql = "SELECT * FROM product
//    LIMIT 1";
//    // RESULT
//    $result = $conn->query($sql);
//
//
//    if ($result->num_rows > 0) {
//        // output data of each row
//        while ($row = $result->fetch_assoc()) {
//
//            echo "<a href='product.php?id=" . $row["id"] .
//                "'>id: " . $row["id"] .
//                " <br> name: " . $row["name"] .
//                " <br> description: " . $row["description"] .
//                " <br> price: " . $row["price"] .
//                " <br> category: " . $row["category"] .
//                " <br> <img src=\"img/product_images/" . $row["image"] . ".jpg\" alt=\"" . $row["name"] . "\">" .
//                "</a>" .
//                "<br><br>";
//        }
//    } else {
//        echo "0 results";
//    }
//    $conn->close();
//    ?>
    <div class="sidenav">
        <a href="#">About</a>
        <a href="#">Services</a>
        <a href="#">Clients</a>
        <a href="#">Contact</a>
    </div>
    <div class="Assortment-products">

        <?php
        function highlightedProducts($productnaam, $omschrijving, $foto, $prijs): string
        {
            $productnaam = ucfirst($productnaam);
            $omschrijving = ucfirst($omschrijving);
            if (!is_numeric($prijs)) {
                $prijs = "?";
            }
            return "<div class=\"highlighted-product\">
                <h3>$productnaam</h3>
                <p>$omschrijving</p>
                <div class=\"price-and-product-link\">
                    <p class=\"prijs\">€ $prijs</p>
                    <img class=Photo src=\"$foto\" alt=\"$productnaam\">
                    <a href=\"\">
                        <svg xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" stroke-width=\"1.5\" stroke=\"currentColor\"> 
                            <path stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25\"/> 
                        </svg> 
                    </a>
                </div> 
            </div>";
        }

        echo highlightedProducts('Iphone 15', 'Apple iPhone 15 128GB Zwart', "img/IPHONE15.png", 999.99);
        echo highlightedProducts('Dell XPS 15', 'Dell XPS 15 9520 Laptop - Intel® Core™ i7-12700H - 16GB - 512GB SSD - Intel® Iris® Xe Graphics', "img/dellxps.png", 1499);
        echo highlightedProducts('Galaxy Z Fold 5', '', "img/fold.png", 1299);
        echo highlightedProducts('Ipad Pro', 'Apple iPad Pro (2022) 12.9 inch 128GB Wifi Space Gray', "img/ipad.png", 1279);
        echo highlightedProducts('Apple watch', 'Apple watch ultra 46MM', "img/applewatch.png", 899);
        ?>


    </div>


</div>
</body>

</html>
