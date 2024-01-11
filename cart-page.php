<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Winkelwagen</title>
    <link href="src/styles.css" rel="stylesheet">
    <link href="src/header.css" rel="stylesheet">
    <link rel="stylesheet" href="src/shopping-cart.css">
    <link href="src/reviews.css" rel="stylesheet">
</head>
<body>
<?php include 'header.php' ?>
<div class="main-container">
    <!--    Breadcrumbs -->
    <ul class="breadcrumbs">
        <?php
        include 'src/breadcrumbs.php';

        echo breadcrumb('index.php', 'Home', false);
        echo breadcrumb('#', 'Winkelwagen', true);
        ?>
    </ul>
    <hr>
    <!--<h1 class="cartPageHeader">Producten Kiezen en Afrekenen</h1>-->
    <h1 class="cartPageHeader">Winkelwagen</h1>

    <?php
    // DATABASE CONNECTIE
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "nerdy_gadgets_start";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check of winkelwagen helemaal leeg is, zorg dan dat de cookie gereset wordt
    if (isset($_COOKIE["shopping_cart"])) {
        $cookie_data = stripslashes($_COOKIE["shopping_cart"]);
        $cart_data = json_decode($cookie_data, true);

        $item_id_list = array_column($cart_data, 'product_id');

        if (empty($item_id_list)) {
            setcookie("shopping_cart", "", time() - 3600);
            $_SESSION['status'] = "clear";
            header("location: cart-page.php");
        }
    }

    // check of er een product toegevoegd wordt aan de winkelwagen
    if (isset($_POST["add_to_cart"])) {

        // check of de cookie voor de winkelwagen al aanwezig is
        if (isset($_COOKIE["shopping_cart"])) {
            $cookie_data = stripslashes($_COOKIE["shopping_cart"]);
            $cart_data = json_decode($cookie_data, true); // als de cookie aanwezig is, gebruik de data ervan voor cart_data
        } else {
            $cart_data = array(); // als de cookie niet aanwezig is, maak dan zelf een array met cart_aata
        }

        $item_id_list = array_column($cart_data, 'product_id'); // maak een array met alleen de IDs van de producten in de winkelwagen


        if (in_array($_POST["product_id"], $item_id_list)) { // als het product al in de winkelwagen zit
            foreach ($cart_data as $keys => $values) {
                if ($cart_data[$keys]["product_id"] == $_POST["product_id"]) { // check of het ID al voorkomt

                    if ($_POST["quantity"] < 0) { // als de quantity kleiner is dan 0 (oftewel, als de hoeveelheid van een product verminderd wordt

                        if ($cart_data[$keys]["quantity"] == 1) { // als er nog maar 1 van het product in de winkelwagen zit, verwijder het dan
                            unset($cart_data[$keys]);
                            $item_data = json_encode($cart_data);
                            setcookie('shopping_cart', $item_data, time() + (86400 * 30));
                            header("location: cart-page.php");

                        } else { // als er meer dan 1 van het product in de winkelwagen zit, verminder dan de hoeveelheid met het juiste aantal
                            $cart_data[$keys]["quantity"] = $cart_data[$keys]["quantity"] + $_POST["quantity"];
                        }

                    } else { // als de quantity groter dan of gelijk is aan 0, dus als er een product wordt toegevoegd aan de winkelwagen
                        $cart_data[$keys]["quantity"] = $cart_data[$keys]["quantity"] + $_POST["quantity"];
                    }
                }
            }
        } else { // als het product nog niet in de winkelwagen zit, voeg deze dan toe aan de winkelwagen
            $item_array = array(
                'product_id' => $_POST["product_id"],
                'quantity' => $_POST["quantity"],
            );
            $cart_data[] = $item_array;
        }

        // cookie instellen met inhoud van winkelwagen
        $item_data = json_encode($cart_data);
        setcookie('shopping_cart', $item_data, time() + (86400 * 30)); // cookie gaat weg na 1 dag
        header("location: cart-page.php");
    }

    if (isset($_GET["action"])) {
        // product wordt verwijderd of winkelwagen wordt geheel leeggemaakt

        if ($_GET["action"] == "delete") { // product verwijderen
            $cookie_data = stripslashes($_COOKIE['shopping_cart']);
            $cart_data = json_decode($cookie_data, true);

            foreach ($cart_data as $keys => $values) {
                if ($cart_data[$keys]['product_id'] == $_GET['product_id']) {
                    unset($cart_data[$keys]);
                    $item_data = json_encode($cart_data);
                    setcookie('shopping_cart', $item_data, time() + (86400 * 30)); // cookie de nieuwe data meegeven
                    header("location: cart-page.php");
                }
            }
        }

        if ($_GET["action"] == "clear") { // winkelwagen leegmaken
            setcookie("shopping_cart", "", time() - 3600); // cookie resetten
            header("location: cart-page.php");
        }
    }
    ?>

    <div id="checkoutForm">
        <?php
        include 'src/review-functions.php';

        if (isset($_COOKIE["shopping_cart"])) {
            $total = 0;
            $count = 0;
            $productID = 0;
            $cookie_data = stripslashes($_COOKIE["shopping_cart"]);
            $cart_data = json_decode($cookie_data, true);

            foreach ($cart_data as $keys => $values) {
//                echo "Product " . $values["product_id"] . " --- ";
//                echo $values["quantity"] . "x --- ";
                $result = $conn->query("SELECT * from product WHERE ID = " . $values["product_id"]);
                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $price = $row['price'];
                        $productID = $row["id"];
                        $imgSrc = "img/product_images/" . $row["image"] . ".jpg";
                        $name = $row["name"];


                        echo '<div class="shopping-cart-product">';

//                        echo '<div class="divider">';
//
//                        echo '</div>';

                        echo '<div class="divider">';

                        //                        echo "Product " . $values["product_id"] . " --- ";
                        echo "<a href='product.php?id=$productID'>";
                        echo "<div class='shopping-cart-img-container'>";
                        echo "<img src='$imgSrc' alt='$name' '></div>";
                        echo "</a>";
                        echo "<a style='text-decoration: none; color: inherit;' href='product.php?id=$productID'>";
                        echo "<span class='productNaam'>" . $name . "</span><br>";
                        gemiddeldeScoreZonderTotaal("SELECT AVG(score) AS avgScore
FROM product_review WHERE product_id = " . $productID, "SELECT COUNT(*) AS amountOfReviews
FROM product_review WHERE product_id = " . $productID);
                        echo "</a>";

                        echo '<div class="aantalItemsEnKnoppen">';
                        echo "<span class='aantalItems'>Aantal: " . $values["quantity"] . "</span>";
//                        echo $price . " euro per product";



                        $total += $values["quantity"] * $price;
                        $count += 1 * $values["quantity"];

                // Button om de hoeveelheid van het product te vergroten
                echo '<form method="POST" style="display: inline">';
                echo '<input type="hidden" name="quantity" value="1">';
                echo '<input type="hidden" name="product_id" value="' . $productID . '">';
                echo ' <button class="cart-page-a" type="submit" name="add_to_cart">';
                echo '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cart-page-svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>';
                echo '</button>';
                echo '</form>';

                // Button om de hoeveelheid van het product te verminderen
                echo '<form method="POST" style="display: inline">';
                echo '<input type="hidden" name="quantity" value="-1">';
                echo '<input type="hidden" name="product_id" value="' . $productID . '">';
                echo ' <button class="cart-page-a" type="submit" name="add_to_cart">';
                echo '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cart-page-svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
        </svg>
        ';
                echo '</button>';
                echo '</form>';

                // Button om het product te verwijderen uit de winkelwagen
                echo ' <a class="cart-page-a" href="cart-page.php?action=delete&product_id=' . $values["product_id"] . '">';
                echo '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cart-page-svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
        </svg>
        ';
                echo '</a>';

                echo '</div>';
                echo '</div>';

                echo '<div class="divider"><br><span class="totaalPrijs">€' . $values["quantity"] * $price . '</span><br></div>';

                echo '</div>';
//                echo '<hr class="shopping-cart-hr">';

            }     }
            }
