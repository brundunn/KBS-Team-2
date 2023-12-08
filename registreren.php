<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registreren</title>
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
        echo breadcrumb('#', 'Registreren', true)
        ?>
    </ul>
    <hr>

    <h1>Registreren</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet aspernatur atque esse molestiae praesentium, recusandae saepe ullam! A accusantium architecto aspernatur excepturi fugiat molestias obcaecati sequi similique voluptatem voluptatum?</p>

<!--
Voor de inlogfunctionaliteit heb ik https://codeshack.io/secure-login-system-php-mysql/ gebruikt.
Dit is op basis van wachtwoorden die hashed opgeslagen worden in de database. Als een wachtwoord 'normaal' wordt opgeslagen werkt het niet
'$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa' is bijvoorbeeld het wachtwoord 'test'

Op die site stond:
'Only passwords that were created with the password_hash function will work.'
Dit is dus belangrijk
Volgens mij is de syntax hiervan als volgt: password_hash('wachtwoord', PASSWORD_DEFAULT);
Weet ik alleen niet zeker

We moeten overigens allemaal in de database 'ALTER TABLE user MODIFY COLUMN password varchar(255);' gaan uitvoeren, zodat de hashed passwords in de database passsen

-->
</div>


</body>
</html>