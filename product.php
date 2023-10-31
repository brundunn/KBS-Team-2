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
        $description = $row["description"];
        $price = $row["price"];
        $category = $row["category"];
        $imgSrc = "img/product_images/" . $row["image"] . ".jpg";
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
    <title><?php echo $name ?></title>
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
        function breadcrumb($link, $naam, $huidigePagina): string
        {
            $naam = ucfirst($naam);

            if (!$huidigePagina) {
                return "<li><a href=\"$link\">$naam</a></li>";
            } else {
                return "<li>$naam</li>";
            }
        }

        echo breadcrumb('index.php', 'Home', false);
        echo breadcrumb('product-overzicht.php', 'Assortiment', false);
        echo breadcrumb('#', "$name", true);
        ?>
    </ul>
    <hr>
    <!-- Einde breadcrumbs -->
    <h2><?php echo $name ?></h2>
    <h3><?php echo "Prijs: €$price" ?></h3>
    <h4><?php echo "Categorie: $category" ?></h4>
    <p><?php echo $description ?></p>
    <img src="<?php echo $imgSrc ?>" alt="<?php echo $name ?>">



    <!-- Product review -->
    <h3>Reviews over <?php echo $name ?></h3>
    <?php

    include 'src/review-functions.php';
    gemiddeldeScore("SELECT AVG(score) AS avgScore
FROM product_review WHERE product_id = " . $id, "SELECT COUNT(*) AS amountOfReviews
FROM product_review WHERE product_id = " . $id);

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

            echo '<div class="review highlighted-review">';
            echo printStars($row["score"]) .
                "user: " . $row["first_name"];
            if (!empty($row["surname_prefix"])) { // check of persoon een tussenvoegsel heeft
                echo " " . $row["surname_prefix"];
            }
            echo " " . $row["surname"] . "<br>" .
                "datum: " . $row["date"];
            if (!empty($row["description"])) { // check of persoon een beschrijving heeft geplaatst bji de review
                echo "<br>" . $row["description"];
            }
            echo '</div>';
            echo "<br>";

        }
        if ($ingekort) {
            echo '<a href="product-reviews.php?id=' . $id . '">Bekijk alle reviews</a>';
        }
    } else {
        echo "Er zijn nog geen reviews voor dit product achtergelaten.";
    }
    $conn->close();
    ?>
</div>
</body>
</html>

