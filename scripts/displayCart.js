$(document).ready(function () {
    // Add click event for delete buttons
    $('.deleteButton').on('click', function () {
        // Get the CartID associated with the clicked button
        const cartID = $(this).data('cartid');
        console.log(cartID);

        const itemName = $(this).data('itemname');

        const cart = JSON.parse(sessionStorage.getItem('cartData')) || [];
        // Find the index of the item in cartData
        const indexToRemove = cart.findIndex(item => item.name === itemName);

        // Remove the item from cartData
        if (indexToRemove !== -1) {
            cart.splice(indexToRemove, 1);
            // Update the sessionStorage with the modified cartData
            sessionStorage.setItem('cartData', JSON.stringify(cart));
        }

        // Call a function to handle the deletion
        deleteCartItem(cartID);

    });
});

// Function to handle the deletion of the cart item
function deleteCartItem(cartID) {
    // Make an AJAX request to delete the item on the server
    $.ajax({
        type: 'POST',
        url: 'deleteCartItem.php', 
        data: { cartID: cartID },
        success: function (response) {
            console.log(response);

            // Reload the page or update the cart display as needed
            location.reload(); 
        },
        error: function (error) {
            console.error('Error deleting item:', error);
        }
    });
}
