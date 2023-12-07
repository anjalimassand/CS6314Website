<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "groceryData";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Directory to store uploaded files
$uploadDirectory = 'uploads/';

// Ensure the directory exists
if (!file_exists($uploadDirectory)) {
    mkdir($uploadDirectory, 0777, true);
}

// Process the uploaded file
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded
    if (isset($_FILES["file"])) {
        $file = $_FILES["file"];

        // Move the uploaded file to the specified directory
        $targetFilePath = $uploadDirectory . basename($file["name"]);
        move_uploaded_file($file["tmp_name"], $targetFilePath);

        // Determine the file type based on the extension
        $fileExtension = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $fileType = '';

        switch ($fileExtension) {
            case 'xml':
                $fileType = 'xml';
                // Process XML file
                $xml = simplexml_load_file($targetFilePath);
                foreach ($xml->product as $product) {
                    // Process XML product data
                    $name = $product->name;
                    $quantity = $product->quantity;
                    $price = $product->price;
                    $mainCat = $product->mainCat;
                    $imageSrc = $product->imageSrc;
                    $subCatElement = $product->category;
                    $subCat = (string) $subCatElement;

                    // Insert data into the inventory table
                    $sql = "INSERT INTO inventory (Name, Category, Subcategory, UnitPrice, QuantityInInventory, ImageSrc)
                            VALUES ('$name', '$mainCat', '$subCat', '$price', '$quantity', '$imageSrc')
                            ON DUPLICATE KEY UPDATE QuantityInInventory = $quantity";

                    $conn->query($sql);
                    header("Location: myaccount.php");
                }
                break;

            case 'json':
                $fileType = 'json';
                // Process JSON file
                $jsonContent = file_get_contents($targetFilePath);
                $jsonArray = json_decode($jsonContent, true);
                foreach ($jsonArray as $product) {
                    // Process JSON product data
                    $name = $product['name'];
                    $quantity = $product['quantity'];
                    $price = $product['price'];
                    $imageSrc = $product['imageSrc'];
                    $mainCat = $product['mainCat'];
                    $subCatArray = isset($product['category']) ? $product['category'] : array();

                    // Combine array values into a string with commas
                    if (count($subCatArray) > 1) {
                        $subCat = implode(', ', $subCatArray);
                    } else {
                        $subCat = implode('', $subCatArray);
                    }

                    // Insert data into the inventory table
                    $sql = "INSERT INTO inventory (Name, Category, Subcategory, UnitPrice, QuantityInInventory, ImageSrc)
                            VALUES ('$name', '$mainCat', '$subCat', '$price', '$quantity', '$imageSrc')
                            ON DUPLICATE KEY UPDATE QuantityInInventory = $quantity";


                    $conn->query($sql);
                    header("Location: myaccount.php");
                }
                break;

            default:
                echo "Unsupported file type: $fileExtension";
                break;
        }

        unlink($targetFilePath);
    } else {
        echo "No file uploaded.";
    }
}

$conn->close();
?>