<?php
session_start();

include 'config.php';

$customerID = $_SESSION['CustomerID'];
$transactionID = $_SESSION['TransactionID'];

// Update the Transaction Status to 'Cancelled' in the Transactions table
$sql = "UPDATE Transactions SET TransactionStatus = 'Shopped' WHERE CustomerID = $customerID AND TransactionID = $transactionID";

if ($conn->query($sql) === TRUE) {
    echo "Transaction cancelled successfully!";
} else {
    echo "Error cancelling transaction: ";
}


$conn->close();
?>
