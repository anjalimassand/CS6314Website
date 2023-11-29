<?php
include 'config.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get JSON data sent from the JavaScript
    $requestData = json_decode(file_get_contents("php://input"), true);

    // Sanitize and validate data
    $itemName = mysqli_real_escape_string($conn, $requestData['itemName']);
    $quantity = intval($requestData['quantity']);

    // Your SQL query to update the database
    $updateInventoryQuery = "UPDATE Inventory SET QuantityInInventory = QuantityInInventory - $quantity WHERE Name = '$itemName'";

    // Perform the query
    if (mysqli_query($conn, $updateInventoryQuery)) {
        // Query executed successfully

        // You might want to log the transaction or update the cart and transactions table here

        echo "Cart updated successfully";
    } else {
        // Error in query execution
        echo "Error updating cart: " . mysqli_error($conn);
    }

    $itemNum = "SELECT ItemNumber FROM Inventory WHERE Name = '$itemName' LIMIT 1";
    $result = $conn->query($itemNum);

    if ($result->num_rows > 0) {
        // Assuming that each itemName is unique, so there should be only one row
        $row = $result->fetch_assoc();
        $itemNumber = $row["ItemNumber"];

        
        $customerID = $_SESSION['CustomerID'];
        $transactionID = $_SESSION['TransactionID'];

        $sqlInsertCart = "INSERT INTO Carts (CustomerID, TransactionID, ItemNumber, Quantity, CartStatus)
                      VALUES ($customerID, $transactionID, $itemNumber, $quantity, 'In Cart')";

        if ($conn->query($sqlInsertCart) === TRUE) {
            echo "Item added to the Carts Table successfully!";
        } else {
            echo "Error adding item to Carts Table: ";
        }
    } else {
        // Handle the case where no matching itemName is found
        echo "Item not found in the inventory.";
    }

} else {
    // Invalid request method
    http_response_code(405);
    echo "Invalid request method";
}

// Close the database connection
$conn->close();



?>