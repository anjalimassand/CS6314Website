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
    <script src="scripts/contactus.js"></script>
    <title>Shopper's Stop: Home</title>
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
            <h3>Click 'Shopping Cart' tab for cart details.</h3>
           
        </div>
        <div class="column2" style="background-color:aliceblue">
            <div>
                <h3>Welcome!</h3>
                <p>Online shopping made easier.</p>
                <img src="images/fall.jpeg" class="center">
                <div class="centered">Happy Fall!</div>
            </div>
            
        </div>
    </div>

    <footer>
        <h4 id="date" style="padding-top: 20px"><script>formatDate();</script></h4>
        <h6>Anjali Massand AJM180009</h6>
    </footer>

</body>

</html>