<?php
session_start();
// Include your database configuration file (config.php or similar)
include 'config.php';

// Sanitize and validate data
$customerID = $_SESSION['CustomerID'];
$transactionID = $_SESSION['TransactionID'];

// Update the Transaction Status to 'Cancelled' in the Transactions table
$sql = "UPDATE Transactions SET TransactionStatus = 'Shopped' WHERE CustomerID = $customerID AND TransactionID = $transactionID";

if ($conn->query($sql) === TRUE) {
    echo "Transaction cancelled successfully!";
} else {
    echo "Error cancelling transaction: ";
}

// Close the database connection
$conn->close();
?>
