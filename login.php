<?php
include 'config.php';
session_start(); // Start the session

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate the username and password (you may want to enhance this part)
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Example validation - Replace this with your authentication logic
    if ($username == "admin" && $password == "admin123") {
        // Set session variables
        $_SESSION["username"] = $username;

        // Redirect to a page after successful login
        header("Location: myaccount.php");
        exit();
    } else if (($username == "anjali" && $password == "anjali123")){
        $_SESSION["username"] = $username;
        header("Location: myaccount.php");
        echo "Invalid username or password";


        // Fetch CustomerID based on the username
        $sql = "SELECT CustomerID FROM Users WHERE UserName = '$username' LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Assuming that each username is unique, so there should be only one row
            $row = $result->fetch_assoc();
            $customerID = $row["CustomerID"];

            $_SESSION["CustomerID"] = $customerID;
            exit();
        } else {
            echo "Invalid username or password";
        }

        
    }
}

?>