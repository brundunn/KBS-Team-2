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
    <link href="src/reviews.css" rel="stylesheet">
</head>
<body>
<?php include 'header.php';
include 'product-raster.php';
?>
<div class="main-container">
    <!--    Breadcrumbs -->
    <ul class="breadcrumbs">
        <?php
        include 'src/breadcrumbs.php';

        echo breadcrumb('index.php', "Home", false);
        echo breadcrumb('#', 'Assortiment', true);
        ?>
    </ul>
    <hr>
    <!-- Einde breadcrumbs -->

    <h1>Assortiment</h1>
    <p style="margin-bottom: 0.5rem;">Welkom bij ons uitgebreide assortiment, waar kwaliteit, diversiteit en innovatie
        samenkomen om aan al jouw
        behoeften te voldoen.
        Ontdek een wereld van mogelijkheden terwijl je bladert door ons zorgvuldig samengestelde aanbod, ontworpen om
        aan de uiteenlopende
        wensen van onze gewaardeerde klanten te voldoen.</p>

    <?php
    if (isset($_GET["q"])) {
    $searchFor = $_GET["q"];
    echo '<h3 style="font-weight: normal; margin-bottom: 0.5rem;">Zoekresultaten voor: \'<span style="font-weight: bold;">' . $searchFor . '</span>\'</h3>';
    }
    ?>

    <div class="sidenav-raster-container">
        <div class="sidenav">
            <h3>Filter op:</h3><br>
            <form action="" method="post">

                <?php
                // DATABASE CONNECTIE
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "nerdy_gadgets_start";
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT DISTINCT category FROM product";
                $res = mysqli_query($conn, $sql);
                if ($res->num_rows > 0) {
                    echo '<h4>Categorie</h4>';
                while ($row = mysqli_fetch_assoc($res)) {
                    $category = $row["category"];
                    echo '<input type="checkbox" name="category[]" value="'.$category.'"';
                    if (isset($_POST['category'])) {
                        $selectedCategory = $_POST["category"];
                        if (in_array($category, $selectedCategory)) {
                            echo 'checked';
                        }
                    }
                    echo '>';
                    echo '<label for="category">'.ucfirst($category).'</label><br>';
                }
                }
                ?>
                <br>
                <h4>Prijs</h4>
                €
                <input type="tel" class="price-input" name="price-from" <?php
                if (isset($_POST["price-from"]))
                    echo 'value = "' . $_POST["price-from"] . '"';
                ?>>
                tot
                <input type="tel" class="price-input" name="price-to" <?php
                if (isset($_POST["price-to"]))
                    echo 'value = "' . $_POST["price-to"] . '"';
                ?>>
                <br>
                <br>
                <h4>Populariteit</h4>
                <input type="radio" id="five-stars" name="stars" value="five" class="filter-stars"<?php
                if (isset($_POST["stars"]) && $_POST["stars"] == "five") {
                    echo "checked";
                }
                ?>>
                <label for="five-stars"><?php printStars(5); ?></label>
                <br>
                <input type="radio" id="four-stars" name="stars" value="four" class="filter-stars"<?php
                if (isset($_POST["stars"]) && $_POST["stars"] == "four") {
                    echo "checked";
                }
                ?>>
                <label for="four-stars"><?php printStars(4); ?></label>
                <br>
                <input type="radio" id="three-stars" name="stars" value="three" class="filter-stars"<?php
                if (isset($_POST["stars"]) && $_POST["stars"] == "three") {
                    echo "checked";
                }
                ?>>
                <label for="three-stars"><?php printStars(3); ?></label>
                <br>
                <input type="radio" id="two-stars" name="stars" value="two" class="filter-stars"<?php
                if (isset($_POST["stars"]) && $_POST["stars"] == "two") {
                    echo "checked";
                }
                ?>>
                <label for="two-stars"><?php printStars(2); ?></label>
                <br>
                <input type="radio" id="one-star" name="stars" value="one" class="filter-stars"<?php
                if (isset($_POST["stars"]) && $_POST["stars"] == "one") {
                    echo "checked";
                }
                ?>>
                <label for="one-star"><?php printStars(1); ?></label>
                <br>
                <input type="radio" id="showAll" name="stars" value="all"<?php
                if (isset($_POST["stars"]) && $_POST["stars"] == "all") {
                    echo "checked";
                }
                ?>>
                <label for="showAll">Toon alles</label>

                <input id="submit" type="submit" value="Submit" class="submitKnopFiltering">
            </form>
            <?php
            $query = "SELECT * FROM product";

            if (isset($_POST["category"])) {
                $query = $query . " WHERE (";
                $res = $_POST["category"];
                $len = sizeof($res);
                if ($len == 1) {
                    foreach ($res as $category) {
                        $query = $query . 'category = "' . $category . '"';
                    }
                } else {
                    foreach ($res as $i => $category) {
                        if ($i != $len - 1) {
                            $query = $query . 'category = "' . $category . '" OR ';
                        } else {
                            $query = $query . 'category = "' . $category . '"';
                        }
                    }
                }
                $query = $query . ')';
            }

            $priceFromFilled = !empty($_POST["price-from"]);
            $priceToFilled = !empty($_POST["price-to"]);
            $categoryFilled = !empty($_POST["category"]);

            //if alles ingevuld
            if ($priceFromFilled && $priceToFilled && $categoryFilled) {
                $query = $query . " AND (price BETWEEN " . $_POST["price-from"] . " AND " . $_POST["price-to"] . ")";
            }
            //if categorie niet ingevuld
            if ($priceFromFilled && $priceToFilled && empty($categoryFilled)) {
                $query = $query . " WHERE (price BETWEEN " . $_POST["price-from"] . " AND " . $_POST["price-to"] . ")";
            }
            //alleen price to niet ingevuld
            if ($priceFromFilled && empty($priceToFilled) && $categoryFilled) {
                $query = $query . " AND (price >= " . $_POST["price-from"].")";
            }
            //if price from niet ingevuld
            if (empty($priceFromFilled) && $priceToFilled && $categoryFilled) {
                $query = $query . " AND (price <= " . $_POST["price-to"].")";
            }
            //alleen price to
            if (empty($priceFromFilled) && $priceToFilled && empty($categoryFilled)) {
                $query = $query . " WHERE (price <= " . $_POST["price-to"].")";
            }
            //alleen price from
            if ($priceFromFilled && empty($priceToFilled) && empty($categoryFilled)) {
                $query = $query . " WHERE (price >= " . $_POST["price-from"].")";
            }

            $selection = "";
            if (!empty($_POST["stars"])) {
                $selection = $_POST["stars"];
            }

            if (!empty($_POST["category"]) || !empty($_POST["price-from"]) || !empty($_POST["price-to"])) {
                if ($selection == "five") {
                    $query = $query . " AND (id IN (
SELECT product_id FROM product_review GROUP BY product_id
HAVING AVG(score) = 5
))";
                }
                if ($selection == "four") {
                    $query = $query . " AND (id IN (
SELECT product_id FROM product_review GROUP BY product_id
HAVING AVG(score) BETWEEN 4 AND 5
))";
                }
                if ($selection == "three") {
                    $query = $query . " AND (id IN (
SELECT product_id FROM product_review GROUP BY product_id
HAVING AVG(score) BETWEEN 3 AND 5
))";
                }
                if ($selection == "two") {
                    $query = $query . " AND (id IN (
SELECT product_id FROM product_review GROUP BY product_id
HAVING AVG(score) BETWEEN 2 AND 5
))";
                }
                if ($selection == "one") {
                    $query = $query . " AND (id IN (
SELECT product_id FROM product_review GROUP BY product_id
HAVING AVG(score) BETWEEN 1 AND 5
))";
                }
            } else {
                if ($selection == "five") {
                    $query = $query . " WHERE (id IN (
SELECT product_id FROM product_review GROUP BY product_id
HAVING AVG(score) = 5
))";
                }
                if ($selection == "four") {
                    $query = $query . " WHERE (id IN (
SELECT product_id FROM product_review GROUP BY product_id
HAVING AVG(score) BETWEEN 4 AND 5
))";
                }
                if ($selection == "three") {
                    $query = $query . " WHERE (id IN (
SELECT product_id FROM product_review GROUP BY product_id
HAVING AVG(score) BETWEEN 3 AND 5
))";
                }
                if ($selection == "two") {
                    $query = $query . " WHERE (id IN (
SELECT product_id FROM product_review GROUP BY product_id
HAVING AVG(score) BETWEEN 2 AND 5
))";
                }
                if ($selection == "one") {
                    $query = $query . " WHERE (id IN (
SELECT product_id FROM product_review GROUP BY product_id
HAVING AVG(score) BETWEEN 1 AND 5
))";
                }
            }

            if (isset($_GET["q"])) {
                $searchFor = $_GET["q"];
                if (!$priceFromFilled && !$priceToFilled && !$categoryFilled && empty($_POST["stars"])) {
                    // Er is een zoekterm ingevuld, maar verder geen filtering
                        $query = $query . " WHERE ";
                } else {
                    // Er is ook andere filtering aanwezig
                    $query = $query . " AND ";
                }
                $query = $query . "lower(name) LIKE '%$searchFor%'";
            }


            $query = $query . ";";
//                        echo $query;

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
            ?>
        </div>

        <?php
        toonProductRaster("$query");
        ?>
    </div>
</body>
</html>
