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
        $imgSrc = "img/product_images/" . $row["image"]  . ".jpg";

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
    <h4><?php echo "Categorie: $category"?></h4>
    <p><?php echo $description ?></p>
    <img src="<?php echo $imgSrc ?>" alt="<?php echo $name?>">


</div>

<div class="product-list">
    <h2>Misschien bent u ook geïntereseerd in::</h2>
    <?php foreach ($sameCategoryProducts as $product) { ?>
        <div class="product-item">
            <a href="product.php?id=<?php echo $product['id']; ?>">
                <img src="img/product_images/<?php echo $product['image']; ?>.jpg" alt="<?php echo $product['name']; ?>">
                <h5><?php echo $product['name']; ?></h5>
            </a>
        </div>
    <?php } ?>
</div>

</body>
</html>

