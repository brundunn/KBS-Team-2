<?php

// CHECKEN OF DE GEBRUIKER IETS TOEVOEGT AAN DE WINKELWAGEN
// ZO JA, REGISTREER DIT DAN
if (isset($_POST["add_to_cart"])) {
    if (isset($_COOKIE["shopping_cart"])) {
        $cookie_data = stripslashes($_COOKIE["shopping_cart"]);
        $cart_data = json_decode($cookie_data, true);
    } else {
        $cart_data = array();
    }

    $item_id_list = array_column($cart_data, 'product_id');

    if (in_array($_POST["product_id"], $item_id_list)) {
        foreach ($cart_data as $keys => $values) {
            if ($cart_data[$keys]["product_id"] == $_POST["product_id"]) {
                $cart_data[$keys]["quantity"] = $cart_data[$keys]["quantity"] + $_POST["quantity"];
            }
        }
    } else {
        $item_array = array(
            'product_id' => $_POST["product_id"],
            'quantity' => $_POST["quantity"],
        );
        $cart_data[] = $item_array;
    }

    $item_data = json_encode($cart_data);
    setcookie('shopping_cart', $item_data, time() + (86400 * 30)); // cookie gaat weg na 1 dag
    header("Refresh:0");
}


// Als er geen ID is meegegeven, ga dan terug naar product-overzicht.php
if (empty($_GET["id"])) {
    header('Location: ' . "product-overzicht.php");
}

// DATABASE CONNECTIE
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nerdy_gadgets_start";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET["id"];

// QUERY
$sql = "SELECT * 
FROM product
    WHERE id=$id";
