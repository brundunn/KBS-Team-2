<?php
session_start();
// check of gebruiker ingelogd is en of de winkelwagen NIET leeg is
if ((!isset($_SESSION['loggedin'])) || (!isset($_COOKIE["shopping_cart"]))) {
    header('Location: cart-page.php');
    exit;
}

// haal de data van de shopping_cart uit de cookie
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

// DATABASE CONNECTIE
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nerdy_gadgets_start";

$user_id = $_SESSION["user_id"];


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Query
// ORDER AANMAKEN
$sql = "INSERT INTO `order` (order_date, user_id)
VALUES (NOW(), $user_id)";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();



foreach ($cart_data as $keys => $values) {
    $product_id = $values["product_id"];
    $quantity = $values["quantity"];
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
// Query
// ORDER AANMAKEN
    $sql = "INSERT INTO `order_item`
VALUES ((SELECT id FROM `order` WHERE user_id = $user_id AND order_date BETWEEN DATE_SUB(NOW(), INTERVAL 10 SECOND) AND NOW()) , $product_id, $quantity)";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

setcookie("shopping_cart", "", time() - 3600); // cookie resetten
header("location: bestellingen.php");