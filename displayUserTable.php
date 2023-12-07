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

// Display last transaction and items
echo "<h2>Last Transaction and Items</h2>";
displayTransactionsAndItems($conn, $customerID);


$conn->close();
?>
