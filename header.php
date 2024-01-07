<?php
session_start();
?>
<div class="top-navbar"> <!-- Volledige bar -->
    <nav> <!-- Inhoud v/d nav bar -->

        <div class="logo-and-hyperlinks">
            <!--Logo-->
            <a href="index.php">
                <!--            <img class="logo" src="img/Logo_KBS-removebg-preview.png" alt="logo">-->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="logo">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                </svg>
            </a>

            <!-- Links -->
            <div class="hyperlinks">
                <a href="product-overzicht.php">Assortiment</a>
                <!--                <a href="#">Link 2</a>-->
                <!--                <a href="#">Link 3</a>-->
                <a href="about-us.php">About us</a>
                <a href="contact%20pagina.php">Contact</a>
            </div>
        </div>

    <body>
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Zoeken naar een product...">
            <ul id="suggestionsList"></ul>
        </div>
    </body>

        <div class="cart-and-user">
            <?php
            if (!isset($_SESSION['loggedin'])) {
                echo '<a href="login.php" class="account-button">Inloggen</a>';
                echo '<a href="registreren.php" class="account-button">Registreren</a>';

            } else {
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
                $stmt = $conn->prepare('SELECT * FROM user WHERE id = ?');
// In this case we can use the account ID to get the account info.
                $stmt->bind_param('i', $_SESSION['id']);
                $stmt->execute();
                $stmt->bind_result($id, $email, $password, $first_name, $surname_prefix, $surname, $streetname, $apartment_nr, $postal_code, $city);
                $stmt->fetch();
                $stmt->close();
                echo '<button class="account-button" onclick="toggleUserDropdown()">Welkom, ' . $first_name . '!</button>';
                echo '<div class="user-dropdown-menu-container" id="dropdownMenu">';
                echo '<div class="user-dropdown-menu">';
                echo '<div class="user-info"><h4>';
                echo $first_name . ' ';
                if (!empty($surname_prefix)) {
                    echo $surname_prefix . ' ';
                }
                echo $surname;
                echo '</h4></div><hr>';
                echo '<a href="account.php" class="user-dropdown-link">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="">
  <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
</svg>
<p>Account</p>
<span>></span>
</a>';
                echo '<a href="bestellingen.php" class="user-dropdown-link">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
</svg>
<p>Bestellingen</p>
<span>></span>
</a>';
                echo '<a href="loguit.php" class="user-dropdown-link">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
</svg>
<p>Uitloggen</p>
<span>></span>
</a>';
                echo '</div></div>';
//                echo '<a href="account.php" class="account-button">Account</a>';
//                echo '<a href="loguit.php" class="account-button">Uitloggen</a>';
            }
            ?>


            <!--Hier die link naar een andere pagina voor die shopping kart -->
            <a href="cart-page.php" class="cart-button-link">
                <button class="cart-button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="cart">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                    </svg>
                </button>
                <?php
                // DATABASE CONNECTIE
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "nerdy_gadgets_start";
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname); // Connect direct met de database ipv alleen met SQL
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                if (isset($_COOKIE["shopping_cart"])) {
                    $count = 0;
                    $total = 0;
                    $cookie_data = stripslashes($_COOKIE["shopping_cart"]);
                    $cart_data = json_decode($cookie_data, true);

                    foreach ($cart_data as $keys => $values) {
                        $result = $conn->query("SELECT * from product WHERE ID = " . $values["product_id"]);
                        if ($result->num_rows > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $count += 1 * $values["quantity"];
                            }
                        }
                    }
                    if ($count >= 1) {
                        echo '<span class="cart-badge">' . $count . '</span>';
                    }
                }
                $conn->close();
                ?>
            </a>
        </div>
    </nav>
</div>

<script>
    let dropdownMenu = document.getElementById("dropdownMenu");
    function toggleUserDropdown() {
        dropdownMenu.classList.toggle("open-menu");
    }
</script>