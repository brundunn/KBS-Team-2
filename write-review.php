<?php
if ((empty($_GET["type"])) || ($_GET["type"] == "product" && empty($_GET["id"])) || ($_GET["type"] != "nerdygadgets" && $_GET["type"] != "product")) {
    header('Location: ' . "index.php");
}
$type = $_GET["type"];
$productReview = false;
$id = '';

if ($type == "product") {
    $productReview = true;

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
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Review achterlaten</title>
    <link href="src/styles.css" rel="stylesheet">
    <link href="src/header.css" rel="stylesheet">
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
        echo breadcrumb('#', 'About us', true)
        ?>
    </ul>
    <hr>

    <h1>Schrijf een review over <?php echo $productReview ? $name : 'NerdyGadgets'; ?></h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet aspernatur atque esse molestiae
        praesentium, recusandae saepe ullam! A accusantium architecto aspernatur excepturi fugiat molestias obcaecati
        sequi similique voluptatem voluptatum?</p>

</div>


</body>
</html>