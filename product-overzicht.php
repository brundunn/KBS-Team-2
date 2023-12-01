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
<?php include 'header.php'
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
    <p>Welkom bij ons uitgebreide assortiment, waar kwaliteit, diversiteit en innovatie samenkomen om aan al jouw
        behoeften te voldoen.
        Ontdek een wereld van mogelijkheden terwijl je bladert door ons zorgvuldig samengestelde aanbod, ontworpen om
        aan de uiteenlopende
        wensen van onze gewaardeerde klanten te voldoen.</p><br>

    <div class="sidenav-raster-container">
        <div class="sidenav">
            <h3>Filter op:</h3><br>
            <form action="" method="post">
                <h4>Categorie</h4>

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

                // QUERY
                // Haal alle verschillende categorieën uit de database
                $sql = "SELECT DISTINCT category
                FROM product";
                // RESULT
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $cat = $row["category"];
                        echo '<input type="checkbox" name="category[]" value="' . $cat . '"';
                        if (isset($_POST['category'])) {
                            $category = $_POST["category"];

                            if (in_array("$cat", $category)) {
                                echo 'checked';
                            }
                        }
                        echo '>';
                        echo '<label for="category">' . ucfirst($cat) . '</label>';
                        echo '<br>';
                    }
                } else {
                    echo "Geen categorieën aanwezig";
                }
                $conn->close();
                ?>

                <!--                <input type="checkbox" name="category[]" value="laptops" --><?php
                //                if (isset($_POST['category'])) {
                //                    $category = $_POST["category"];
                //
                //                    if (in_array("laptops", $category)) {
                //                        echo 'checked';
                //                    }
                //                }
                //                ?>
                <!--                >-->
                <!--                <label for="category">Laptops</label>-->
                <!--                <br>-->
                <!--                <input type="checkbox" name="category[]" value="phones" --><?php
                //                if (isset($_POST['category'])) {
                //                    $category = $_POST["category"];
                //
                //                    if (in_array("phones", $category)) {
                //                        echo 'checked';
                //                    }
                //                }
                //                ?>
                <!--                >-->
                <!--                <label for="category">Smartphones</label>-->
                <!--                <br>-->
                <!--                <input type="checkbox" name="category[]" value="opslag" --><?php
                //                if (isset($_POST['category'])) {
                //                    $category = $_POST["category"];
                //
                //                    if (in_array("opslag", $category)) {
                //                        echo 'checked';
                //                    }
                //                }
                //                ?>
                <!--                >-->
                <!--                <label for="category">Opslag</label>-->
                <!--                <br>-->
                <!--                <input type="checkbox" name="category[]" value="routers" --><?php
                //                if (isset($_POST['category'])) {
                //                    $category = $_POST["category"];
                //
                //                    if (in_array("routers", $category)) {
                //                        echo 'checked';
                //                    }
                //                }
                //                ?>
                <!--                >-->
                <!--                <label for="category">Routers</label>-->
                <!--                <br>-->
                <!--                <input type="checkbox" name="category[]" value="componenten" --><?php
                //                if (isset($_POST['category'])) {
                //                    $category = $_POST["category"];
                //
                //                    if (in_array("componenten", $category)) {
                //                        echo 'checked';
                //                    }
                //                }
                //
                //                ?>
                <!--                >-->
                <!--                <label for="category">Componenten</label>-->
                <!--                <br>-->
                <!--                <input type="checkbox" name="category[]" value="desktops" --><?php
                //                if (isset($_POST['category'])) {
                //                    $category = $_POST["category"];
                //
                //                    if (in_array("desktops", $category)) {
                //                        echo 'checked';
                //                    }
                //                }
                //                ?>
                <!--                >-->
                <!--                <label for="category">Desktops</label>-->
                <!--                <br>-->
                <h4>Prijs</h4>
                €
                <input type="number" class="price-input" name="price-from" <?php
                if (isset($_POST["price-from"]))
                    echo 'value = "' . $_POST["price-from"] . '"';
                ?>>
                tot
                <input type="number" class="price-input" name="price-to" <?php
                if (isset($_POST["price-to"]))
                    echo 'value = "' . $_POST["price-to"] . '"';
                ?>>
                <h4>Populariteit</h4>
                <input id="submit" type="submit" value="Submit">
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

            $priceFromFilled = !empty($_POST["price-from"]) && is_numeric($_POST["price-from"]);
            $priceToFilled = !empty($_POST["price-to"]) && is_numeric($_POST["price-from"]);
            $categoryFilled = !empty($_POST["category"]);

            //if alles ingevuld
            if ($priceFromFilled && $priceToFilled && $categoryFilled) {
                $query = $query . " AND price BETWEEN " . $_POST["price-from"] . " AND " . $_POST["price-to"];
            }
            //if categorie niet ingevuld
            if ($priceFromFilled && $priceToFilled && empty($categoryFilled)) {
                $query = $query . " WHERE price BETWEEN " . $_POST["price-from"] . " AND " . $_POST["price-to"];
            }
            //alleen price to niet ingevuld
            if ($priceFromFilled && empty($priceToFilled) && $categoryFilled) {
                $query = $query . " AND price >= " . $_POST["price-from"];
            }
            //if price from niet ingevuld
            if (empty($priceFromFilled) && $priceToFilled && $categoryFilled) {
                $query = $query . " AND price <= " . $_POST["price-to"];
            }
            //alleen price to
            if (empty($priceFromFilled) && $priceToFilled && empty($categoryFilled)) {
                $query = $query . " WHERE price <= " . $_POST["price-to"];
            }
            //alleen price from
            if ($priceFromFilled && empty($priceToFilled) && empty($categoryFilled)) {
                $query = $query . " WHERE price >= " . $_POST["price-from"];
            }

            $query = $query . ";";

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
        include 'product-raster.php';
        toonProductRaster("$query");
        ?>
    </div>
</body>
</html>
