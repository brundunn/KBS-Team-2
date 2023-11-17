<head>
    <link rel="stylesheet" href="src/shopping-cart.css">
</head>

<div class="topnav">
    <a class="active" href="index.php">Home</a>
    <a href="#news">News</a>
    <a href="#contact">Contact</a>
    <a href="about-us.php">About</a>
</div>

<h1>Producten Kiezen en Afrekenen</h1>

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

    <button type="button" onclick="processPayment()">Afrekenen</button>
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
</script>

<style>
    .topnav {
        background-color: purple;
        overflow: hidden;
    }

    .topnav a {
        float: left;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    .topnav a:hover {
        background-color: purple;
        color: black;
    }

    .topnav a.active {
        background-color: mediumpurple;
        color: white;
    }

    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    h1 {
        text-align: center;
        color: #333;
    }

    #checkoutForm {
        max-width: 600px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #333;
    }

    ul {
        list-style: none;
        padding: 0;
    }

    li {
        margin-bottom: 10px;
    }

    label {
        margin-left: 5px;
    }

    input[type="text"],
    input[type="email"],
    button {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        margin-bottom: 10px;
        box-sizing: border-box;
    }

    button {
        background-color: #4caf50;
        color: #fff;
        border: none;
        padding: 15px;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }

    p {
        text-align: right;
        font-weight: bold;
        font-size: 1.2em;
    }

    #totalAmount {
        color: #e44d26;
    }
</style>