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
    <title>Shopper's Stop: Contact Us</title>
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
                <h3>Contact Us</h3>
                    <form name="commentForm" class="login">
                        <div class="containerLogin">
                            <dl class="list">
                                <dt><label>First Name:</label></dt>
                                <dd><input type="text" name="first" id="first" style="padding: 4pt" required/></dd>
                                <dt><label>Last Name: </label></dt>
                                <dd><input type="text" name="last" id="last" style="padding: 4pt" required/></dd>
                                <dt><label>Phone Number: </label></dt>
                                <dd><input type="text" name="number" placeholder="(012) 345-6789" id="number" style="padding: 4pt" required/></dd>
                                <dt><label>Email Address: </label></dt>
                                <dd><input type="text" name="email" id="email" style="padding: 4pt" required/></dd>
                                <dt><label>Gender: </label></dt>
                                <dd><input type="radio" name="gender" value="male" id="male"> Male</dd>
                                <dd><input type="radio" name="gender" value="female" id="female"> Female</dd>
                                <dt><label>Comment: </label></dt>
                                <dd><input type="text" name="comment" id="comment" style="padding: 4pt" required/></dd>
                                <dd><input type="button" value="Submit" style="margin-left: 320px;" id="commentButton" onclick="validateForm()"></button></dd>
                            </dl>
                        </div>
                        <div style="color: red;">
                            <h6 id="firstMessage"></h6>
                            <h6 id="lastMessage"></h6>
                            <h6 id="diffMessage"></h6>
                            <h6 id="phoneMessage"></h6>
                            <h6 id="emailMessage"></h6>
                            <h6 id="genderMessage"></h6>
                            <h6 id="commentMessage"></h6>
                        </div>
                    </form>
                    
            </div>      
        </div>
    </div>

    <footer>
        <h4 id="date" style="padding-top: 20px"><script>formatDate();</script></h4>
        <h6>Anjali Massand AJM180009 & Aashritha Ananthula AXA180116</h6>
    </footer>

</body>

</html>