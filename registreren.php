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
    <link href="src/registreren.css" rel="stylesheet">
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
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet aspernatur atque esse molestiae
        praesentium, recusandae saepe ullam! A accusantium architecto aspernatur excepturi fugiat molestias obcaecati
        sequi similique voluptatem voluptatum?</p>

    <form action="" method="post">
        <label for="firstname">Voornaam</label><input type="text" name="firstname" placeholder="Voornaam" id="firstname"
                                                      required><br>
        <label for="surname_prefix">Tussenvoegsel</label><input type="text" name="surname_prefix"
                                                                placeholder="Tussenvoegsel" id="surname_prefix"><br>
        <label for="lastname">Achternaam</label><input type="text" name="lastname" placeholder="Achternaam"
                                                       id="firstname" required><br>
        <label for="streetname">Straatnaam</label><input type="text" name="streetname" placeholder="Straatnaam"
                                                         id="streetname" required><br>
        <label for="apartmentnr">Huisnummer</label><input type="text" name="apartmentnr" placeholder="Huisnummer"
                                                          id="apartmentnr" required><br>
        <label for="postalcode">Postcode</label><input type="text" name="postalcode" placeholder="Postcode"
                                                       id="postalcode" required><br>
        <label for="city">Stad</label><input type="text" name="city" placeholder="Stad" id="city" required><br>
        <label for="email">
            Email
        </label>
        <input type="text" name="email" placeholder="Email" id="email" required><br>
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" id="password" required><br>
        <input type="submit" value="Submit" class="submitKnop" name="registratie">
    </form>

    <?php

    if (isset($_POST["registratie"])) {
        // DATABASE CONNECTIE
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "nerdy_gadgets_start";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // Now we check if the data from the login form was submitted, isset() will check if the data exists.
        if (!isset($_POST['email'], $_POST['password'], $_POST["firstname"], $_POST["lastname"], $_POST["streetname"], $_POST["apartmentnr"], $_POST["postalcode"], $_POST["city"])) {
            // Could not get the data that should have been sent.
            exit('Please fill all required fields!');
        }
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $streetname = $_POST["streetname"];
        $apartmentnr = $_POST["apartmentnr"];
        $postalcode = $_POST["postalcode"];
        $city = $_POST["city"];
        $email = $_POST["email"];
//        // Easter egg Thomas
//        // https://cybernews.com/best-password-managers/most-common-passwords/
//        $mostCommonPasswords = ['123456', '12346789', 'qwerty', 'password', '12345', 'qwerty123', '1q2w3e', '12345678', '111111', '1234567890'];
//        if (isset($_POST["password"]) && in_array($_POST["password"], $mostCommonPasswords)) {
//            header('Location: https://cybernews.com/best-password-managers/most-common-passwords/');
//        }
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        if (!empty($_POST["surname_prefix"])) {
            $surname_prefix = $_POST["surname_prefix"];
            $sql = "INSERT INTO `user` (`email`, `password`, `first_name`, `surname_prefix`, `surname`, `street_name`, `apartment_nr`, `postal_code`, `city`) VALUES ('$email', 
'$password', '$firstname', '$surname_prefix', '$lastname', '$streetname', '$apartmentnr', '$postalcode', '$city');";
        } else {
            $sql = "INSERT INTO `user` (`email`, `password`, `first_name`, `surname`, `street_name`, `apartment_nr`, `postal_code`, `city`) VALUES ('$email', 
'$password', '$firstname', '$lastname', '$streetname', '$apartmentnr', '$postalcode', '$city');";
        }
//        header('Location: ' . "login.php");
//        echo $sql;

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }

    ?>
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