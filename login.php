<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inloggen</title>
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
        echo breadcrumb('#', 'Inloggen', true)
        ?>
    </ul>
    <hr>

    <h1>Inloggen</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet aspernatur atque esse molestiae praesentium, recusandae saepe ullam! A accusantium architecto aspernatur excepturi fugiat molestias obcaecati sequi similique voluptatem voluptatum?</p>
    <form action="authenticate.php" method="post">
        <label for="email">
            <i class="fas fa-user"></i>
        </label>
        <input type="text" name="email" placeholder="Email" id="email" required>
        <label for="password">
            <i class="fas fa-lock"></i>
        </label>
        <input type="password" name="password" placeholder="Password" id="password" required>
        <input type="submit" value="Login">
    </form>

</div>


</body>
</html>