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

<div class="content-wrapper">

<div class="main-container">
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
</div>
</body>



</html>
