<?php
include 'config.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $requestData = json_decode(file_get_contents("php://input"), true);

    $itemName = mysqli_real_escape_string($conn, $requestData['itemName']);
    $quantity = intval($requestData['quantity']);

    $updateInventoryQuery = "UPDATE Inventory SET QuantityInInventory = QuantityInInventory - $quantity WHERE Name = '$itemName'";

    if (mysqli_query($conn, $updateInventoryQuery)) {

        echo "Cart updated successfully";
    } else {
        // Error in query execution
        echo "Error updating cart: " . mysqli_error($conn);
    }

    $itemNum = "SELECT ItemNumber FROM Inventory WHERE Name = '$itemName' LIMIT 1";
    $result = $conn->query($itemNum);

    if ($result->num_rows > 0) {
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

$conn->close();



?>