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
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1234.5678901234567!2d5.22263158753069!3d52.3704482!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNTLCsDUyJzQyLjIiTiA1LjIyMjE2MzEsNTcnMTQnMDcuMiJF!5e0!3m2!1sen!2sus!4v1638235405709!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>

</div>

</body>
</html>
