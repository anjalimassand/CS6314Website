<!DOCTYPE html>
<html lang="en">

<head>
    <script src="scripts/contactus.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopper's Stop: Contact Us</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <script src="scripts/register.js"></script>

    <header>
        <div class="top">
            <img src="images/groceries.jpeg" alt="Groceries">
            <h1>Shopper's Stop</h1>
        </div>
    </header>
</head>

<body>
    <link rel="stylesheet" href="mystyle.css">

    <div class="topnav">
        <a href="index.php">Home</a>
        <a href="freshproducts.php">Fresh Products</a>
        <a href="frozen.php">Frozen</a>
        <a href="pantry.php">Pantry</a>
        <a href="breakfastcereal.php">Breakfast & Cereal</a>
        <a href="baking.php">Baking</a>
        <a href="snacks.php">Snacks</a>
        <a href="candy.php">Candy</a>
        <a href="specialtyshops.php">Specialty Shops</a>
        <a href="deals.php">Deals</a>
        <a href="aboutus.php">About Us</a>
        <a href="contactus.php">Contact Us</a>
        <a href="myaccount.php">My Account</a>
        <a href="cart.php">Shopping Cart</a>
    </div>

    <div class="container">
        <div class="row">

            <div class="col-md-6" style="background-color:lightgrey; margin-left:220pt">
                <div>

                    <h3>Create Account</h3>

                    <!-- Bootstrap alert for success message -->
                    <div id="successMessage" class="alert alert-success mt-3" role="alert" style="display: none;">
                        Registered successfully! <a href="myaccount.php">Click to Login Now!</a>
                    </div>

                    <form name="commentForm" class="login needs-validation" action="" method="post">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" name="username" id="username" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" id="password" pattern=".{8,}"
                                title="Password must be at least 8 characters." required>
                        </div>

                        <div class="form-group">
                            <label for="password2">Re-enter Password:</label>
                            <input type="password" class="form-control" name="password2" id="password2" pattern=".{8,}"
                                title="Password must be at least 8 characters." required>
                            <small id="pwdMatchMessage" style="color: red;"></small>
                        </div>

                        <div class="form-group">
                            <label for="first">First Name:</label>
                            <input type="text" class="form-control" name="first" id="first" pattern="[A-Za-z]+"
                                title="First name must only contain letters." required>
                        </div>

                        <div class="form-group">
                            <label for="last">Last Name:</label>
                            <input type="text" class="form-control" name="last" id="last" pattern="[A-Za-z]+"
                                title="Last name must only contain letters." required>
                        </div>

                        <div class="form-group">
                            <label for="birthday">Date of Birth:</label>
                            <input type="date" class="form-control" name="birthday" id="birthday" required>
                        </div>

                        <div class="form-group">
                            <label for="age">Age:</label>
                            <input type="number" class="form-control" name="age" id="age" required>
                        </div>

                        <div class="form-group">
                            <label for="number">Phone Number:</label>
                            <input type="tel" class="form-control" name="number" id="number"
                                pattern="\(\d{3}\) \d{3}-\d{4}"
                                title="Phone number must be formatted as (012) 345-6789." required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address:</label>
                            <input type="email" class="form-control" name="email" id="email"
                                pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"
                                title="Email must contain '@' and '.com'" required>
                        </div>

                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" name="address" id="address" required>
                        </div>

                        <div class="form-group">
                            <label for="zipcode">Zipcode:</label>
                            <input type="text" class="form-control" name="zipcode" id="zipcode" required>
                        </div>

                        <!-- <div class="invalid-feedback">
                            <h6 id="8Message" style="display:none;"></h6>
                            <h6 id="pwdMessage" style="display:none;"></h6>
                            <h6 id="firstMessage" style="display:none;"></h6>
                            <h6 id="lastMessage" style="display:none;"></h6>
                            <h6 id="diffMessage" style="display:none;"></h6>
                            <h6 id="bdayMessage" style="display:none;"></h6>
                            <h6 id="phoneMessage" style="display:none;"></h6>
                            <h6 id="emailMessage" style="display:none;"></h6>
                            <h6 id="genderMessage" style="display:none;"></h6>
                            <h6 id="addMessage" style="display:none;"></h6>
                        </div> -->

                        <button type="submit" class="btn btn-primary"
                            style="background-color:rgb(51, 157, 192); margin-left:340pt;">Submit</button>
                    </form>



                    <?php
                    include 'config.php';
                    /*
                    $servername = "127.0.0.1";
                    $username = "root";
                    $password = "";
                    $dbname = "groceryData";
                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                    }
                    */
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Get user input from the form
                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $firstName = $_POST['first'];
                        $lastName = $_POST['last'];
                        $age = $_POST['age'];
                        $phoneNumber = $_POST['number'];
                        $email = $_POST['email'];
                        $address = $_POST['address'];
                        $zipcode = $_POST['zipcode'];

                        // SQL statement to insert data into the Users table
                        $sql = "INSERT INTO Users (UserName, Password)
                                VALUES ('$username', '$password')";

                        if ($conn->query($sql) === TRUE) {
                            // Retrieve the generated CustomerID
                            $customerID = $conn->insert_id;

                            // Use the CustomerID in the SQL statement for Customers table
                            $sql2 = "INSERT INTO Customers (CustomerID, FirstName, LastName, Age, PhoneNumber, Email, Address, Zipcode)
                                    VALUES ('$customerID', '$firstName', '$lastName', '$age', '$phoneNumber', '$email', '$address', '$zipcode')";

                            // Execute the SQL statement for Customers table
                            if ($conn->query($sql2) === TRUE) {
                                echo '<script>displaySuccessMessage();</script>';
                            } else {
                                echo "Error: " . $sql2 . "<br>";
                            }
                        } else {
                            echo "Error: " . $sql . "<br>";
                        }
                    }

                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <footer>
        <h4 id="date" style="padding-top: 20px">
            <script>formatDate();</script>
        </h4>
        <h6>Anjali Massand AJM180009 & Aashritha Ananthula AXA180116</h6>
    </footer>

