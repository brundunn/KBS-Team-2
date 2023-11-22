<?php

include 'src/print-star-functions.php';

function gemiddeldeScore($avgQuery, $countQuery) {
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

// GEMIDDELDE SCORE VAN REVIEWS
// QUERY
    $sql = $avgQuery;
// RESULT
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {

            $avgScore = round($row["avgScore"], 1);
        }
    } else {
        echo "0 results";
    }

// TOTAAL AANTAL REVIEWS
// QUERY
    $sql = $countQuery;
// RESULT
    echo '<div class="reviewStats">';

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {

            $amountOfReviews = $row["amountOfReviews"];
        }
    } else {
        echo "Geen resultaten";
    }
    $conn->close();


    echo "<div  class='avgScore'>$avgScore ";

    printStars($avgScore);

    echo "</div>($amountOfReviews reviews)";
   echo '</div>';
}

function gemiddeldeScoreZonderTotaal($avgQuery, $countQuery) {
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

// GEMIDDELDE SCORE VAN REVIEWS
// QUERY
    $sql = $avgQuery;
// RESULT
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {

            $avgScore = round($row["avgScore"], 1);
        }
    } else {
        echo "0 results";
    }

// TOTAAL AANTAL REVIEWS
// QUERY
    $sql = $countQuery;
// RESULT
    echo '<div class="reviewStats">';

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {

            $amountOfReviews = $row["amountOfReviews"];
        }
    } else {
        echo "Geen resultaten";
    }
    $conn->close();


    echo "<div class='avgScore'>$avgScore ";

    printStars($avgScore);

    echo "</div>";
    echo '</div>';
}



function reviewPagina($query, $subject, $avgQuery, $countQuery) {
    gemiddeldeScore($avgQuery, $countQuery);

    echo '<form method="POST" class="sorteerKnoppen">
        <input type="submit" name="sorteren" value="mostRecent"><br>
        <input type="submit" name="sorteren" value="leastRecent"><br>
        <input type="submit" name="sorteren" value="mostStars"><br>
        <input type="submit" name="sorteren" value="leastStars"><br>
    </form>';


    echo '<br>';

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
    $sql = $query . " ORDER BY $orderBy;";
    // RESULT
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $date = substr($row["date"], 0, -3);

            echo '<div class="review">';
            echo printStars($row["score"]) .
                "user: " . $row["first_name"];
            if (!empty($row["surname_prefix"])) { // check of persoon een tussenvoegsel heeft
                echo " " . $row["surname_prefix"];
            }
            echo " " . $row["surname"] . "<br>" .
                "datum: " . $date;
            if (!empty($row["description"])) { // check of persoon een beschrijving heeft geplaatst bji de review
                echo "<br>" . $row["description"];
            }
            echo '</div>';
            echo "<br>";

        }
    } else {
        echo "Er zijn nog geen reviews voor $subject achtergelaten.";
    }
    $conn->close();
}