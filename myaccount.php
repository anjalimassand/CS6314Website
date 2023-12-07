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
                        echo "<h2>Items Low in Inventory:</h2>";
                        // Check if there are rows in the result set
                        if ($result->num_rows > 0) {
                            
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

                        // Form to input specific date
                        echo '<h2> Input Date </h2>';
                        echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
                        echo '    <label for="selectedDate">Enter Specific Date:</label>';
                        echo '    <input type="date" id="selectedDate" name="selectedDate" required>';
                        echo '    <input type="submit" value="Submit">';
                        echo '</form>';

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            // Retrieve user input from the form
                            if (isset($_POST['selectedDate'])) {


                                $selectedDate = $_POST['selectedDate'];

                                // SQL query to retrieve customers with more than 2 transactions on the selected date
                                $sql = "SELECT
                                        c.CustomerID,
                                        c.FirstName,
                                        c.LastName,
                                        COUNT(t.TransactionID) AS TransactionCount
                                    FROM
                                        Customers c
                                    JOIN
                                        Transactions t ON c.CustomerID = t.CustomerID
                                    WHERE
                                        DATE(t.TransactionDate) = '$selectedDate'
                                    GROUP BY
                                        c.CustomerID
                                    HAVING
                                        TransactionCount > 2";

                                $result = $conn->query($sql);

                                if (isset($result) && $result->num_rows > 0) {
                                    echo '<h2>Customers with More Than 2 Transactions on ' . $selectedDate . '</h2>';
                                    echo '<table>';
                                    echo '<tr>';
                                    echo '<th>CustomerID</th>';
                                    echo '<th>Name</th>';
                                    echo '<th>Transaction Count</th>';
                                    echo '</tr>';

                                    while ($row = $result->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<td>' . $row['CustomerID'] . '</td>';
                                        echo '<td>' . $row['FirstName'] . ' ' . $row['LastName'] . '</td>';
                                        echo '<td>' . $row['TransactionCount'] . '</td>';
                                        echo '</tr>';
                                    }

                                    echo '</table>';
                                } elseif (isset($result)) {
                                    echo '<p>No results found for the selected date.</p>';
                                }
                            }
                        }

                        //   echo '<h2>Admin Customer List</h2>';
                        // Initialize variables for user input
                        $itemNumber = "";
                        $newUnitPrice = "";
                        $newQuantity = "";

                        // echo "<h2>Update Inventory Item:</h2>";
                
                        // echo '<form method="post" action="">';
                        // echo '    Enter Item Number: <input type="text" name="itemNumber" value="' . htmlspecialchars($itemNumber) . '" required>';
                        // echo '    Enter New Unit Price: <input type="text" name="newUnitPrice" value="' . htmlspecialchars($newUnitPrice) . '" required>';
                        // echo '    Enter New Quantity: <input type="text" name="newQuantity" value="' . htmlspecialchars($newQuantity) . '" required>';
                        // echo '    <input type="submit" value="Update Item">';
                        // echo '</form>';
                
                        // // Check if the form is submitted
                        // if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
                        //     if (isset($_POST["itemNumber"], $_POST["newUnitPrice"], $_POST["newQuantity"])) {
                        //         // Get the user input
                        //         $itemNumber = $_POST["itemNumber"];
                        //         $newUnitPrice = $_POST["newUnitPrice"];
                        //         $newQuantity = $_POST["newQuantity"];
                
                        //         // Validate the input (you may want to enhance this part)
                        //         if (!empty($itemNumber) && is_numeric($newUnitPrice) && is_numeric($newQuantity)) {
                        //             // SQL query to update the unit price and quantity in inventory
                        //             $sql = "UPDATE Inventory
                        //         SET UnitPrice = '$newUnitPrice', QuantityInInventory = '$newQuantity'
                        //         WHERE ItemNumber = '$itemNumber'";
                
                        //             // Execute the query
                        //             if ($conn->query($sql) === TRUE) {
                        //                 echo '<p style="color: green;">Item updated successfully!</p>';
                        //             } else {
                        //                 echo '<p style="color: red;">Unable to update item: ' . '</p>';
                        //             }
                        //         } else {
                        //             echo '<p style="color: red;">Invalid input. Please enter valid values for item number, unit price, and quantity.</p>';
                        //         }
                        //     }
                
                        // }
                
                        echo '<h2>Enter Zipcode and Month</h2>';
                        echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">';
                        echo '    <label for="zipCode">Enter Zip Code:</label>';
                        echo '    <input type="text" id="zipCode" name="zipCode" required>';
                        echo '    <label for="month">Enter Month (1-12):</label>';
                        echo '    <input type="number" id="month" name="month" min="1" max="12" required>';
                        echo '    <input type="submit" value="Submit">';
                        echo '</form>';

                        // Check if the form is submitted
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {

                            if (isset($_POST["zipCode"], $_POST["month"])) {

                                // Retrieve user inputs from the form
                                $specifiedZipCode = $_POST['zipCode'];
                                $specifiedMonth = $_POST['month'];

                                $sql = "SELECT
                                c.CustomerID,
                                c.FirstName,
                                c.LastName,
                                c.Address,
                                c.Zipcode
                            FROM
                                Customers c
                            JOIN
                                Transactions t ON c.CustomerID = t.CustomerID
                            JOIN
                                Carts ca ON c.CustomerID = ca.CustomerID
                            WHERE
                                c.Zipcode = '$specifiedZipCode'
                                AND MONTH(t.TransactionDate) = $specifiedMonth
                            GROUP BY
                                c.CustomerID
                            HAVING
                                COUNT(t.TransactionID) > 2";

                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    echo '<table>';
                                    echo '<tr>';
                                    echo '<th>CustomerID</th>';
                                    echo '<th>Name</th>';
                                    echo '<th>Address</th>';
                                    echo '<th>Zipcode</th>';
                                    echo '</tr>';

                                    while ($row = $result->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<td>' . $row['CustomerID'] . '</td>';
                                        echo '<td>' . $row['FirstName'] . ' ' . $row['LastName'] . '</td>';
                                        echo '<td>' . $row['Address'] . '</td>';
                                        echo '<td>' . $row['Zipcode'] . '</td>';
                                        echo '</tr>';
                                    }

                                    echo '</table>';
                                } else {
                                    echo 'No results found.';
                                }
                            }
                        }

                        echo '<h2>Update Inventory Form</h2>';
                        echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">';
                        echo '    <label for="itemNumber">Enter Item Number:</label>';
                        echo '    <input type="text" id="itemNumber" name="itemNumber" required>';
                        echo '    <label for="newUnitPrice">Enter New Unit Price:</label>';
                        echo '    <input type="number" id="newUnitPrice" name="newUnitPrice" step="0.01" required>';
                        echo '    <label for="newQuantity">Enter New Quantity:</label>';
                        echo '    <input type="number" id="newQuantity" name="newQuantity" required>';
                        echo '    <input type="submit" value="Submit">';
                        echo '</form>';

                        // Check if the form is submitted
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            if (isset($_POST["itemNumber"], $_POST["newUnitPrice"], $_POST["newQuantity"])) {
                                // Retrieve user inputs from the form
                                $itemNumber = $_POST["itemNumber"];
                                $newUnitPrice = $_POST["newUnitPrice"];
                                $newQuantity = $_POST["newQuantity"];

                                // SQL query to update the values in the Inventory table
                                $sql = "UPDATE Inventory
                                SET UnitPrice = '$newUnitPrice', QuantityInInventory = '$newQuantity'
                                WHERE ItemNumber = '$itemNumber'";

                                if ($conn->query($sql) === TRUE) {
                                    echo "Record updated successfully";
                                } else {
                                    echo "Error updating record: ";
                                }
                            }
                        }
                        // more that 20 yrs
                
                        $sql = "SELECT
                            c.CustomerID,
                            c.FirstName,
                            c.LastName,
                            c.Age,
                            COUNT(t.TransactionID) AS TransactionCount
                        FROM
                            Customers c
                        LEFT JOIN
                            Transactions t ON c.CustomerID = t.CustomerID
                        WHERE
                            c.Age > 20
                        GROUP BY
                            c.CustomerID
                        HAVING
                            TransactionCount > 3";

                        $result = $conn->query($sql);
                        echo '<h2>Customers Older Than 20 with More Than 3 Transactions</h2>';
                        if ($result->num_rows > 0) {
                            echo '<h2>Customers Older Than 20 with More Than 3 Transactions</h2>';
                            echo '<table>';
                            echo '<tr>';
                            echo '<th>CustomerID</th>';
                            echo '<th>Name</th>';
                            echo '<th>Age</th>';
                            echo '<th>Transaction Count</th>';
                            echo '</tr>';

                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . $row['CustomerID'] . '</td>';
                                echo '<td>' . $row['FirstName'] . ' ' . $row['LastName'] . '</td>';
                                echo '<td>' . $row['Age'] . '</td>';
                                echo '<td>' . $row['TransactionCount'] . '</td>';
                                echo '</tr>';
                            }

                            echo '</table>';
                        } else {
                            echo 'No customers found.';
                        }


                    } else {
                        include 'displayUserTable.php';
                        echo '<p></p>';
                        echo '<form method="post" action="displayUserTable.php">';
                        echo '    <label for="filterType">Select Filter:</label>';
                        echo '    <select name="filterType" id="filterType" onchange="showInput()">';
                        echo '        <option value="month">Transactions in a Specific Month</option>';
                        echo '        <option value="last3months">Last 3 Months</option>';
                        echo '        <option value="year">Transactions in a Specific Year</option>';
                        echo '    </select>';

                        echo '    <div id="monthInput" style="display: none;">';
                        echo '        <label for="selectedMonth">Select Month:</label>';
                        echo '        <input type="number" name="selectedMonth" min="1" max="12">';
                        echo '    </div>';

                        echo '    <div id="yearInput" style="display: none;">';
                        echo '        <label for="selectedYear">Select Year:</label>';
                        echo '        <input type="number" name="selectedYear" min="2000" max="' . date('Y') . '">';
                        echo '    </div>';

                        echo '    <input type="submit" name="generateButton" value="Generate">';
                        echo '</form>';
                    }

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

                <!-- <p></p>
                <form method="post" action="displayUserTable.php">
                    <label for="filterType">Select Filter:</label>
                    <select name="filterType" id="filterType" onchange="showInput()">
                        <option value="month">Transactions in a Specific Month</option>
                        <option value="last3months">Last 3 Months</option>
                        <option value="year">Transactions in a Specific Year</option>
                    </select>
                    <div id="monthInput" style="display: none;">
                        <label for="selectedMonth">Select Month:</label>
                        <input type="number" name="selectedMonth" min="1" max="12">
                    </div>

                    <div id="yearInput" style="display: none;">
                        <label for="selectedYear">Select Year:</label>
                        <input type="number" name="selectedYear" min="2000" max="">
                    </div>

                    <input type="submit" name="generateButton" value="Generate">
                </form> -->

                <script>
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
        <h6>Anjali Massand AJM180009 & Aashritha Ananthula AXA180116</h6>
    </footer>

</body>

</html>