<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bestellingen</title>
    <link href="src/styles.css" rel="stylesheet">
    <link href="src/header.css" rel="stylesheet">
    <link rel="stylesheet" href="src/shopping-cart.css">
    <link rel="stylesheet" href="src/reviews.css">
    ;
</head>
<body>
<?php include 'header.php';
include 'src/review-functions.php';
?>
<div class="main-container">
    <!--    Breadcrumbs -->
    <ul class="breadcrumbs">
        <?php
        include 'src/breadcrumbs.php';

        echo breadcrumb('index.php', 'Home', false);
        echo breadcrumb('#', 'Bestellingen', true)
        ?>
    </ul>
    <hr>

    <h1>Mijn bestellingen</h1>
    <p style="margin-bottom: 0.6rem">Op deze pagina vindt u uw voorheen geplaatste bestellingen.</p>

    <?php
    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'])) {
        header('Location: index.php');
        exit;
    }
    $user_id = $_SESSION["user_id"];
    // DATABASE CONNECTIE
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "nerdy_gadgets_start";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if (mysqli_connect_errno()) {
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    // QUERY
    $sql = "SELECT * 
FROM `order` WHERE user_id = $user_id ORDER BY order_date DESC";
    // RESULT
    $result = $conn->query($sql);


    $total = 0;
    $count = 0;

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div style="padding-bottom: 1.5rem;">';

            // variabelen toewijzen voor het gemak
            $order_id = $row["id"];
            $date = $row["order_date"];
            $user_id = $row["user_id"];

            echo "<h1>Order #$order_id</h1>";
            echo "<span style='font-weight: bold;'>Geplaatst op: </span><span>$date</span>";


            $conn2 = new mysqli($servername, $username, $password, $dbname);
            if ($conn2->connect_error) {
                die("Connection failed: " . $conn2->connect_error);
            }
            if (mysqli_connect_errno()) {
                exit('Failed to connect to MySQL: ' . mysqli_connect_error());
            }
            // QUERY
            $sql2 = "SELECT * 
FROM `order_item` WHERE order_id = $order_id";
            // RESULT
            $result2 = $conn2->query($sql2);


            if ($result2->num_rows > 0) {
                while ($row = $result2->fetch_assoc()) {

                    $quantity = $row["quantity"];
                    // variabelen toewijzen voor het gemak
                    $product_id = $row["product_id"];
                    $conn3 = new mysqli($servername, $username, $password, $dbname);
                    if ($conn3->connect_error) {
                        die("Connection failed: " . $conn3->connect_error);
                    }
                    if (mysqli_connect_errno()) {
                        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
                    }
                    // QUERY
                    $sql3 = "SELECT * 
FROM `product` WHERE id = $product_id";
                    // RESULT
                    $result3 = $conn3->query($sql3);
                    if ($result3->num_rows > 0) {

                        while ($row = $result3->fetch_assoc()) {

                            // variabelen toewijzen voor het gemak
                            $name = $row["name"];
                            $description = $row["description"];
                            $price = $row["price"];
                            $category = $row["category"];
                            $imgSrc = "img/product_images/" . $row["image"] . ".jpg";
                        }


                    } else {
                        echo "Productinformatie onbekend";
                    }
                    $conn3->close();


                    echo '<div class="shopping-cart-product">';
                    echo '<div class="divider">';
                    echo "<a href='product.php?id=$product_id'>";
                    echo "<div class='shopping-cart-img-container'>";
                    echo "<img src='$imgSrc' alt='$name' '></div>";
                    echo '</a>';
                    echo "<a style='text-decoration: none; color: inherit;' href='product.php?id=$product_id'>";
                    echo "<span class='productNaam'>" . $name . "</span><br>";
                    gemiddeldeScoreZonderTotaal("SELECT AVG(score) AS avgScore
FROM product_review WHERE product_id = " . $product_id, "SELECT COUNT(*) AS amountOfReviews
FROM product_review WHERE product_id = " . $product_id);
                    echo "</a>";
                    echo "<div class='aantalItemsEnKnoppen'>";
                    echo "<span class='aantalItems'>Aantal: " . $quantity . "</span>";
                    echo '</div>';
                    echo '</div>'; // divider


                    if ($quantity > 1) {
                        echo '<div class="divider"><br><span class="totaalPrijs">' . $quantity . ' x €' . $price . '</span><br></div>';
                    } else {
                        echo '<div class="divider"><br><span class="totaalPrijs">' . '€' . $price . '</span><br></div>';
                    }

                    echo '</div>'; // shopping-cart-product


                    $total += $quantity * $price;
                    $count += 1 * $quantity;
                }
                echo "<span>Artikelen <span class='artikelCount'>($count)</span>: ";
                echo "€<span id='totalAmount'>$total</span></span>";
                echo '<br>';
            } else {
                echo "Order is leeg";
            }
            $conn2->close();

            echo '</div>';
        }
    } else {
        echo "<p style='font-style: italic'>Geen bestellingen gevonden</p>";
//        header('Location: ' . "product-overzicht.php");
    }
    $conn->close();


    ?>

    <!--    Je zou de query hierboven kunnen aanpassen zodat je de informatie van bestellingen van een bepaalde gebruiker ophaalt-->
    <!--    Hierbij heb je waarschijnlijk een join nodig tussen order en order_item-->
    <!--    Of je haalt met meerdere joins informatie op uit alle drie (user, order & order_item) als je ook informatie over de gebruiker wil tonen-->
</div>


</body>
</html>