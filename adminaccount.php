<?php
include 'config.php';
session_start(); // Start the session

if (isset($_SESSION['username'])) {
    echo "Hello, ", $_SESSION['username'];
}
// Check if the user is logged in
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    // Redirect to the login page if the user is not an admin
    header("Location: myaccount.php");
    exit();
}

// Check if the form is submitted for file upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Include the readInventory.php logic for file processing
    include_once 'readInventory.php';
}
?>

<!DOCTYPE html>
<html>

<head>
    <script src="scripts/contactus.js"></script>
    <title>Shopper's Stop: My Account</title>
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
            <h3>Upload New Inventory</h3>

                <form action="adminaccount.php" method="post" enctype="multipart/form-data" style="text-align:center;">
                    <label for="file">Select File:</label>
                    <input type="file" name="file" id="file" accept=".xml, .json" required>
                    <br>
                    <label for="category">Select Category:</label>
                    <select name="category" id="category" required>
                        <option value="fresh">Fresh Products</option>
                        <option value="frozen">Frozen Products</option>
                        <option value="candy">Candy</option>
                        <option value="snacks">Snacks</option>
                        <option value="baking">Baking Products</option>
                        <option value="breakfast">Breakfast Products</option>
                        <option value="pantry">Pantry Products</option>
                    </select>
                    <br>
                    <input type="submit" value="Upload" name="submit">
                </form>

                <form class="logout" method="post" action="logout.php">
                    <input type="submit" class="logoutButton" value="Logout">
                </form>
            </div>
            
        </div>
    </div>

    <footer>
        <h4 id="date" style="padding-top: 20px"><script>formatDate();</script></h4>
        <h6>Anjali Massand AJM180009</h6>
    </footer>

</body>

</html>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>

<body>

    <h2>Upload New Inventory</h2>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="file">Select File:</label>
        <input type="file" name="file" id="file" accept=".xml, .json" required>
        <br>
        <label for="category">Select Category:</label>
        <select name="category" id="category" required>
            <option value="fresh">Fresh Products</option>
            <option value="frozen">Frozen Products</option>
            <option value="candy">Candy</option>
            <option value="snacks">Snacks</option>
            <option value="baking">Baking Products</option>
            <option value="breakfast">Breakfast Products</option>
            <option value="pantry">Pantry Products</option>
        </select>
        <br>
        <input type="submit" value="Upload" name="submit">
    </form>

</body>

</html>
