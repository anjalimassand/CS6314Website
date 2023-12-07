<?php
session_start();

include 'config.php';

$customerID = $_SESSION['CustomerID'];
$transactionID = $_SESSION['TransactionID'];

// Update the Cart Status to 'Cancelled' in the Carts table
$sql = "UPDATE Carts SET CartStatus = 'Cancelled' WHERE CustomerID = '$customerID' AND TransactionID = '$transactionID'";

if ($conn->query($sql) === TRUE) {
    echo "Cart entries cancelled successfully!";
} else {
    echo "Error cancelling cart entries: ";
}

$conn->close();
?>
