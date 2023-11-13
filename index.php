<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NerdyGadgets</title>
    <script src="js/readmore.js"></script>
    <link href="src/styles.css" rel="stylesheet">
    <link href="src/header.css" rel="stylesheet">
    <link href="src/homepage.css" rel="stylesheet">
    <link href="src/reviews.css" rel="stylesheet">
</head>
<body>
<?php include 'header.php';
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

        echo breadcrumb('#', 'Home', true)
        ?>
    </ul>
    <hr>
    <div class="brand-introduction-container">
        <div class="empty">

        </div>
        <div class="hero">
            <img class="intro-logo" src="img/Logo_KBS-removebg-preview.png" alt="logo">
            <h2>Nerdy Gadgets: Toevluchtsoord voor techliefhebbers en popcultuurfanaten.<span id="dots">...</span><span
                        id="more">
Het merk Nerdy Gadgets in Nederland is een buitengewone plek waar technologische innovatie en geek-cultuur samenkomen, en het nodigt iedereen uit om deel uit te maken van deze opwindende wereld van technologie en popcultuur.
Het is een toevluchtsoord voor techliefhebbers en popcultuurfanaten waar de nieuwste technologische snufjes en nerdy verzamelobjecten samenkomen voor een magische ervaring. </span>
            </h2>

            <button onclick="readMore()" id="myBtn">Read more</button>
        </div>
        <div class="shopping-experience">
            <ul>
                <li>
                    <a href="user-reviews.php">
                        <!--                    Recensies-->
                        <?php
                        include 'src/review-functions.php';
                        gemiddeldeScore("SELECT AVG(score) AS avgScore
FROM review", "SELECT COUNT(*) AS amountOfReviews
FROM review");
                        ?>
                    </a>
                </li>

                <h4>Recente reviews</h4>
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

                // QUERY - 3 meest recente reviews
                $sql = "SELECT r.id, u.first_name, u.surname_prefix, u.surname, r.date, r.score, r.description
FROM review r
JOIN user u ON r.user_id = u.id
ORDER BY date DESC LIMIT 3;";
                // RESULT
                $result = $conn->query($sql);


                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $date = substr($row["date"], 0, -3);

                        echo '<div class="review highlighted-review">';
                        echo printStars($row["score"]) .
                            $row["first_name"];
                        if (!empty($row["surname_prefix"])) { // check of persoon een tussenvoegsel heeft
                            echo " " . $row["surname_prefix"];
                        }
                        echo " " . $row["surname"] . "<br>" .
                            $date;
                        if (!empty($row["description"])) { // check of persoon een beschrijving heeft geplaatst bji de review
                            echo "<br>" . $row["description"];
                        }
                        echo '</div>';
                        echo "<br>";

                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
                <li>Eenvoudige navigatie</li>
                <li>Betaal met iDeal, Paypal en Afterpay!</li>
                <li>Voor tien uur besteld, morgen in huis!</li>
            </ul>
        </div>
    </div>
    <h2 class="highlighted-products-header">Uitgelichte producten</h2>
    <div class="highlighted-products">

        <?php
        function highlightedProducts($productnaam, $omschrijving, $prijs): string
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
                                <a href=\"\">
                                    <svg xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" stroke-width=\"1.5\" stroke=\"currentColor\"> 
                                        <path stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25\"/> 
                                    </svg> 
                                </a>
                            </div> 
                        </div>";
        }

        echo highlightedProducts('product 1', 'omschrijving 1', 5);
        echo highlightedProducts('nog een product', 'weer een omschrijving', 100);
        echo highlightedProducts('jaaaaaaaaaaa', 'beschrijving', 2.50);
        echo highlightedProducts('jaaaaaaaaaaa', 'beschrijving', 2.50);
        echo highlightedProducts('jaaaaaaaaaaa', 'beschrijving', 2.50);
        ?>
    </div>

</div>
</body>
</html>