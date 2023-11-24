<!DOCTYPE html>
<html>

<head>
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
        <a href="index.html">Home</a>
        <a href="freshproducts.html">Fresh Products</a>
        <a href="frozen.html">Frozen</a>
        <a href="pantry.html">Pantry</a>
        <a href="breakfastcereal.html">Breakfast & Cereal</a>
        <a href="baking.html">Baking</a>
        <a href="snacks.html">Snacks</a>
        <a href="candy.html">Candy</a>
        <a href="specialtyshops.html">Specialty Shops</a>
        <a href="deals.html">Deals</a>
        <a href="aboutus.html">About Us</a>
        <a href="contactus.html">Contact Us</a>
        <a href="myaccount.html">My Account</a>
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
                    <form name="commentForm" class="login">
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
                                <dt><label>Phone Number: </label></dt>
                                <dd><input type="text" name="number" placeholder="(012) 345-6789" id="number" style="padding: 4pt" required/></dd>
                                <dt><label>Email Address: </label></dt>
                                <dd><input type="text" name="email" id="email" style="padding: 4pt" required/></dd>
                                <dt><label>Address: </label></dt>
                                <dd><input type="text" name="address" id="address" style="padding: 4pt" required/></dd>
                                
                                <dd><input type="button" value="Submit" style="margin-left: 320px;" id="commentButton" onclick="validateForm()"></button></dd>
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
                    
            </div>      
        </div>
    </div>

    <footer>
        <h4 id="date" style="padding-top: 20px"><script>formatDate();</script></h4>
        <h6>Anjali Massand AJM180009</h6>
    </footer>

</body>

</html>