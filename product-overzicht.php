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
        echo breadcrumb('#', 'Assortiment', true)
        ?>
    </ul>
    <hr>
    <!-- Einde breadcrumbs -->

    <h1>Productassortiment</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet aspernatur atque esse molestiae
        praesentium, recusandae saepe ullam! A accusantium architecto aspernatur excepturi fugiat molestias obcaecati
        sequi similique voluptatem voluptatum?</p>

    <!-- DATABASE CONNECTIE -->
    <?php
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


    // QUERY
    $sql = "SELECT * FROM product";
    // RESULT
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {

            echo "id: " . $row["id"] .
                " <br> name: " . $row["name"] .
                " <br> description: " . $row["description"] .
                " <br> price: " . $row["price"] .
                " <br> category: " . $row["category"] .
                " <br> <img src=\"img/product_images/" . $row["image"] . ".jpg\" alt=\"" . $row["name"] . "\">" .
                "<br><br>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>

</div>
</body>
</html>
