<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reviews</title>
    <link href="src/styles.css" rel="stylesheet">
    <link href="src/header.css" rel="stylesheet">
    <link href="src/reviews.css" rel="stylesheet">
</head>
<body>
<?php include 'header.php';
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
        echo breadcrumb('#', 'Reviews', true);
        ?>
    </ul>
    <hr>

    <h1>Reviews van gebruikers</h1>
    <form method="POST" class="sorteerKnoppen">
        <input type="submit" name="sorteren" value="mostRecent"><br>
        <input type="submit" name="sorteren" value="leastRecent"><br>
        <input type="submit" name="sorteren" value="mostStars"><br>
        <input type="submit" name="sorteren" value="leastStars"><br>
    </form>

    <?php
    include 'src/print-star-functions.php';
    ?>

    <br>

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

    $sortType = '';
    $orderBy = '';
    if (!empty($_POST["sorteren"])) {
        $sortType = $_POST["sorteren"];
        if ($sortType == 'mostRecent') {
            $orderBy = 'date DESC';
        } else if ($sortType == 'leastRecent') {
            $orderBy = 'date ASC';
        } else if ($sortType == 'mostStars') {
            $orderBy = 'score DESC';
        } else if ($sortType == 'leastStars') {
            $orderBy = 'score ASC';
        } else {
            $orderBy = 'date DESC'; // default
        }
    } else {
        $orderBy = 'date DESC'; // default
    }

    // QUERY
    $sql = "SELECT r.id, u.first_name, u.surname_prefix, u.surname, r.date, r.score, r.description
FROM review r
JOIN user u ON r.user_id = u.id
ORDER BY " . $orderBy . ";";
    // RESULT
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {

            echo '<div class="review">';
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
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
</div>
</body>
</html>