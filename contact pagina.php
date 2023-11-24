<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Contactinformatie</title>
    <link href="src/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="contact%20pagina.css">
    <link href="src/header.css" rel="stylesheet">
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
        echo breadcrumb('#', 'Contactpagina', true);
        ?>
    </ul>
    <hr>

    <div class="container">
        <h1>Contactinformatie</h1>

        <div class="contact-info">
            <h2>Adres</h2>
            <p>Hospitaaldreef 5</p>
            <p>1315 RC Almere</p>
            <p>Nederland</p>
        </div>

        <div class="contact-info">
            <h2>Contactgegevens</h2>
            <p>Email: info@example.com</p>
            <p>Telefoon: +31 123 456 789</p>
        </div>

        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1234.5678901234567!2d6.123456!3d52.123456!4m12!1m6!3m5!1s0x47c6e2039b7c7a7d%3A0x654321fedcba9876!2sSample%20Location!8m2!3d52.123456!4d6.123456!3m4!1s0x0:0x654321fedcba9876!8m2!3d52.123456!4d6.123456"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</div>

</body>
</html>
