<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NerdyGadgets</title>
    <script src="js/readmore.js"></script>
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
        //                echo breadcrumb('#', 'test', false);
        echo breadcrumb('#', 'Home', true)
        ?>
    </ul>
    <hr>
    <div class="brand-introduction-container">
        <div class="empty">

        </div>
        <div class="hero">
            <img class="intro-logo" src="img/Logo_KBS-removebg-preview.png" alt="logo">
            <h2>Nerdy Gadgets: Toevluchtsoord voor techliefhebbers en popcultuurfanaten.<span id="dots">...</span><span
                        id="more">
Het merk Nerdy Gadgets in Nederland is een buitengewone plek waar technologische innovatie en geek-cultuur samenkomen, en het nodigt iedereen uit om deel uit te maken van deze opwindende wereld van technologie en popcultuur.
Het is een toevluchtsoord voor techliefhebbers en popcultuurfanaten waar de nieuwste technologische snufjes en nerdy verzamelobjecten samenkomen voor een magische ervaring. </span>
            </h2>

            <button onclick="readMore()" id="myBtn">Read more</button>
        </div>
        <div class="shopping-experience">
            <ul>
                <li>
                    <!--                    Recensies-->
                    <div>
                        <?php
                        function printFullStar(): void
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
    <h2 class="highlighted-products-header">Uitgelichte producten</h2>
    <div class="highlighted-products">

        <?php
        function highlightedProducts($productnaam, $omschrijving, $prijs): string
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
        echo highlightedProducts('jaaaaaaaaaaa', 'beschrijving', 2.50);
        echo highlightedProducts('jaaaaaaaaaaa', 'beschrijving', 2.50);
        echo highlightedProducts('jaaaaaaaaaaa', 'beschrijving', 2.50);
        ?>
    </div>

</div>
</body>
</html>