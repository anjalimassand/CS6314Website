<?php
session_start();

// Include your database configuration file (config.php or similar)
include 'config.php';

// Sanitize and validate data
$customerID = $_SESSION['CustomerID'];
$transactionID = $_SESSION['TransactionID'];

// Update the Cart Status to 'Cancelled' in the Carts table
$sql = "UPDATE Carts SET CartStatus = 'Shopped' WHERE CustomerID = '$customerID' AND TransactionID = '$transactionID'";

if ($conn->query($sql) === TRUE) {
    echo "Cart entries cancelled successfully!";
} else {
    echo "Error cancelling cart entries: ";
}

// Close the database connection
$conn->close();
?>
