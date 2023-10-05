<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NerdyGadgets</title>
    <link href="src/styles.css" rel="stylesheet">
</head>
<body>
<div class="top-navbar"> <!-- Volledige bar -->
    <nav> <!-- Inhoud v/d nav bar -->

        <div class="logo-and-hyperlinks">
            <!--Logo-->
            <img class="logo" src="img/Logo%20KBS.png">
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
                <a href="#">Link 4</a>
            </div>
        </div>

        <input type="text" class="main-searchbar" placeholder="Zoeken naar een product...">

        <div class="cart-and-user">
            <button>Inloggen</button>
            <button>Registreren</button>
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
        function breadcrumb($link, $naam, $huidigePagina)
        {
            $naam = ucfirst($naam);

            if (!$huidigePagina) {
                return "<li><a href=\"$link\">$naam</a></li>";
            } else {
                return "<li>$naam</li>";
            }
        }

//                echo breadcrumb('#', 'test', false);
//                echo breadcrumb('#', 'test', false);
        echo breadcrumb('#', 'Home', true)
        ?>
    </ul>
    <hr>
    <div class="brand-introduction-container">
        <div class="highlighted-products">
            <h2>Uitgelichte producten</h2>
            <?php
            function highlightedProducts($productnaam, $omschrijving, $prijs)
            {
                $productnaam = ucfirst($productnaam);
                $omschrijving = ucfirst($omschrijving);
                if (!is_numeric($prijs)) {
                    $prijs = "?";
                }
                return "<div class=\"highlighted-product\">
                            <h3>$productnaam</h3>
                            <p>$omschrijving</p>
                            <div class=\"price-and-product-link\">
                                <p class=\"prijs\">€ $prijs</p>
                                <a href=\"\">
                                    <svg xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" stroke-width=\"1.5\" stroke=\"currentColor\"> 
                                        <path stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25\"/> 
                                    </svg> 
                                </a>
                            </div> 
                        </div>";
            }

            echo highlightedProducts('product 1', 'omschrijving 1', 5);
            echo highlightedProducts('nog een product', 'weer een omschrijving', 100);
            echo highlightedProducts('jaaaaaaa', 'beschrijving', 2.50);
            ?>


        </div>
        <div class="hero">
            <H1>Wie zijn wij</H1>
            <h2>Het merk Nerdy Gadgets staat synoniem voor een buitengewone wereld van technologische innovatie en
                geek-cultuurbeleving. Gelegen in het hart van Nederland, fungeert deze unieke winkel als een heiligdom
                voor techliefhebbers en popcultuurfanaten. Het is een plek waar de grenzen tussen realiteit en fictie
                vervagen, en waar de nieuwste technologische snufjes en zeldzame verzamelobjecten samenkomen om een
                magische ervaring te creëren. Nerdy Gadgets omarmt de erfenis van nerd zijn met trots, en nodigt
                iedereen uit om deel uit te maken van deze opwindende wereld van vintage arcade-machines, hypermoderne
                virtual reality-headsets en een schat aan nerdy hebbedingetjes. Het merk Nerdy Gadgets is niet zomaar
                een winkel; het is een toevluchtsoord voor degenen die hun passie voor technologie en popcultuur willen
                vieren en delen.</h2>
        </div>
        <div class="shopping-experience">
            <ul>
                <li>
                    <!--                    Recensies-->
                    <div>
                        <?php
                        function printFullStar()
                        {
                            echo "<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"currentColor\" class=\"ster\">
                            <path fill-rule=\"evenodd\"
                                  d=\"M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z\"
                                  clip-rule=\"evenodd\"/>
                        </svg>";
                        }

                        printFullStar();
                        printFullStar();
                        printFullStar();
                        printFullStar();
                        printFullStar();
                        ?>
                    </div>
                    (500)

                </li>
                <li>Eenvoudige navigatie</li>
                <li>Veilige betalingsmogelijkheden</li>
                <li>Snelle levering</li>
            </ul>
        </div>
    </div>


</div>
</body>
</html>