// RESULT
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        // variabelen toewijzen voor het gemak
        $name = $row["name"];
        $description = $row["description"];
        $price = $row["price"];
        $category = $row["category"];
        $imgSrc = "img/product_images/" . $row["image"] . ".jpg";


        // Get products from the same category
        $sameCategorySql = "SELECT * FROM product WHERE category='$category' AND id!=$id";
        $sameCategoryResult = $conn->query($sameCategorySql);
        $sameCategoryProducts = [];

        if ($sameCategoryResult->num_rows > 0) {
            while ($sameCategoryRow = $sameCategoryResult->fetch_assoc()) {
                $sameCategoryProducts[] = $sameCategoryRow;
            }
        }


    }
} else {
    echo "0 results";
    header('Location: ' . "product-overzicht.php");
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $name ?></title>
    <script src="js/readmore.js"></script>
    <link href="src/styles.css" rel="stylesheet">
    <link href="src/header.css" rel="stylesheet">
    <link href="src/reviews.css" rel="stylesheet">
    <link href="src/productpagina.css" rel="stylesheet">
    <link href="src/product-raster.css" rel="stylesheet">
</head>
<body>
<?php include 'header.php'
?>
<div class="main-container">
    <!--    Breadcrumbs -->
    <ul class="breadcrumbs">
        <?php
        include 'src/breadcrumbs.php';


        echo breadcrumb('index.php', 'Home', false);
        echo breadcrumb('product-overzicht.php', 'Assortiment', false);
        echo breadcrumb('#', "$name", true);
        ?>
    </ul>
    <hr>
    <!-- Einde breadcrumbs -->

    <!-- Begin productpagina -->
    <div class="product-informatie">
        <h2><?php echo $name ?></h2>
        <?php
        include 'product-raster.php';
//        include 'src/review-functions.php';
        // Toon gemiddelde score van het product, zonder het totaal aantal reviews
        gemiddeldeScoreZonderTotaal("SELECT AVG(score) AS avgScore
FROM product_review WHERE product_id = " . $id, "SELECT COUNT(*) AS amountOfReviews
FROM product_review WHERE product_id = " . $id);
        ?>
        <h3><?php echo "Prijs: €$price" ?></h3>  <!-- prijs -->
        <h4><?php echo "Categorie: $category" ?></h4> <!-- categorie -->
        <p><?php echo $description ?></p> <!-- beschrijving -->
        <img style="border-radius: 1rem; border: 1px solid #53556E; margin-top: 0.6rem;" src="<?php echo $imgSrc ?>" alt="<?php echo $name ?>"> <!-- afbeelding -->
    </div>

    <?php
    if (isset($_COOKIE["shopping_cart"])) {
        $cookie_data = stripslashes($_COOKIE["shopping_cart"]);
        $cart_data = json_decode($cookie_data, true);
    } else {
        $cart_data = array();
    }

    $item_id_list = array_column($cart_data, 'product_id');


    if (in_array($id, $item_id_list)) { // Als het product in de winkelwagen zit, toon dat dan
        echo '<button class="add-product-to-cart-button product-in-cart" style="margin-bottom: 1rem; margin-top: 1rem;">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="">
  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
</svg>

<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                    </svg>
                    <p>In winkelwagen</p></button>';


    } else {
        // Product toevoegen aan winkelwagen - button
        echo '<form method="post" action="" style="margin-bottom: 1rem; margin-top: 1rem;">
        <input type="hidden" name="quantity" value="1">
        <input type="hidden" name="product_id" value="' . $id . '">
                <button type="submit" name="add_to_cart" value="1" class="add-product-to-cart-button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor"
                         class="">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                    </svg>
                    <p>In winkelwagen</p>
                </button>
    </form>';
    }
    ?>

    <div class="product-list">
        <h2>Misschien bent u ook geïnteresseerd in:</h2>
        <?php

        toonProductRaster("SELECT * FROM product WHERE category='$category' AND id!=$id");
        ?>

<!--        --><?php //foreach ($sameCategoryProducts as $product) { ?>
<!--            <div class="product-item">-->
<!--                <a href="product.php?id=--><?php //echo $product['id']; ?><!--">-->
<!--                    <img src="img/product_images/--><?php //echo $product['image']; ?><!--.jpg"-->
<!--                         alt="--><?php //echo $product['name']; ?><!--">-->
<!--                    <h5>--><?php //echo $product['name']; ?><!--</h5>-->
<!--                </a>-->
<!--            </div>-->
<!--        --><?php //} ?>

    <br><br>
    <hr>
    <!-- Product review -->
    <h3>Reviews over <?php echo $name ?></h3>
    <?php
    if (!isset($_SESSION['loggedin'])) {
        echo '<p style="font-style: italic">Log in om een review achter te laten!</p>';
    } else {
        echo '<a href="write-review.php?type=product&id=' . $id . '">Schrijf review</a>';
    }


    gemiddeldeScore("SELECT AVG(score) AS avgScore
FROM product_review WHERE product_id = " . $id, "SELECT COUNT(*) AS amountOfReviews
FROM product_review WHERE product_id = " . $id);

    echo '<br>';

    //    include 'src/print-star-functions.php';

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
    // echo "Connected successfully<br>";

    // QUERY - haal alle product reviews op
    $sql = "SELECT pr.product_id, u.first_name, u.surname_prefix, u.surname, pr.date, pr.score, pr.description
FROM product_review pr
JOIN user u ON pr.user_id = u.id
WHERE pr.product_id = " . $id . "
ORDER BY date DESC;";
    // RESULT
    $result = $conn->query($sql);

    $ingekort = false;

    if ($result->num_rows > 0) { // checken of er product reviews zijn voor het product
        if ($result->num_rows > 4) { // als er meer dan 4 reviews zijn, gaan we het inkorten
// QUERY - nu ingekort
            $sql = "SELECT pr.product_id, u.first_name, u.surname_prefix, u.surname, pr.date, pr.score, pr.description
FROM product_review pr
JOIN user u ON pr.user_id = u.id
WHERE pr.product_id = " . $id . "
ORDER BY date DESC LIMIT 4;";
            // RESULT
            $result = $conn->query($sql);
            $ingekort = true;
        }

        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $date = substr($row["date"], 0, -3);

            echo '<div class="review highlighted-review">';
            echo printStars($row["score"]) .
                "<h3>" . $row["first_name"];
            if (!empty($row["surname_prefix"])) { // check of persoon een tussenvoegsel heeft
                echo " " . $row["surname_prefix"];
            }
            echo " " . $row["surname"] . "</h3>" .
                "<h4>" . $date . '</h4>';
            if (!empty($row["description"])) { // check of persoon een beschrijving heeft geplaatst bji de review
                echo "<p>" . $row["description"] . '</p>';
            }
            echo '</div>';
            echo "<br>";

        }
        if ($ingekort) {
            echo '<a class="reviews-ingekort" href="product-reviews.php?id=' . $id . '">Bekijk alle reviews<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
</svg>
</a>';
        }
    } else {
        echo "Er zijn nog geen reviews voor dit product achtergelaten.";
    }
    $conn->close();
    ?>
</div>
</body>
</html>

