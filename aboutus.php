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
    <title>About Us</title>
    <header>
        <title>Shopper's Stop: About Us</title>
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
                <h3>About Us</h3>

                <div class="rowCard">
                    <div class="columnCard">
                        <div class="card">
                            <div class="container">
                                <h4><b>Austin, TX</b></h4> 
                                <p><strong>3853 Alpha Street, Austin, TX 73301</strong></p> 
                                <h5>Hours: 8 am - 9 pm</h5>
                            </div>
                        </div>
                    </div>
                    <div class="columnCard">
                        <div class="card">
                            <div class="container">
                                <h4><b>Celina, TX</b></h4> 
                                <p><strong>6493 Star Lane, Celina, TX 75009</strong></p> 
                                <h5>Hours: 8 am - 9 pm</h5>
                            </div>
                        </div>
                    </div>
                    <div class="columnCard">
                        <div class="card">
                            <div class="container">
                              <h4><b>Dallas, TX</b></h4> 
                              <p><strong>5454 Belt Line Rd, Dallas, TX 75001</strong></p>
                              <h5>Hours: 8 am - 9 pm</h5>
                            </div>
                        </div>
                    </div>
                    <div class="columnCard">
                        <div class="card">
                            <div class="container">
                                <h4><b>Houston, TX</b></h4> 
                                <p><strong>989 Knox Street, Houston, TX 77001</strong></p> 
                                <h5>Hours: 8 am - 9 pm</h5>
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