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
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet aspernatur atque esse molestiae
        praesentium, recusandae saepe ullam! A accusantium architecto aspernatur excepturi fugiat molestias obcaecati
        sequi similique voluptatem voluptatum?</p>

        <div class="sidenav">
            <h3>Filter op:</h3><br>
            <h4>Categorie</h4>
            <form action="" method="post">
            <input type="checkbox" name="category[]" value="laptops" <?php
            if (isset($_POST['category'])) {
                $category = $_POST["category"];

                if (in_array("laptops", $category)) {
                    echo 'checked';
                }
            }
            ?>>
            <label for="category">Laptops</label>
            <br>
            <input type="checkbox" name="category[]" value="phones" <?php
            if (isset($_POST['category'])) {
                $category = $_POST["category"];

                if (in_array("phones", $category)) {
                    echo 'checked';
                }
            }
            ?>>
            <label for="category">Smartphones</label>
            <br>
            <input type="checkbox" name="category[]" value="opslag" <?php
            if (isset($_POST['category'])) {
                $category = $_POST["category"];

                if (in_array("opslag", $category)) {
                    echo 'checked';
                }
            }
            ?>>
            <label for="category">Opslag</label>
            <br>
            <input type="checkbox" name="category[]" value="routers" <?php
            if (isset($_POST['category'])) {
                $category = $_POST["category"];

                if (in_array("routers", $category)) {
                    echo 'checked';
                }
            }
            ?>>
            <label for="category">Routers</label>
            <br>
            <input type="checkbox" name="category[]" value="componenten" <?php
            if (isset($_POST['category'])) {
                $category = $_POST["category"];

                if (in_array("componenten", $category)) {
                    echo 'checked';
                }
            }
            
            ?>>
            <label for="category">Componenten</label>
            <br>
            <input type="checkbox" name="category[]" value="desktops" <?php
            if (isset($_POST['category'])) {
                $category = $_POST["category"];

                if (in_array("desktops", $category)) {
                    echo 'checked';
                }
            }
            ?>>
            <label for="category">Desktops</label>
            <br>
            <h4>Prijsklasse</h4>
            <h4>Populariteit</h4>
            <input type="submit" value="Submit">
            </form>
            <?php
            if (isset($_POST["category"])) {
                print_r($_POST["category"]);
            }
            ?>

            <?php
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
<!--            <a href="#">About</a>-->
<!--            <a href="#">Services</a>-->
<!--            <a href="#">Clients</a>-->
<!--            <a href="#">Contact</a>-->
        </div>

    <?php
    $query = "";

    $query = $query . "WHERE ...";
    include 'product-raster.php';
    toonProductRaster("SELECT * FROM product");
    ?>

</body>
</html>