</body>

</html>

<!-- 
    <!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <script src="scripts/register.js"></script>
    <title>Shopper's Stop: Contact Us</title>
    <header>
        <div class="top"> 
            <img src="images/groceries.jpeg">
            <h1>Shopper's Stop</h1> 
        </div>
        
    </header>
</head>

<body>
    <link rel="stylesheet" href="mystyle.css">
    

    <div class="topnav">
        <a href="index.php">Home</a>
        <a href="freshproducts.php">Fresh Products</a>
        <a href="frozen.php">Frozen</a>
        <a href="pantry.php">Pantry</a>
        <a href="breakfastcereal.php">Breakfast & Cereal</a>
        <a href="baking.php">Baking</a>
        <a href="snacks.php">Snacks</a>
        <a href="candy.php">Candy</a>
        <a href="specialtyshops.php">Specialty Shops</a>
        <a href="deals.php">Deals</a>
        <a href="aboutus.php">About Us</a>
        <a href="contactus.php">Contact Us</a>
        <a href="myaccount.php">My Account</a>
        <a href="cart.php">Shopping Cart</a>
    </div>

    <div class="row">
        <div class="column" style="background-color:rgb(222, 221, 226)">
            <h3>Click 'Shopping Cart' tab for cart details.</h3>
            <h5 id = "added"></h5>
        </div>
        <div class="column2" style="background-color:aliceblue">
            <div>
                <h3>Create Account</h3>
                    <form name="commentForm" class="login" action="" method="post" onsubmit="return validateForm()">
                        <div class="containerLogin">
                            <dl class="list">
                                <dt><label>Username:</label></dt>
                                <dd><input type="text" name="username" id="username" style="padding: 4pt" required/></dd>
                                <dt><label>Password: </label></dt>
                                <dd><input type="text" name="password" id="password" style="padding: 4pt" required/></dd>
                                <dt><label>Re-enter Password: </label></dt>
                                <dd><input type="text" name="password2" id="password2" style="padding: 4pt" required/></dd>
                                <dt><label>First Name:</label></dt>
                                <dd><input type="text" name="first" id="first" style="padding: 4pt" required/></dd>
                                <dt><label>Last Name: </label></dt>
                                <dd><input type="text" name="last" id="last" style="padding: 4pt" required/></dd>
                                <dt><label>Date of Birth: </label></dt>
                                <dd><input type="date" name="birthday" id="birthday" style="padding: 4pt" required/></dd>
                                <dt><label>Age: </label></dt>
                                <dd><input type="number" name="age" id="age" style="padding: 4pt" required/></dd>
                                <dt><label>Phone Number: </label></dt>
                                <dd><input type="text" name="number" placeholder="(012) 345-6789" id="number" style="padding: 4pt" required/></dd>
                                <dt><label>Email Address: </label></dt>
                                <dd><input type="text" name="email" id="email" style="padding: 4pt" required/></dd>
                                <dt><label>Address: </label></dt>
                                <dd><input type="text" name="address" id="address" style="padding: 4pt" required/></dd>
                                
                                <dd><input type="submit" value="Submit" style="margin-left: 320px;" id="commentButton"></button></dd>
                            </dl>
                        </div>
                        <div style="color: red;">
                            <h6 id="8Message"></h6>
                            <h6 id="pwdMessage"></h6>
                            <h6 id="firstMessage"></h6>
                            <h6 id="lastMessage"></h6>
                            <h6 id="diffMessage"></h6>
                            <h6 id="bdayMessage"></h6>
                            <h6 id="phoneMessage"></h6>
                            <h6 id="emailMessage"></h6>
                            <h6 id="genderMessage"></h6>
                            <h6 id="addMessage"></h6>
                        </div>
                    </form>

                    <div id="successMessage" style="color: red; display: none;">
                        Registered successfully! <a href="myaccount.php">Register Now</a>
                    </div>
                    
                  
            </div>      
        </div>
    </div>

    <footer>
        <h4 id="date" style="padding-top: 20px"><script>formatDate();</script></h4>
        <h6>Anjali Massand AJM180009</h6>
    </footer>

</body>

</html>
-->