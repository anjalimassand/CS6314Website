<?php
include 'config.php';
session_start();
if (isset($_SESSION['username'])) {
    echo "Hello, ", $_SESSION['username'];
}

?>

<!DOCTYPE html>
<html>

<head>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="scripts/contactus.js"></script>
    <title>Shopper's Stop: Shopping Cart</title>
    <header>
        <div class="top">
            <img src="images/groceries.jpeg">
            <h1>Shopper's Stop</h1>
        </div>

    </header>
</head>

<body>
    <link rel="stylesheet" href="mystyle.css">

    <div class="topnav">
        <a href="index.php">Home</a>
        <a href="freshproducts.php">Fresh Products</a>
        <a href="frozen.php">Frozen</a>
        <a href="pantry.php">Pantry</a>
        <a href="breakfastcereal.php">Breakfast & Cereal</a>
        <a href="baking.php">Baking</a>
        <a href="snacks.php">Snacks</a>
        <a href="candy.php">Candy</a>
        <a href="specialtyshops.php">Specialty Shops</a>
        <a href="deals.php">Deals</a>
        <a href="aboutus.php">About Us</a>
        <a href="contactus.php">Contact Us</a>
        <a href="myaccount.php">My Account</a>
        <a href="cart.php">Shopping Cart</a>
    </div>

    <div class="row">
        <div class="column" style="background-color:rgb(222, 221, 226)">
            <div style="margin-top:30pt; margin-left:15pt">
                <h4 style="text-align: left; padding-left: 10px;">Checkout Steps:</h4>
                <ol>
                    <li>Click 'Checkout'</li>
                    <li>Login</li>
                    <li>Enter card information and submit.</li>
                </ol>
            </div>
        </div>

        <div class="column2" style="background-color:aliceblue">
            <div>
                <h3>Shopping Cart</h3>
                <?php

                // Check if the user is not logged in
                if (!isset($_SESSION['username'])) {
                    // Redirect to the myaccount.php page
                    echo '<h5>Not signed in? <a href="myaccount.php">Login Now!</a></h5>';
                    //exit(); // Stop further execution of the script
                }
                ?>


                <table id="cartTable" style="width:100%">
                    <thead>
                        <tr>
                            <th style="text-align:left">Item</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>


                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <p></p>
                <?php
                include 'displayCart.php';
                ?>
                <p></p>
                <button type="button" class="clearButton">Clear Cart</button>
                <button type="button" class="checkoutButton">Checkout</button>

            </div>
        </div>
    </div>

    <footer>
        <h4 id="date" style="padding-top: 20px">
            <script>formatDate();</script>
        </h4>
        <h6>Anjali Massand AJM180009 & Aashritha Ananthula AXA180116</h6>
    </footer>
    <script src="scripts/inventoryItems.js"></script>
    <script src="scripts/cart.js"></script>

    <?php

    // Function to update XML file and return success status
    function updateXML($productName, $quantity, $xmlFilePath)
    {
        // Load XML file
        $xml = simplexml_load_file($xmlFilePath);

        // Find the product by name
        foreach ($xml->product as $product) {
            if ((string) $product->name === $productName) {
                // Update the quantity
                $product->quantity = $product->quantity - $quantity;

                $xml->asXML($xmlFilePath);

                return true;
            }
        }

        return false;
    }

    // Function to update JSON file and return success status
    function updateJSON($productName, $quantity, $jsonFilePath)
    {
        // Load JSON file
        $jsonFile = file_get_contents($jsonFilePath);
        $jsonArray = json_decode($jsonFile, true);

        // Find the product by name
        foreach ($jsonArray as &$product) {
            if ($product['name'] === $productName) {
                // Update the quantity
                $product['quantity'] = $product['quantity'] - $quantity;

                file_put_contents($jsonFilePath, json_encode($jsonArray, JSON_PRETTY_PRINT));

                return true;
            }
        }

        return false;
    }

    // Check if 'cartData' is set in the POST request
    if (isset($_POST['cartData'])) {
        $cartData = json_decode($_POST['cartData'], true);

        $xmlFilePaths = ['xml/candy.xml', 'xml/freshproduce.xml', 'xml/frozen.xml', 'xml/snacks.xml'];
        $jsonFilePaths = ['json/baking.json', 'json/breakfast.json', 'json/pantry.json'];

        // Update quantities in XML files
        foreach ($xmlFilePaths as $xmlFilePath) {
            foreach ($cartData as $cartItem) {
                $productName = $cartItem['name'];
                $quantity = $cartItem['quantity'];

                // Check if the file was updated
                if (updateXML($productName, $quantity, $xmlFilePath)) {
                    echo "XML file $xmlFilePath was updated successfully.\n";
                } else {
                    echo "Failed to update XML file $xmlFilePath.\n";
                }
            }
        }

        // Update quantities in JSON files
        foreach ($jsonFilePaths as $jsonFilePath) {
            foreach ($cartData as $cartItem) {
                $productName = $cartItem['name'];
                $quantity = $cartItem['quantity'];

                // Check if the file was updated
                if (updateJSON($productName, $quantity, $jsonFilePath)) {
                    echo "JSON file $jsonFilePath was updated successfully.\n";
                } else {
                    echo "Failed to update JSON file $jsonFilePath.\n";
                }
            }
        }
    } else {
        //     echo "Error: 'cartData' not present in the POST request.";
    }
    ?>



</body>

</html>