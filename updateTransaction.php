<?php
include 'config.php';
session_start();
$transactionStatus = 'In Cart';

// Set the transaction status and date

$transactionDate = date('Y-m-d H:i:s'); // Current date and time

// Calculate the total price from the items in the cart (adjust this based on your data structure)
$totalPrice = 0;

$requestData = json_decode(file_get_contents("php://input"), true);
$itemName = $requestData['itemName'];
$quantity = $requestData['quantity'];
$price = $requestData['price'];
$totalPrice += $quantity * $price;
$customerID = $_SESSION['CustomerID'];

if ($requestData['createNew'] == 'true') {

    // Insert into Transactions table without specifying TransactionID
    $sql = "INSERT INTO Transactions (TransactionStatus, TransactionDate, TotalPrice, CustomerID)
VALUES ('$transactionStatus', '$transactionDate', $totalPrice, $customerID)";

    if ($conn->query($sql) === TRUE) {
        // Retrieve the auto-generated TransactionID after the insert
//  $lastInsertedID = $conn->insert_id;
        echo "New transaction created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // SQL query to get TransactionID based on CustomerID and TransactionStatus
    $sql = "SELECT TransactionID FROM Transactions WHERE CustomerID = '$customerID' AND TransactionStatus = '$transactionStatus' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Assuming there is at least one row, fetch the result
        $row = $result->fetch_assoc();
        $transactionID = $row["TransactionID"];

        $_SESSION['TransactionID'] = $transactionID;
        echo "Transaction ID: $transactionID";

    } else {
        echo "No transaction found with the specified criteria.";
    }


} else {
    $customerID = $_SESSION['CustomerID'];
   

    // SQL query to get TransactionID based on CustomerID and TransactionStatus
    $sql = "SELECT TransactionID FROM Transactions WHERE CustomerID = '$customerID' AND TransactionStatus = '$transactionStatus' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Assuming there is at least one row, fetch the result
        $row = $result->fetch_assoc();
        $transactionID = $row["TransactionID"];

        $_SESSION['TransactionID'] = $transactionID;
        echo "Transaction ID: $transactionID";

    } else {
        echo "No transaction found with the specified criteria.";
    }

    $customerID = $_SESSION['CustomerID'];
    $transactionID = $_SESSION['TransactionID'];


    // Select the TotalPrice from the Transactions table
    $sqlSelectTotalPrice = "SELECT TotalPrice
                        FROM Transactions
                        WHERE TransactionID = $transactionID
                        AND CustomerID = $customerID";

    $result = $conn->query($sqlSelectTotalPrice);

    if ($result->num_rows > 0) {
        // Assuming that each combination of TransactionID and CustomerID is unique
        $row = $result->fetch_assoc();
        $existingTotalPrice = $row["TotalPrice"];

        echo "Existing Total Price: $existingTotalPrice";
    } else {
        echo "No matching entry found in the Transactions table.";
    }
    // Calculate the new total price (adjust this based on your data structure)
    $newTotalPrice = $existingTotalPrice + $totalPrice;

    // Update the TotalPrice in the Transactions table
    $sqlUpdateTotalPrice = "UPDATE Transactions 
                        SET TotalPrice = $newTotalPrice
                        WHERE TransactionID = $transactionID 
                        AND CustomerID = $customerID";

    if ($conn->query($sqlUpdateTotalPrice) === TRUE) {
        echo "TotalPrice updated successfully!";
    } else {
        echo "Error updating TotalPrice: ";
    }

}


// Close the database connection
$conn->close();
?>