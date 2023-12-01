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
                <?php

                // Check if the user is logged in
                if (isset($_SESSION['username'])) {
                    // User is logged in, show logout button
                    echo '<form class="logout" method="post" action="logout.php">';
                    echo '<input type="submit" class="logoutButton" value="Logout">';
                    echo '</form>';

                    if ($_SESSION['username'] == "admin") {
                        echo '<form action="readInventory.php" method="post" enctype="multipart/form-data" style="text-align:center;">';
                        echo '    <label for="file">Select File:</label>';
                        echo '    <input type="file" name="file" id="file" accept=".xml, .json" required>';
                        echo '    <br>';
                        echo '    <label for="category">Select Category:</label>';
                        echo '    <select name="category" id="category" required>';
                        echo '        <option value="fresh">Fresh Products</option>';
                        echo '        <option value="frozen">Frozen Products</option>';
                        echo '        <option value="candy">Candy</option>';
                        echo '        <option value="snacks">Snacks</option>';
                        echo '        <option value="baking">Baking Products</option>';
                        echo '        <option value="breakfast">Breakfast Products</option>';
                        echo '        <option value="pantry">Pantry Products</option>';
                        echo '    </select>';
                        echo '    <br>';
                        echo '    <input type="submit" value="Upload" name="submit">';
                        echo '</form>';

                        $sql = "SELECT * FROM Inventory";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Display the inventory table content in a table or format of your choice
                            echo "<h2>All Inventory:</h2>";
                            echo "<table border='1'>";
                            echo "<tr><th>Item Number</th><th>Name</th><th>Category</th><th>Subcategory</th><th>Unit Price</th><th>Quantity in Inventory</th><th>Image Source</th></tr>";
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["ItemNumber"] . "</td>";
                                echo "<td>" . $row["Name"] . "</td>";
                                echo "<td>" . $row["Category"] . "</td>";
                                echo "<td>" . $row["Subcategory"] . "</td>";
                                echo "<td>" . $row["UnitPrice"] . "</td>";
                                echo "<td>" . $row["QuantityInInventory"] . "</td>";
                                echo "<td>" . $row["ImageSrc"] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "No records found in the inventory table.";
                        }

                        // SQL query to select items with quantity less than 3
                        $sql = "SELECT * FROM Inventory WHERE QuantityInInventory < 3";

                        // Execute the query
                        $result = $conn->query($sql);

                        // Check if there are rows in the result set
                        if ($result->num_rows > 0) {
                            echo "<h2>Items Low in Inventory:</h2>";
                            echo "<table border='1'>";
                            echo "<tr><th>Item Number</th><th>Name</th><th>Category</th><th>Subcategory</th><th>Unit Price</th><th>Quantity in Inventory</th><th>Image Source</th></tr>";

                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["ItemNumber"] . "</td>";
                                echo "<td>" . $row["Name"] . "</td>";
                                echo "<td>" . $row["Category"] . "</td>";
                                echo "<td>" . $row["Subcategory"] . "</td>";
                                echo "<td>" . $row["UnitPrice"] . "</td>";
                                echo "<td>" . $row["QuantityInInventory"] . "</td>";
                                echo "<td>" . $row["ImageSrc"] . "</td>";
                                echo "</tr>";
                            }

                            echo "</table>";
                            echo '<h1></h1>';

                        } else {
                            echo '<p>No items are low in inventory.</p>';
                        }

                        // Initialize variables for user input
                        $itemNumber = "";
                        $newUnitPrice = "";
                        $newQuantity = "";

                        echo "<h2>Update Inventory Item:</h2>";

                        echo '<form method="post" action="">';
                        echo '    Enter Item Number: <input type="text" name="itemNumber" value="' . htmlspecialchars($itemNumber) . '" required>';
                        echo '    Enter New Unit Price: <input type="text" name="newUnitPrice" value="' . htmlspecialchars($newUnitPrice) . '" required>';
                        echo '    Enter New Quantity: <input type="text" name="newQuantity" value="' . htmlspecialchars($newQuantity) . '" required>';
                        echo '    <input type="submit" value="Update Item">';
                        echo '</form>';

                        // Check if the form is submitted
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            // Get the user input
                            $itemNumber = $_POST["itemNumber"];
                            $newUnitPrice = $_POST["newUnitPrice"];
                            $newQuantity = $_POST["newQuantity"];

                            // Validate the input (you may want to enhance this part)
                            if (!empty($itemNumber) && is_numeric($newUnitPrice) && is_numeric($newQuantity)) {
                                // SQL query to update the unit price and quantity in inventory
                                $sql = "UPDATE Inventory
                                SET UnitPrice = '$newUnitPrice', QuantityInInventory = '$newQuantity'
                                WHERE ItemNumber = '$itemNumber'";

                                // Execute the query
                                if ($conn->query($sql) === TRUE) {
                                    echo '<p style="color: green;">Item updated successfully!</p>';
                                } else {
                                    echo '<p style="color: red;">Unable to update item: ' . '</p>';
                                }
                            } else {
                                echo '<p style="color: red;">Invalid input. Please enter valid values for item number, unit price, and quantity.</p>';
                            }
                        }



                        // // date
                        // // Output HTML form using PHP
                        // echo '<form method="post" action="">';
                        // echo '    Enter Date (YYYY-MM-DD): <input type="text" name="date" value="' . htmlspecialchars($date) . '" required>';
                        // echo '    <input type="submit" value="Submit">';
                        // echo '</form>';
                        // $date = isset($_POST["date"]) ? $_POST["date"] : "";
                        // // Check if the form is submitted
                        // if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
                        //     // Validate the date (you may want to enhance this part)
                        //     // Here, I'm using a simple check for a valid date format (YYYY-MM-DD)
                        //     if (preg_match("/^\d{4}-\d{2}-\d{2}$/", $date)) {
                        //         // SQL query to select customers with more than 2 transactions on the specified date
                        //         $sql = "SELECT c.CustomerID, c.FirstName, c.LastName, COUNT(t.TransactionID) as TransactionCount
                        //         FROM Customers c
                        //         JOIN Carts cart ON c.CustomerID = cart.CustomerID
                        //         JOIN Transactions t ON cart.TransactionID = t.TransactionID
                        //         WHERE t.TransactionDate = '$date'
                        //         GROUP BY c.CustomerID
                        //         HAVING TransactionCount > 2";
                
                        //         // Execute the query
                        //         $result = $conn->query($sql);
                
                        //         // Check if there are rows in the result set
                        //         if ($result->num_rows > 0) {
                        //             echo "<h2>Customers with more than 2 transactions on $date:</h2>";
                        //             echo "<table border='1'>";
                        //             echo "<tr><th>Customer ID</th><th>First Name</th><th>Last Name</th><th>Transaction Count</th></tr>";
                
                        //             // Output data of each row
                        //             while ($row = $result->fetch_assoc()) {
                        //                 echo "<tr>";
                        //                 echo "<td>" . $row["CustomerID"] . "</td>";
                        //                 echo "<td>" . $row["FirstName"] . "</td>";
                        //                 echo "<td>" . $row["LastName"] . "</td>";
                        //                 echo "<td>" . $row["TransactionCount"] . "</td>";
                        //                 echo "</tr>";
                        //             }
                
                        //             echo "</table>";
                        //         } else {
                        //             echo "<p>No customers with more than 2 transactions on $date.</p>";
                        //         }
                        //     } else {
                        //         echo "<p>Invalid date format. Please enter a date in the format YYYY-MM-DD.</p>";
                        //     }
                        // }
                    }
                    // } else {
                    //     include 'displayUserTable.php';
                    // }
                
                } else {
                    // User is not logged in, show login form
                    echo '<h3>My Account</h3>';
                    echo '<form class="login" method="post" action="login.php">';
                    echo '<div class="containerLogin"> ';
                    echo '<label>Username: </label>';
                    echo '<input type="text" placeholder="Enter Username" name="username" required>';
                    echo '<label>Password: </label>';
                    echo '<input type="password" placeholder="Enter Password" name="password" required>';
                    echo '<input type="submit" class="loginButton" value="Login">';
                    echo '<h5 style="text-align:left">Password requirements:</h5>';
                    echo '<ul style="font-size:10pt">';
                    echo '<li>At least 8 characters</li>';
                    echo '<li>Lowercase character</li>';
                    echo '<li>Number</li>';
                    echo '</ul>';
                    echo '</div>';
                    echo '</form>';
                    echo '<h5>Don\'t have an account? <a href="register.php">Register Now</a></h5>';
                }
                ?>

                <form method="post" action="displayUserTable.php">
                    <label for="filterType">Select Filter:</label>
                    <select name="filterType" id="filterType" onchange="showInput()">
                        <option value="month">Transactions in a Specific Month</option>
                        <option value="last3months">Last 3 Months</option>
                        <option value="year">Transactions in a Specific Year</option>
                    </select>

                    <!-- Additional inputs based on the selected filter type -->
                    <div id="monthInput" style="display: none;">
                        <label for="selectedMonth">Select Month:</label>
                        <input type="number" name="selectedMonth" min="1" max="12">
                    </div>

                    <div id="yearInput" style="display: none;">
                        <label for="selectedYear">Select Year:</label>
                        <input type="number" name="selectedYear" min="2000" max="<?php echo date('Y'); ?>">
                    </div>

                    <input type="submit" name="generateButton" value="Generate">
                </form>

                <script>
                    // JavaScript function to show/hide input based on filter type
                    function showInput() {
                        var filterType = document.getElementById("filterType").value;
                        var monthInput = document.getElementById("monthInput");
                        var yearInput = document.getElementById("yearInput");

                        // Hide all inputs initially
                        monthInput.style.display = "none";
                        yearInput.style.display = "none";

                        // Show input based on filter type
                        if (filterType === "month") {
                            monthInput.style.display = "block";
                        } else if (filterType === "year") {
                            yearInput.style.display = "block";
                        }
                    }
                </script>
                <!--
                <h3>My Account</h3>
                <form class="login" method="post" action="login.php">
                    <div class="containerLogin"> 
                        <label>Username: </label> 
                        <input type="text" placeholder="Enter Username" name="username" required>
                        <label>Password: </label> 
                        <input type="password" placeholder="Enter Password" name="password" required>
                        <input type="submit" class="loginButton" value="Login"></button> 
                        <h5 style="text-align:left">Password requirements:</h5>
                        <ul style="font-size:10pt">
                            <li>10 characters</li>
                            <li>Uppercase character</li>
                            <li>Lowercase character</li>
                            <li>Number</li>
                        </ul> 
                    </div> 

                   
                </form>

                <h5>Don't have an account? <a href="php/register.php">Register Now</a></h5>
                
                <form class="logout" method="post" action="logout.php">
                    <input type="submit" class="logoutButton" value="Logout">
                </form>
            -->


            </div>

        </div>
    </div>

    <footer>
        <h4 id="date" style="padding-top: 20px">
            <script>formatDate();</script>
        </h4>
        <h6>Anjali Massand AJM180009</h6>
    </footer>

</body>

</html>