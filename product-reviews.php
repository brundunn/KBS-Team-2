<!-- DATABASE CONNECTIE -->
<?php

if (empty($_GET["id"])) {
    header('Location: ' . "product-overzicht.php");
}

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

$id = $_GET["id"];
// QUERY
$sql = "SELECT * 
FROM product
    WHERE id=$id";
// RESULT
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {

        $name = $row["name"];
    }
} else {
    echo "0 results";
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
    <title>Reviews: <?php echo $name ?></title>
    <script src="js/readmore.js"></script>
    <link href="src/styles.css" rel="stylesheet">
    <link href="src/header.css" rel="stylesheet">
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

        echo breadcrumb('index.php', 'Home', false);
        echo breadcrumb('product-overzicht.php', 'Assortiment', false);
        echo breadcrumb('product.php?id=' . $id, "$name", false);
        echo breadcrumb('#', 'Reviews', true);
        ?>
    </ul>
    <hr>
    <!-- Einde breadcrumbs -->

    <!-- Product reviews -->
    <h1>Reviews over <?php echo $name ?></h1>
    <?php
    echo '<a href="write-review.php?type=product&id=' . $id . '">Schrijf review</a>';

    include 'src/review-functions.php';
    reviewPagina("SELECT pr.product_id, u.first_name, u.surname_prefix, u.surname, pr.date, pr.score, pr.description
FROM product_review pr
JOIN user u ON pr.user_id = u.id
WHERE pr.product_id = " . $id, "NerdyGadgets", "SELECT AVG(score) AS avgScore
FROM product_review WHERE product_id = " . $id, "SELECT COUNT(*) AS amountOfReviews
FROM product_review WHERE product_id = " . $id); ?>
</div>
</body>
</html>

