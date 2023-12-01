<?php
// Check of de juiste parameters zijn meegegeven, stuur anders de gebruiker terug naar de homepage
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
            $imgSrc = "img/product_images/" . $row["image"] . ".jpg";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
}


// Check of een review is achtergelaten
if ((!empty($_GET["user_id"])) && (!empty($_GET["rating"]))) {
    $user_id = $_GET["user_id"];
    $rating = $_GET["rating"] / 2;

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
    if ($productReview) {
        // Product review
        if (!empty($_GET["beschrijving"])) {
            $description = $_GET["beschrijving"];
            $sql = "INSERT INTO product_review
                    VALUES ($id, $user_id, now(), $rating, '$description');";
        } else {
            $sql = "INSERT INTO product_review (product_id, user_id, date, score)
                    VALUES ($id, $user_id, now(), $rating);";
        }
        header('Location: ' . "product-reviews.php?id=$id");
    } else {
        // Geen product review
        if (!empty($_GET["beschrijving"])) {
            $description = $_GET["beschrijving"];
            $sql = "INSERT INTO review (user_id, date, score, description)
                    VALUES ($user_id, now(), $rating, '$description');";
        } else {
            $sql = "INSERT INTO review (user_id, date, score)
                    VALUES ($user_id, now(), $rating);";
        }
        header('Location: ' . "user-reviews.php");
    }
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
    <link href="src/reviews.css" rel="stylesheet">
    <link href="src/write-review.css" rel="stylesheet">
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
        if ($productReview) {
            echo breadcrumb('product-overzicht.php', 'Assortiment', false);
            echo breadcrumb('product.php?id=' . $id, "$name", false);
            echo breadcrumb('product-reviews.php?id=' . $id, 'Reviews', false);
        } else {
            echo breadcrumb('user-reviews.php', 'Reviews', false);
        }
        echo breadcrumb('#', 'Schrijf review', true);
        ?>
    </ul>
    <hr>

    <h1>Schrijf een review over <?php echo $productReview ? $name : 'NerdyGadgets'; ?></h1>
    <?php
    include 'src/review-functions.php';
    if ($productReview) {
        echo '<img class="review-product-img" src="' . $imgSrc . '" alt="' . $name . '"> <!-- afbeelding --><br>';
        gemiddeldeScoreZonderTotaal("SELECT AVG(score) AS avgScore
FROM product_review WHERE product_id = " . $id, "SELECT COUNT(*) AS amountOfReviews
FROM product_review WHERE product_id = " . $id);
    } else {
        gemiddeldeScoreZonderTotaal("SELECT AVG(score) AS avgScore
FROM review", "SELECT COUNT(*) AS amountOfReviews
FROM review");
        echo '<p>Het merk Nerdy Gadgets in Nederland is een buitengewone plek waar technologische innovatie en geek-cultuur samenkomen, en het nodigt iedereen uit om deel uit te maken van deze opwindende wereld van technologie en popcultuur.
Het is een toevluchtsoord voor techliefhebbers en popcultuurfanaten waar de nieuwste technologische snufjes en nerdy verzamelobjecten samenkomen voor een magische ervaring. </p>';
    }
    echo '<br>';
    ?>
    <!--    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet aspernatur atque esse molestiae-->
    <!--        praesentium, recusandae saepe ullam! A accusantium architecto aspernatur excepturi fugiat molestias obcaecati-->
    <!--        sequi similique voluptatem voluptatum?</p>-->

    <form method="GET" class="schrijf-review-form">
        <?php
        if ($productReview) {
            echo "<input type='hidden' name='type' value='product'>";
            echo "<input type='hidden' name='id' value='$id'";
        } else {
            echo '<input type="hidden" name="type" value="nerdygadgets">';
        }
        ?>

        <!-- ID is nodig voor het label-->
        <!--        <label for="voornaam">Voornaam</label><input type="text" id="voornaam" name="voornaam" required>-->
        <!--        <br>-->
        <!--        <label for="achternaam">Achternaam</label><input type="text" id="achternaam" name="achternaam">-->
        <input type="hidden" name="user_id" value="1">

        <span>Score</span>
        <fieldset class="rate">
            <input type="radio" id="rating10" name="rating" value="10"/><label for="rating10" title="5 sterren"></label>

            <input type="radio" id="rating9" name="rating" value="9"/><label class="half" for="rating9"
                                                                             title="4.5 sterren"></label>

            <input type="radio" id="rating8" name="rating" value="8"/><label for="rating8" title="4 sterren"></label>

            <input type="radio" id="rating7" name="rating" value="7"/><label class="half" for="rating7"
                                                                             title="3.5 sterren"></label>

            <input type="radio" id="rating6" name="rating" value="6"/><label for="rating6" title="3 sterren"></label>

            <input type="radio" id="rating5" name="rating" value="5"/><label class="half" for="rating5"
                                                                             title="2.5 sterren"></label>

            <input type="radio" id="rating4" name="rating" value="4"/><label for="rating4" title="2 sterren"></label>

            <input type="radio" id="rating3" name="rating" value="3"/><label class="half" for="rating3"
                                                                             title="1.5 ster"></label>

            <input type="radio" id="rating2" name="rating" value="2"/><label for="rating2" title="1 ster"></label>

            <input type="radio" id="rating1" name="rating" value="1"/><label class="half" for="rating1"
                                                                             title="0.5 sterren"></label>
            <!--     <input type="radio" id="rating0" name="rating" value="0" /><label for="rating0" title="No star"></label> -->
        </fieldset>
        <br>

        <label for="beschrijving">Beschrijving</label><textarea id="beschrijving" name="beschrijving"></textarea>
        <br>
        <input type="submit">
    </form>
</div>


</body>
</html>