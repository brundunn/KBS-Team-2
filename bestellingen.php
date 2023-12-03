<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bestellingen</title>
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
        echo breadcrumb('#', 'Bestellingen', true)
        ?>
    </ul>
    <hr>

    <h1>Mijn bestellingen</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet aspernatur atque esse molestiae
        praesentium, recusandae saepe ullam! A accusantium architecto aspernatur excepturi fugiat molestias obcaecati
        sequi similique voluptatem voluptatum?</p>

    <?php
    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'])) {
        header('Location: index.php');
        exit;
    }
    // DATABASE CONNECTIE
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "nerdy_gadgets_start";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if (mysqli_connect_errno()) {
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    //$stmt = $conn->prepare('SELECT password, email FROM user WHERE id = ?');
    $stmt = $conn->prepare('SELECT * FROM user WHERE id = ?');
    // In this case we can use the account ID to get the account info.
    $stmt->bind_param('i', $_SESSION['id']);
    $stmt->execute();
    //$stmt->bind_result($password, $email);
    $stmt->bind_result($id, $email, $password, $first_name, $surname_prefix, $surname, $streetname, $apartment_nr, $postal_code, $city);
    $stmt->fetch();
    $stmt->close();
    ?>

    <!--    Je zou de query hierboven kunnen aanpassen zodat je de informatie van bestellingen van een bepaalde gebruiker ophaalt-->
    <!--    Hierbij heb je waarschijnlijk een join nodig tussen order en order_item-->
    <!--    Of je haalt met meerdere joins informatie op uit alle drie (user, order & order_item) als je ook informatie over de gebruiker wil tonen-->
</div>


</body>
</html>