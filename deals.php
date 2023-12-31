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
    <title>Shopper's Stop: Deals</title>
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
            <h5 id = "added"></h5>
        </div>
        <div class="column2" style="background-color:aliceblue">
            <div>
                <h3>Deals</h3>
                <h4 style="font-size:12pt">
                    Click "Reedem Coupon" to apply coupon on shopping cart.
                </h4>

                <div class="rowCard">
                    <div class="columnCard">
                        <div class="card">
                            <img src="images/lays.jpeg" alt="Avatar" width="100%" height="180">
                            <div class="container">
                              <h4><b>Lay's Chips</b></h4> 
                              <p><strong>Buy 2 for $5.00</strong> <br><em>Save $1.00</em></p>
                              <button type="button" class="center">Redeem Coupon</button> 
                            </div>
                        </div>
                    </div>
                    <div class="columnCard">
                        <div class="card">
                            <img src="images/kitkat.png" alt="Avatar" width="100%" height="180">
                            <div class="container">
                              <h4><b>KitKat</b></h4> 
                              <p><strong>Buy 2 for $8.00</strong> <br><em>Save 98¢</em></p> 
                              <button type="button" class="center">Redeem Coupon</button> 
                            </div>
                        </div>
                    </div>
                    <div class="columnCard">
                        <div class="card">
                            <img src="images/freshproduce.jpeg" alt="Avatar" width="100%" height="180">
                            <div class="container">
                              <h4><b>15% Off <br>Fresh Produce</b></h4> 
                              <p style="font-size:12pt"><em>Excludes juices.</em></p>
                              <button type="button" class="center">Redeem Coupon</button> 
                            </div>
                        </div>
                    </div>
                    <div class="columnCard">
                        <div class="card">
                            <img src="images/gelato.png" alt="Avatar" width="100%" height="180">
                            <div class="container">
                              <h4><b>15% Off <br>Frozen</b></h4> 
                              <p style="font-size:12pt"><em>Excludes pizza.</em></p>
                              <button type="button" class="center">Redeem Coupon</button> 
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>

    <footer>
        <h4 id="date" style="padding-top: 20px"><script>formatDate();</script></h4>
        <h6>Anjali Massand AJM180009 & Aashritha Ananthula AXA180116</h6>
    </footer>

</body>

</html>