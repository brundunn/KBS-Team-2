<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About Us</title>
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

    <h1>About us</h1>
    <p>Nerdy Gadgets is een toevluchtsoord voor techliefhebbers en popcultuurfanaten. Het merk Nerdy Gadgets in Nederland is een buitengewone plek waar technologische innovatie en geek-cultuur samenkomen, en het nodigt iedereen uit om deel uit te maken van deze opwindende wereld van technologie en popcultuur. Het is een toevluchtsoord voor techliefhebbers en popcultuurfanaten waar de nieuwste technologische snufjes en nerdy verzamelobjecten samenkomen voor een magische ervaring.</p>

    </div>


</body>
</html>