<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About Us</title>
    <link href="src/styles.css" rel="stylesheet">
</head>
<body>
<div class="top-navbar"> <!-- Volledige bar -->
    <nav> <!-- Inhoud v/d nav bar -->

        <div class="logo-and-hyperlinks">
            <!--Logo-->
            <img class="logo" src="img/Logo_KBS-removebg-preview.png" alt="logo">
            <!--            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"-->
            <!--                 stroke="currentColor" class="logo">-->
            <!--                <path stroke-linecap="round" stroke-linejoin="round"-->
            <!--                      d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>-->
            <!--            </svg>-->


            <!-- Links -->
            <div class="hyperlinks">
                <a href="#">Link 1</a>
                <a href="#">Link 2</a>
                <a href="#">Link 3</a>
                <a href="#">About us</a>
            </div>
        </div>

        <input type="text" class="main-searchbar" placeholder="Zoeken naar een product...">

        <div class="cart-and-user">
            <button class="account-button">Inloggen</button>
            <button class="account-button">Registreren</button>
            <button class="cart-button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="cart">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                </svg>
            </button>
        </div>


    </nav>
</div>
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

        //                echo breadcrumb('#', 'test', false);
                        echo breadcrumb('index.php', 'Home', false);
        echo breadcrumb('#', 'About us', true)
        ?>
    </ul>
    <hr>

    <h1>About us</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet aspernatur atque esse molestiae praesentium, recusandae saepe ullam! A accusantium architecto aspernatur excepturi fugiat molestias obcaecati sequi similique voluptatem voluptatum?</p>

    </div>


</body>
</html>