//            echo "<p>Totaal aantal producten: $count</p>";
//            echo "<p>Totaal bedrag: €<span id='totalAmount'>$total</span></p>";
            echo "<p>Artikelen <span class='artikelCount'>($count)</span>: ";
            echo "€<span id='totalAmount'>$total</span></p>";
            echo '<br>';

//            echo '<a href="cart-page.php?action=clear">Winkelwagen leegmaken</a><br>';

        } else {
            echo 'Uw winkelwagen is leeg! Bekijk ons <a href="product-overzicht.php">assortiment</a>.';
        }

        $conn->close();
        ?>
<!--        <br><br>-->
<!--        <h2>Klantgegevens</h2>-->
<!--        <label for="name">Naam:</label>-->
<!--        <input type="text" id="name" required>-->
<!---->
<!--        <label for="email">E-mail:</label>-->
<!--        <input type="email" id="email" required>-->
<!---->
<!--        <button class="cartPageCheckoutButton" type="button" onclick="processPayment()">Afrekenen</button>-->
    </div>


    <!--<form id="checkoutForm">-->
    <!--    <h2>Winkelwagen</h2>-->
    <!--    <ul id="availableProducts">-->
    <!--        <li>-->
    <!--            <input type="checkbox" id="product1" value="Product 1" data-price="10.00">-->
    <!--            <label for="product1">Test 1 - €10.00</label>-->
    <!--        </li>-->
    <!--        <li>-->
    <!--            <input type="checkbox" id="product2" value="Product 2" data-price="20.00">-->
    <!--            <label for="product2">Test 2 - €20.00</label>-->
    <!--        </li>-->
    <!--        <li>-->
    <!--            <input type="checkbox" id="product3" value="Product 3" data-price="15.00">-->
    <!--            <label for="product3">Test 3 - €15.00</label>-->
    <!--        </li>-->
    <!--        <li>-->
    <!--            <input type="checkbox" id="product4" value="Product 4" data-price="10.00">-->
    <!--            <label for="product4">Test 4 - €10.00</label>-->
    <!--        </li>-->
    <!--        <li>-->
    <!--            <input type="checkbox" id="product5" value="Product 5" data-price="15.00">-->
    <!--            <label for="product5">Test 5 - €15.00</label>-->
    <!--        </li>-->
    <!--    </ul>-->
    <!---->
    <!--    <p>Totaalbedrag: €<span id="totalAmount">0.00</span></p>-->
    <!---->
    <!--    <h2>Klantgegevens</h2>-->
    <!--    <label for="name">Naam:</label>-->
    <!--    <input type="text" id="name" required>-->
    <!---->
    <!--    <label for="email">E-mail:</label>-->
    <!--    <input type="email" id="email" required>-->
    <!---->
    <!--    <button class="cartPageCheckoutButton" type="button" onclick="processPayment()">Afrekenen</button>-->
    <!--</form>-->
    <!---->
    <!--<script>-->
    <!--    const availableProducts = document.getElementById('availableProducts');-->
    <!--    const totalAmountSpan = document.getElementById('totalAmount');-->
    <!--    const checkoutForm = document.getElementById('checkoutForm');-->
    <!---->
    <!--    let totalAmount = 0;-->
    <!---->
    <!--    function updateTotalAmount() {-->
    <!--        totalAmount = 0;-->
    <!---->
    <!--        Array.from(availableProducts.querySelectorAll('input[type="checkbox"]:checked')).forEach(checkbox => {-->
    <!--            totalAmount += parseFloat(checkbox.getAttribute('data-price'));-->
    <!--        });-->
    <!---->
    <!--        totalAmountSpan.textContent = totalAmount.toFixed(2);-->
    <!--    }-->
    <!---->
    <!--    Array.from(availableProducts.querySelectorAll('input[type="checkbox"]')).forEach(checkbox => {-->
    <!--        checkbox.addEventListener('change', updateTotalAmount);-->
    <!--    });-->
    <!---->
    <!--    function processPayment() {-->
    <!--        const selectedProducts = Array.from(availableProducts.querySelectorAll('input[type="checkbox"]:checked')).map(checkbox => checkbox.value);-->
    <!---->
    <!--        if (selectedProducts.length === 0) {-->
    <!--            alert('Selecteer minstens één product om af te rekenen.');-->
    <!--            return;-->
    <!--        }-->
    <!---->
    <!--        alert(`Betaling voor ${selectedProducts.join(', ')} ter waarde van €${totalAmount.toFixed(2)} succesvol verwerkt!`);-->
    <!---->
    <!--        // window.location.href = 'betaal.php';-->
    <!--    }-->
    <!--</script>-->
</div>
</body>
</html>