<?php
include 'config.php';
// session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the CartID from the POST data
    $cartID = $_POST['cartID'];

    // Fetch item details from the Carts table
    $cartItemQuery = "SELECT * FROM Carts WHERE CartID = $cartID";
    $cartItemResult = $conn->query($cartItemQuery);

    echo $cartID;

    if ($cartItemResult->num_rows > 0) {
        $cartItem = $cartItemResult->fetch_assoc();
        $itemNumber = $cartItem['ItemNumber'];
        $quantityInCart = $cartItem['Quantity'];

        // Fetch item details from the Inventory table
        $inventoryQuery = "SELECT * FROM Inventory WHERE ItemNumber = $itemNumber";
        $inventoryResult = $conn->query($inventoryQuery);

        if ($inventoryResult->num_rows > 0) {
            $inventoryItem = $inventoryResult->fetch_assoc();
            $unitPrice = $inventoryItem['UnitPrice'];

            // Calculate the total price for the item in the cart
            $itemTotal = $unitPrice * $quantityInCart;

            // Update the Transactions table's total price
            $transactionID = $cartItem['TransactionID'];
            $updateTransactionQuery = "UPDATE Transactions SET TotalPrice = TotalPrice - $itemTotal WHERE TransactionID = $transactionID";
            $conn->query($updateTransactionQuery);

            // Update the Inventory table's quantity
            $newQuantityInInventory = $inventoryItem['QuantityInInventory'] + $quantityInCart;
            $updateInventoryQuery = "UPDATE Inventory SET QuantityInInventory = $newQuantityInInventory WHERE ItemNumber = $itemNumber";
            $conn->query($updateInventoryQuery);

            // Update the CartStatus to "Cancelled" in the Carts table
            $updateCartStatusQuery = "UPDATE Carts SET CartStatus = 'Cancelled' WHERE CartID = $cartID";
            if ($conn->query($updateCartStatusQuery) === TRUE) {
                echo 'Item status updated to Cancelled successfully.';
            } else {
                echo 'Error updating item status: ';
            }

            // Retrieve item numbers and quantities from the Carts table
            $sqlSelectCart = "SELECT ItemNumber, Quantity FROM Carts WHERE TransactionID = $transactionID AND CartStatus = 'In Cart'";
            $resultSelectCart = $conn->query($sqlSelectCart);

            if ($resultSelectCart->num_rows <= 0) {
                 // Update the transaction status to "Cancelled" in the Transactions table
                $updateTransactionStatusQuery = "UPDATE Transactions SET TransactionStatus = 'Cancelled' WHERE TransactionID = '$transactionID'";
                
                if ($conn->query($updateTransactionStatusQuery) === TRUE) {
                    echo 'Transaction status updated to Cancelled successfully.';
                } else {
                    echo 'Error updating Transaction status: ' . $conn->error;
                }
            }

        } else {
            echo 'Error: Item not found in inventory.';
        }
    } else {
        echo 'Error: Item not found in cart.';
    }

    $conn->close();
} else {
    echo 'Invalid request.';
}
?>