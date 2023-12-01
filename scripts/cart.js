$(document).ready(function () {
    // Retrieve cart data from session storage
    const cartData = JSON.parse(sessionStorage.getItem('cartData'));
    let subtotal = 0;

    if (cartData && cartData.length > 0) {
        const cartTable = $('#cartTable tbody');

        const groupedCart = groupCartItems(cartData);

        $.each(groupedCart, function (index, item) {
            const row = cartTable[0].insertRow(-1);
            const nameCell = row.insertCell(0);
            const quantityCell = row.insertCell(1);
            const priceCell = row.insertCell(2);

            nameCell.innerHTML = item.name;
            quantityCell.innerHTML = item.quantity;

            $(quantityCell).addClass('centerColumn');

            const itemTotal = item.price * item.quantity;
            priceCell.innerHTML = `$${itemTotal.toFixed(2)}`;

            $(priceCell).addClass('centerColumn');

            subtotal += itemTotal;
        });

        const taxRate = 0.08;
        const tax = subtotal * taxRate;

        // Calculate total price
        const total = subtotal + tax;

        // Display tax and total in the table
        const taxRow = cartTable[0].insertRow(-1);
        const taxLabelCell = taxRow.insertCell(0);
        const empty = taxRow.insertCell(1);
        const taxAmountCell = taxRow.insertCell(2);
        taxLabelCell.innerHTML = 'Tax (8%)';
        taxAmountCell.innerHTML = `$${tax.toFixed(2)}`;

        $(taxAmountCell).addClass('centerColumn');

        const totalRow = cartTable[0].insertRow(-1);
        const totalLabelCell = totalRow.insertCell(0);
        const empty1 = totalRow.insertCell(1);
        const totalAmountCell = totalRow.insertCell(2);
        totalLabelCell.innerHTML = 'Total';
        totalAmountCell.innerHTML = `$${total.toFixed(2)}`;

        $(totalAmountCell).addClass('centerColumn');
    }

    $('.checkoutButton').on('click', function () {
        const cartData = JSON.parse(sessionStorage.getItem('cartData')) || [];

        if (cartData.length === 0) {
            alert("Cannot checkout empty cart.");
            return;
        }
        // Retrieve cart data from session storage
        //    const cartData = JSON.parse(sessionStorage.getItem('cartData'));

        // Check if cartData exists
        if (cartData) {
            // Send cartData to the server using AJAX
            $.ajax({
                type: 'POST',
                url: 'cart.php',
                data: { cartData: JSON.stringify(cartData) },
                success: function (response) {
                    console.log('Cart data sent successfully.');
                },
                error: function (error) {
                    console.error('Error sending cart data:', error);
                }
            });
        }

        console.log(cartData);
        // Clear cart
        sessionStorage.removeItem('cartData');
        $('#cartTable tbody').empty();

        // change status to shopped
        changeTransactionShopped();
        changeCartShopped();
    });

    $('.clearButton').on('click', function () {
        const cartData = JSON.parse(sessionStorage.getItem('cartData')) || [];

        if (cartData.length === 0) {
            alert("Cart is already empty.");
            return;
        }
        sessionStorage.removeItem('cartData');

        // Retrieve inventoryList data from session storage
        const inventoryList = JSON.parse(sessionStorage.getItem('inventoryList'));

        if (inventoryList) {
            // Add the values back to inventoryList
            $.each(cartData, function (index, item) {
                const existingItem = inventoryList.find(function (inventoryItem) {
                    // console.log(inventoryItem.name);
                    // console.log(item.name);
                    return inventoryItem.name === item.name.toLowerCase();
                });

                if (existingItem) {
                    existingItem.quantity += item.quantity;
                    console.log(existingItem.quantity);
                }
            });

            // Update the inventoryList data in session storage
            sessionStorage.setItem('inventoryList', JSON.stringify(inventoryList));
        }

        $('#cartTable tbody').empty();

        // add items in cart data back to inventory db
        addBackInventory();
        // change transaction status to cancelled
        cancelTransaction();
        // change cart status to cancelled
        cancelCart();
    });

});

function groupCartItems(cartData) {
    const groupedCart = [];

    $.each(cartData, function (index, item) {
        const existingItem = groupedCart.find(function (groupedItem) {
            return groupedItem.name === item.name;
        });

        if (existingItem) {
            // Item with the same name is already in groupedCart, update the quantity
            existingItem.quantity += item.quantity;
        } else {
            // Item is not in groupedCart, add it
            groupedCart.push({ name: item.name, quantity: item.quantity, price: item.price });
        }
    });

    return groupedCart;
}

// Function to cancel transaction
function cancelTransaction() {
    // Create an XMLHttpRequest object
    const xhr = new XMLHttpRequest();

    // Configure it to send a POST request to your PHP script
    xhr.open('POST', 'cancelTransaction.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    // Set up a callback function to handle the response from the server
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Successful response from the server
                console.log(xhr.responseText);
            } else {
                // Handle errors
                console.error('Error cancelling transaction status:', xhr.responseText);
            }
        }
    };

    // Send the request without any request data
    xhr.send();
}

// Function to cancel transaction
function cancelCart() {
    // Create an XMLHttpRequest object
    const xhr = new XMLHttpRequest();

    // Configure it to send a POST request to your PHP script
    xhr.open('POST', 'cancelCartStatus.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    // Set up a callback function to handle the response from the server
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Successful response from the server
                console.log(xhr.responseText);
            } else {
                // Handle errors
                console.error('Error cancelling cart status:', xhr.responseText);
            }
        }
    };

    // Send the request without any request data
    xhr.send();
}

function changeTransactionShopped() {
    // Create an XMLHttpRequest object
    const xhr = new XMLHttpRequest();

    // Configure it to send a POST request to your PHP script
    xhr.open('POST', 'shoppedTransaction.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    // Set up a callback function to handle the response from the server
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Successful response from the server
                console.log(xhr.responseText);
            } else {
                // Handle errors
                console.error('Error updating status to shopped (transaction):', xhr.responseText);
            }
        }
    };

    // Send the request without any request data
    xhr.send();
}

function changeCartShopped() {
    // Create an XMLHttpRequest object
    const xhr = new XMLHttpRequest();

    // Configure it to send a POST request to your PHP script
    xhr.open('POST', 'shoppedCart.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    // Set up a callback function to handle the response from the server
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Successful response from the server
                console.log(xhr.responseText);
            } else {
                // Handle errors
                console.error('Error updating status to shopped (cart):', xhr.responseText);
            }
        }
    };

    // Send the request without any request data
    xhr.send();
}

function addBackInventory() {
    // Create an XMLHttpRequest object
    const xhr = new XMLHttpRequest();

    // Configure it to send a POST request to your PHP script
    xhr.open('POST', 'cancelInventory.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    // Set up a callback function to handle the response from the server
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Successful response from the server
                console.log(xhr.responseText);
            } else {
                // Handle errors
                console.error('Error adding back inventory:', xhr.responseText);
            }
        }
    };

    // Send the request without any request data
    xhr.send();
}