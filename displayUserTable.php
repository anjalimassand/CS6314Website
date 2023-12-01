<?php
include 'config.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$customerID = $_SESSION['CustomerID'];
// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $filterType = $_POST['filterType'];

    // Display transactions and items based on the selected filter
    if ($filterType == "month") {
        $selectedMonth = $_POST['selectedMonth'];
        displayFilteredTransactions($conn, $customerID, "MONTH(Transactions.TransactionDate) = $selectedMonth");
    } elseif ($filterType == "last3months") {
        displayFilteredTransactions($conn, $customerID, "Transactions.TransactionDate >= NOW() - INTERVAL 3 MONTH");
    } elseif ($filterType == "year") {
        $selectedYear = $_POST['selectedYear'];
        displayFilteredTransactions($conn, $customerID, "YEAR(Transactions.TransactionDate) = $selectedYear");
    }
    // } else {
    //     // Default to displaying all transactions and items
    //     displayTransactionsAndItems($conn, $customerID);
    // }
}

// Function to display last transaction and items
function displayTransactionsAndItems($conn, $customerID)
{
    // Query to retrieve transactions and items for the customer
    $sql = "SELECT Transactions.TransactionID, Transactions.TransactionStatus, Carts.ItemNumber, Inventory.Name
            FROM Transactions
            INNER JOIN Carts ON Transactions.TransactionID = Carts.TransactionID
            INNER JOIN Inventory ON Carts.ItemNumber = Inventory.ItemNumber
            WHERE Transactions.CustomerID = $customerID";

    $result = $conn->query($sql);
    if (!$result) {
        // Query execution failed, display the error message
        echo "Error: " . $conn->error;
    }

    if ($result->num_rows > 0) {
        // Display the data in a table
        echo "<table border='1'>";
        echo "<tr><th>Transaction ID</th><th>Status</th><th>Item Number</th><th>Item Name</th><th>Action</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['TransactionID'] . "</td>";
            echo "<td>" . $row['TransactionStatus'] . "</td>";
            echo "<td>" . $row['ItemNumber'] . "</td>";
            echo "<td>" . $row['Name'] . "</td>";

            // Add a delete button if the status is "in cart"
            if ($row['TransactionStatus'] === "In Cart") {
                echo "<td><button onclick='deleteItem(" . $row['ItemNumber'] . ")'>Delete</button></td>";
            } else {
                echo "<td></td>"; // Empty column if the status is not "in cart"
            }

            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No transactions found for the customer.</p>";
    }
}

// Function to display transactions based on filter criteria
function displayFilteredTransactions($conn, $customerID, $filterCondition)
{

    if ($filterCondition === 'last3months') {
        $filterCondition = "Transactions.TransactionDate >= DATE_SUB(NOW(), INTERVAL 3 MONTH)";
    }

    // Query to retrieve filtered transactions and items for the customer
    $sql = "SELECT Transactions.TransactionID, Transactions.TransactionStatus, Carts.ItemNumber, Inventory.Name
            FROM Transactions
            INNER JOIN Carts ON Transactions.TransactionID = Carts.TransactionID
            INNER JOIN Inventory ON Carts.ItemNumber = Inventory.ItemNumber
            WHERE Transactions.CustomerID = $customerID AND $filterCondition";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display the data in a table
        echo "<table border='1'>";
        echo "<tr><th>Transaction ID</th><th>Status</th><th>Item Number</th><th>Item Name</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['TransactionID'] . "</td>";
            echo "<td>" . $row['TransactionStatus'] . "</td>";
            echo "<td>" . $row['ItemNumber'] . "</td>";
            echo "<td>" . $row['Name'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "Please use the back arrow in the header to go back to the MyAccount Page!";
    } else {
        echo "<p>No transactions found for the selected filter criteria.</p>";
        echo "Please use the back arrow in the header to go back to the MyAccount Page!";
    }
}
// // Function to cancel transaction and update inventory
// function cancelTransaction($conn, $customerID)
// {
//     $sqlStatus = "SELECT TransactionStatus FROM Transactions WHERE CustomerID = $customerID ORDER BY TransactionDate DESC LIMIT 1";
//     $resultStatus = $conn->query($sqlStatus);

//     if ($resultStatus->num_rows > 0) {
//         $rowStatus = $resultStatus->fetch_assoc();
//         $status = $rowStatus['TransactionStatus'];

//         // Check if the status allows cancellation (not shipped, etc.)
//         if ($statusAllowsCancellation) {
//             $sqlCancel = "UPDATE Transactions SET TransactionStatus = 'Cancelled' WHERE CustomerID = $customerID ORDER BY TransactionDate DESC LIMIT 1";
//             if ($conn->query($sqlCancel) === TRUE) {
//                 echo "Transaction cancelled successfully!";
                
//                 // Update the inventory for the canceled items
//                 $transactionID = $rowStatus['TransactionID'];
//                 $sqlItems = "SELECT * FROM Carts WHERE TransactionID = $transactionID";
//                 $resultItems = $conn->query($sqlItems);

//                 if ($resultItems->num_rows > 0) {
//                     while ($rowItem = $resultItems->fetch_assoc()) {
//                         // Update inventory for each canceled item
//                     }
//                 }
//             } else {
//                 echo "Error cancelling transaction: " . $conn->error;
//             }
//         } else {
//             echo "Transaction cannot be cancelled due to its status.";
//         }
//     } else {
//         echo "No transactions found for the customer.";
//     }
// }

// // Function to display transactions by date
// function displayTransactionsByDate($conn, $customerID, $selectedMonth, $selectedYear)
// {
//     // Formulate SQL query based on user input and retrieve transactions
//     $sqlDateFilter = "SELECT * FROM Transactions WHERE CustomerID = $customerID AND ...";
//     $resultDateFilter = $conn->query($sqlDateFilter);

//     if ($resultDateFilter->num_rows > 0) {
//         // Display transaction information
//         while ($rowTransaction = $resultDateFilter->fetch_assoc()) {
//             // Display transaction details
//         }
//     } else {
//         echo "No transactions found for the selected date.";
//     }
// }

// Example usage:

// Display last transaction and items
echo "<h2>Last Transaction and Items</h2>";
displayTransactionsAndItems($conn, $customerID);

// // Cancel transaction and update inventory
// echo "<h2>Cancel Transaction</h2>";
// cancelTransaction($conn, $customerID);

// // Display transactions by date
// echo "<h2>Transactions by Date</h2>";
// $selectedMonth = $_GET['month'];
// $selectedYear = $_GET['year'];
// displayTransactionsByDate($conn, $customerID, $selectedMonth, $selectedYear);

// Close the database connection
$conn->close();
?>
