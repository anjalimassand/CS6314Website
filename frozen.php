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
    
    <title>Shopper's Stop: Frozen</title>
    <header>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="scripts/contactus.js"></script>
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
                <h3>Frozen</h3>
                <form class="search">
                    <input type="text" placeholder="Search..." name="search">
                    <button type="submit">Search<i class="fa fa-search"></i></button>
                </form>

                <div id="myBtnContainer" style="text-align:center; padding-top:15px;">
                    <button class="btn active" onclick="filterSelection('all')"> Show all</button>
                    <button class="btn" onclick="filterSelection('breakfast')"> Breakfast</button>
                    <button class="btn" onclick="filterSelection('dessert')"> Dessert</button>
                    <button class="btn" onclick="filterSelection('meals')"> Meals</button>
                    <button class="btn" onclick="filterSelection('pizza')"> Pizza</button>
                    <button class="btn" onclick="filterSelection('meat')"> Meat</button>
                    <button class="btn" onclick="filterSelection('snacks')"> Snacks</button>
                    <button class="btn" onclick="filterSelection('rollbacks')"> Rollbacks</button>
                </div>

                <div class="rowCard" id="productCards">
                <?php
                    // Query to select data from the Inventory table
                    $sql = "SELECT ItemNumber, Name, Category, Subcategory, UnitPrice, QuantityInInventory, ImageSrc FROM Inventory WHERE Category = 'Frozen'";
                    $result = $conn->query($sql);

                    // Check if there are rows in the result
                    if ($result->num_rows > 0) {
                        // Iterate through each row
                        while ($row = $result->fetch_assoc()) {
                            // Output HTML based on each row's data
                            echo '<div class="columnCard filterDiv show" data-category="' . strtolower($row['Subcategory']) . '">';;
                            echo '<div class="card">';
                            echo '<img src="' . $row['ImageSrc'] . '" alt="Avatar" width="100%" height="180">';
                            echo '<div class="container">';
                            echo '<h4><b>' . $row['Name'] . '</b></h4>';
                            echo '<p><strong>$' . number_format($row['UnitPrice'], 2) . '</strong></p>';
                            echo '<input type="number" class="center" id="' . strtolower($row['Name']) . '-quantity" name="' . strtolower($row['Name']) . '-quantity" min="1" max="10" value="1">';
                            echo '<button type="button" class="center" onclick="addToCart(\'' . $row['Name'] . '\', \'' . $row['QuantityInInventory'] . '\')">Add to Cart</button>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo "No items found in the inventory.";
                    }
                    ?>
                </div>
                
            </div>
            
        </div>
    </div>

    <footer>
        <h4 id="date" style="padding-top: 20px"><script>formatDate();</script></h4>
        <h6>Anjali Massand AJM180009</h6>
    </footer>
   
    <script src="scripts/frozen.js"></script>
    <script src="scripts/filter.js"></script>
    <script src="scripts/inventoryItems.js"></script>
</body>

</html>