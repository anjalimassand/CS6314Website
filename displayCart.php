<?php
include 'config.php'; // Include your database configuration file

// Sanitize and validate data
$customerID = $_SESSION['CustomerID'];
$transactionID = $_SESSION['TransactionID'];

// Retrieve information about items in the cart
$sqlSelectCartItems = "SELECT C.CartID, I.ItemNumber, I.Category, I.Subcategory, I.Name, I.UnitPrice, C.Quantity, T.TransactionID, T.TransactionStatus, T.TransactionDate, T.TotalPrice
FROM Carts C
JOIN Inventory I ON C.ItemNumber = I.ItemNumber
JOIN Transactions T ON C.TransactionID = T.TransactionID
WHERE C.CustomerID = $customerID AND C.TransactionID = $transactionID AND C.CartStatus = 'In Cart'";

$resultSelectCartItems = $conn->query($sqlSelectCartItems);

if ($resultSelectCartItems->num_rows > 0) {
    // Display header information
    echo "<table border='1'>
        <tr>
            <th>Cart ID</th>
            <th>Item ID</th>
            <th>Category</th>
            <th>Subcategory</th>
            <th>Name</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Transaction ID</th>
            <th>Transaction Status</th>
            <th>Transaction Date</th>
            <th>Total Price</th>
        </tr>";

    // Loop through the results and display information for each item in the cart
    while ($row = $resultSelectCartItems->fetch_assoc()) {
        echo "<tr>
            <td>{$row['CartID']}</td>
            <td>{$row['ItemNumber']}</td>
            <td>{$row['Category']}</td>
            <td>{$row['Subcategory']}</td>
            <td>{$row['Name']}</td>
            <td>{$row['UnitPrice']}</td>
            <td>{$row['Quantity']}</td>
            <td>{$row['TransactionID']}</td>
            <td>{$row['TransactionStatus']}</td>
            <td>{$row['TransactionDate']}</td>
            <td>{$row['TotalPrice']}</td>
        </tr>";
    }

    echo "</table>";
} else {
    echo "No items found in the cart.";
}

// Close the database connection
$conn->close();
?>
