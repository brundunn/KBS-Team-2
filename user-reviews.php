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
        include 'src/breadcrumbs.php';

        echo breadcrumb('index.php', 'Home', false);
        echo breadcrumb('#', 'Reviews', true);
        ?>
    </ul>
    <hr>

    <h1>Reviews over NerdyGadgets</h1>

    <?php
    echo '<a href="write-review.php?type=nerdygadgets">Schrijf review</a>';

    include 'src/review-functions.php';
    reviewPagina("SELECT r.id, u.first_name, u.surname_prefix, u.surname, r.date, r.score, r.description
FROM review r
JOIN user u ON r.user_id = u.id", "NerdyGadgets", "SELECT AVG(score) AS avgScore
FROM review", "SELECT COUNT(*) AS amountOfReviews
FROM review", TRUE); ?>

</div>
</body>
</html>