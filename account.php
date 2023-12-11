<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account</title>
    <link href="src/styles.css" rel="stylesheet">
    <link href="src/header.css" rel="stylesheet">
</head>
<body>
<?php include 'header.php';
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
<div class="main-container">
    <!--    Breadcrumbs -->
    <ul class="breadcrumbs">
        <?php
        include 'src/breadcrumbs.php';

        echo breadcrumb('index.php', 'Home', false);
        echo breadcrumb('#', 'Account', true)
        ?>
    </ul>
    <hr>

    <h1>Mijn account</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet aspernatur atque esse molestiae praesentium, recusandae saepe ullam! A accusantium architecto aspernatur excepturi fugiat molestias obcaecati sequi similique voluptatem voluptatum?</p>
    <table>
        <tr>
            <td>Gebruikers-ID:</td>
            <td><?php echo $id?></td>
        </tr>
        <tr>
            <td>Naam:</td>
            <td><?php echo $first_name.' '; if (!empty($surname_prefix)) { echo $surname_prefix.' ';} echo $surname; ?></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><?php echo $email ?></td>
        </tr>
<!--        <tr>-->
<!--            <td>Password:</td>-->
<!--            <td>--><?php //echo $password?><!--</td>-->
<!--        </tr>-->
        <tr>
            <td>Adres:</td>
            <td><?php echo $streetname . ' ' . $apartment_nr?></td>
        </tr>
        <tr>
            <td>Postcode:</td>
            <td><?php echo $postal_code?></td>
        </tr>
        <tr>
            <td>Plaats:</td>
            <td><?php echo $city?></td>
        </tr>
    </table>
</div>


</body>
</html>
