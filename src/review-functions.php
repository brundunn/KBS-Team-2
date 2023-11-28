<?php

include 'src/print-star-functions.php';

function gemiddeldeScore($avgQuery, $countQuery)
{
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

    echo '<div class="reviewStats">';
    if ($amountOfReviews > 0) {
        echo "<div  class='avgScore'>$avgScore ";
        printStars($avgScore);
        echo "</div>($amountOfReviews reviews)";
    }
    echo '</div>';
}

function gemiddeldeScoreZonderTotaal($avgQuery, $countQuery)
{
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

    echo '<div class="reviewStats">';
    if ($amountOfReviews > 0) {
        echo "<div class='avgScore'>$avgScore ";
        printStars($avgScore);
        echo "</div>";
    }
    echo '</div>';
}


function reviewPagina($query, $subject, $avgQuery, $countQuery)
{
    gemiddeldeScore($avgQuery, $countQuery);
    ?><br>Sorteren op:
    <form method="POST" class="sorteerKnoppen">
<!--        <select>-->
<!--            <option name="sorteren" value="mostRecent"-->
<!--                --><?php
//                if (!empty($_POST["sorteren"])) {
//                    if ($_POST["sorteren"] == 'mostRecent') {
//                        echo 'checked="checked"';
//                    }
//                } ?>
<!--            >Meest recent-->
<!--            </option>-->
<!--            <option name="sorteren"-->
<!--                    value="leastRecent"-->
<!--                --><?php //if (!empty($_POST["sorteren"])) {
//                    if ($_POST["sorteren"] == 'leastRecent') {
//                        echo 'checked="checked"';
//                    }
//                } ?>
<!---->
<!--                >Minst recent-->
<!--            </option>-->
<!--        </select>-->



                <button type="submit" name="sorteren" value="mostRecent"
                    <?php
                    if (((!empty($_POST["sorteren"])) && ($_POST["sorteren"] == 'mostRecent')) || empty($_POST["sorteren"])) {
                        echo ' disabled';
                    } ?>>Meest recent</button>
                <br>
                <button type="submit" name="sorteren" value="leastRecent"
                    <?php
                    if ((!empty($_POST["sorteren"])) && ($_POST["sorteren"] == 'leastRecent')) {
                        echo ' disabled';
                    } ?>
                >Minst recent</button>
                <br>
                <button type="submit" name="sorteren" value="mostStars"
                    <?php
                    if ((!empty($_POST["sorteren"])) && ($_POST["sorteren"] == 'mostStars')) {
                        echo ' disabled';
                    } ?>
                >Hoogste score</button>
                <br>
                <button type="submit" name="sorteren" value="leastStars"
                    <?php
                    if ((!empty($_POST["sorteren"])) && ($_POST["sorteren"] == 'leastStars')) {
                        echo ' disabled';
                    } ?>
                >Laagste score</button>
    </form>
    <br>

    <?php
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
                "<h3>" . $row["first_name"];
            if (!empty($row["surname_prefix"])) { // check of persoon een tussenvoegsel heeft
                echo " " . $row["surname_prefix"];
            }
            echo " " . $row["surname"] . "</h3>" .
                "<h4>" . $date . '</h4>';
            if (!empty($row["description"])) { // check of persoon een beschrijving heeft geplaatst bji de review
                echo "<p>" . $row["description"] . '</p>';
            }
            echo '</div>';
            echo "<br>";

        }
    } else {
        echo "Er zijn nog geen reviews voor $subject achtergelaten.";
    }
    $conn->close();
}