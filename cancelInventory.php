<?php
session_start();
include 'config.php'; // Include your database configuration file

// Sanitize and validate data
$customerID = $_SESSION['CustomerID'];
$transactionID = $_SESSION['TransactionID'];

// Retrieve item numbers and quantities from the Carts table
$sqlSelectCart = "SELECT ItemNumber, Quantity FROM Carts WHERE CustomerID = $customerID AND TransactionID = $transactionID AND CartStatus = 'In Cart'";
$resultSelectCart = $conn->query($sqlSelectCart);

if ($resultSelectCart->num_rows > 0) {
    // Loop through the results and update the Inventory table
    while ($row = $resultSelectCart->fetch_assoc()) {
        $itemNumber = $row['ItemNumber'];
        $quantity = $row['Quantity'];

        // Update the Inventory table by adding the quantity back
        $sqlUpdateInventory = "UPDATE Inventory SET QuantityInInventory = QuantityInInventory + $quantity WHERE ItemNumber = $itemNumber";

        if ($conn->query($sqlUpdateInventory) !== TRUE) {
            echo "Error updating Inventory: ";
            exit();
        }
    }

    // // Set CartStatus to 'Cancelled' for the items in the cart
    // $sqlUpdateCartStatus = "UPDATE Carts SET CartStatus = 'Cancelled' WHERE CustomerID = $customerID AND TransactionID = $transactionID";
    // if ($conn->query($sqlUpdateCartStatus) !== TRUE) {
    //     echo "Error updating CartStatus: " . $conn->error;
    //     exit();
    // }

    echo "Quantities added back to Inventory successfully!";
} else {
    echo "No items found in the cart.";
}

// Close the database connection
$conn->close();
?>
