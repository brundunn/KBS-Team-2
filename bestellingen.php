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
</head>
<body>
<?php include 'header.php';
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
FROM `order` WHERE user_id = $user_id";
    // RESULT
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            // variabelen toewijzen voor het gemak
            $order_id = $row["id"];
            $date = $row["order_date"];
            $user_id = $row["user_id"];

            echo "<h1>Order #$order_id</h1>";

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


                    echo $name . " x " . $quantity . "<br>";
                }
            } else {
                echo "Order is leeg";
            }
            $conn2->close();

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