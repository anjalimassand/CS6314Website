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
    <title>Shopper's Stop: Specialty Shops</title>
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
                <h3>Specialty Shops</h3>
                <button class="specialOfferButton" id="specialOfferButton">Click to answer special offer questionnaire! </button>
                <div id="questionContainer" style="display: none; text-align: center">
                    <h4>Question 1: Are you a student?</h4>
                    <p><br></p>
                    <label><input type="radio" name="student" value="yes"> Yes</label>
                    <label><input type="radio" name="student" value="no"> No</label>
                    <button id="nextButton">Next</button>
                    <button id="skipButton">Skip</button>
                </div>
                <div id="questionContainer" style="display: none;">
                    <h4>Question 2: Are you a low income person?</h4>
                    <p><br></p>
                    <label><input type="radio" name="student" value="yes"> Yes</label>
                    <label><input type="radio" name="student" value="no"> No</label>
                    <button id="nextButton">Next</button>
                    <button id="skipButton">Skip</button>
                </div>
                <div id="questionContainer" style="display: none;">
                    <h4>Question 3: Are you a member of Shopper's Stop?</h4>
                    <p><br></p>
                    <label><input type="radio" name="student" value="yes"> Yes</label>
                    <label><input type="radio" name="student" value="no"> No</label>
                    <button id="nextButton">Next</button>
                    <button id="skipButton">Skip</button>
                </div>
                <div id="resultContainer" style="display: none;">
                    <h4><b><u>Special Offer Result</u></b></h4>
                    <p id="qualificationReason"></p>
                    <p id="offerDetails"></p>
                    <p id="timeSpent"></p>
                </div>
                
            </div>
            
        </div>
    </div>

    <footer>
        <h4 id="date" style="padding-top: 20px"><script>formatDate();</script></h4>
        <h6>Anjali Massand AJM180009 & Aashritha Ananthula AXA180116</h6>
    </footer>
    <script src="scripts/specialtyshops.js"></script>
</body>

</html>