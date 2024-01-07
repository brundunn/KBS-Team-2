<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NerdyGadgets</title>
    <script src="js/readmore.js"></script>
    <script src="js/slider.js"></script>
    <link href="src/styles.css" rel="stylesheet">
    <link href="src/header.css" rel="stylesheet">
    <link href="src/homepage.css" rel="stylesheet">
    <link href="src/reviews.css" rel="stylesheet">
    <link href="src/slider.css" rel="stylesheet">
    <link href="src/product-raster.css" rel="stylesheet">
</head>
<body>
<button onclick="veranderKleuren()">KLIK NIET OP MIJ!</button>
<script>
    function veranderKleuren() {
        var body = document.body;

        body.style.backgroundColor = getRandomColor();
        body.style.color = getRandomColor();
    }

    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
</script>

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


    <div class="slideshow-container">

        <div class="mySlides fade">
            <div class="numbertext">1 / 3</div>
            <img src="img/slide1.jpg" style="width:100%">
        </div>

        <div class="mySlides fade">
            <div class="numbertext">2 / 3</div>
            <img src="img/slide2.jpg" style="width:100%">
        </div>

        <div class="mySlides fade">
            <div class="numbertext">3 / 3</div>
            <img src="img/slide3.jpg" style="width:100%">
        </div>

        <a class="prev" onclick="plusSlides(-1)">❮</a>
        <a class="next" onclick="plusSlides(1)">❯</a>

    </div>
    <br>

    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>

    <!-- Dynamische HTML Slider --->
    <div class="brand-introduction-container">
        <div class="empty"></div>



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
            <?php include 'product-raster.php';
            // De review functions worden al ge-include in product-raster.php, dus deze hoeven niet opnieuw te worden ge-include
            ?>
            <ul>
                <li>
                    <a href="user-reviews.php">
                        <!--                    Recensies-->
                        <h4>Reviews</h4>
                        <?php
//                        include 'src/review-functions.php';
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
                    echo "Er zijn nog geen reviews voor NerdyGadgets achtergelaten.<br><br>";
                }
                $conn->close();
                ?>
<!--                <li>Eenvoudige navigatie</li>-->
                <li>Betaal met iDeal, PayPal en Afterpay!</li>
                <li>Voor 22:00 uur besteld, morgen in huis!</li>
            </ul>
        </div>
    </div>
    <h2 class="highlighted-products-header">Uitgelichte producten</h2>
    <?php

    toonProductRaster("SELECT * FROM product WHERE category = 'laptops' ORDER BY price DESC LIMIT 5");
    ?>
</body>

</html>