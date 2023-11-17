<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Winkelwagen</title>
    <link href="src/styles.css" rel="stylesheet">
    <link href="src/header.css" rel="stylesheet">
    <link rel="stylesheet" href="src/shopping-cart.css">
</head>
<body>
<?php include 'header.php' ?>
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
        echo breadcrumb('product-overzicht.php', 'Assortiment', false);
        echo breadcrumb('#', 'Winkelwagen', true);
        ?>
    </ul>
    <hr>
<h1 class="cartPageHeader">Producten Kiezen en Afrekenen</h1>

<form id="checkoutForm">
    <h2>Beschikbare producten</h2>
    <ul id="availableProducts">
        <li>
            <input type="checkbox" id="product1" value="Product 1" data-price="10.00">
            <label for="product1">Test 1 - €10.00</label>
        </li>
        <li>
            <input type="checkbox" id="product2" value="Product 2" data-price="20.00">
            <label for="product2">Test 2 - €20.00</label>
        </li>
        <li>
            <input type="checkbox" id="product3" value="Product 3" data-price="15.00">
            <label for="product3">Test 3 - €15.00</label>
        </li>
        <li>
            <input type="checkbox" id="product4" value="Product 4" data-price="10.00">
            <label for="product4">Test 4 - €10.00</label>
        </li>
        <li>
            <input type="checkbox" id="product5" value="Product 5" data-price="15.00">
            <label for="product5">Test 5 - €15.00</label>
        </li>
    </ul>

    <p>Totaalbedrag: €<span id="totalAmount">0.00</span></p>

    <h2>Klantgegevens</h2>
    <label for="name">Naam:</label>
    <input type="text" id="name" required>

    <label for="email">E-mail:</label>
    <input type="email" id="email" required>

    <button class="cartPageCheckoutButton" type="button" onclick="processPayment()">Afrekenen</button>
</form>

<script>
    const availableProducts = document.getElementById('availableProducts');
    const totalAmountSpan = document.getElementById('totalAmount');
    const checkoutForm = document.getElementById('checkoutForm');

    let totalAmount = 0;

    function updateTotalAmount() {
        totalAmount = 0;

        Array.from(availableProducts.querySelectorAll('input[type="checkbox"]:checked')).forEach(checkbox => {
            totalAmount += parseFloat(checkbox.getAttribute('data-price'));
        });

        totalAmountSpan.textContent = totalAmount.toFixed(2);
    }

    Array.from(availableProducts.querySelectorAll('input[type="checkbox"]')).forEach(checkbox => {
        checkbox.addEventListener('change', updateTotalAmount);
    });

    function processPayment() {
        const selectedProducts = Array.from(availableProducts.querySelectorAll('input[type="checkbox"]:checked')).map(checkbox => checkbox.value);

        if (selectedProducts.length === 0) {
            alert('Selecteer minstens één product om af te rekenen.');
            return;
        }

        alert(`Betaling voor ${selectedProducts.join(', ')} ter waarde van €${totalAmount.toFixed(2)} succesvol verwerkt!`);

        window.location.href = 'betaal.php';
    }
</script></div>
</body>
</html>