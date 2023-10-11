// Define the inventory object
const inventory = {
    strawberries: 4,
    grapes: 5,
    cucumber: 6,
    // Add more items as needed
};

function addToCart(itemName) {
    outOfStockMessage.style.display = "none";
    const outOfStockMessage = document.getElementById(`${itemName.toLowerCase()}-out-of-stock`);
//  const cart = document.getElementById("cart");
    const quantityInput = document.getElementById(`${itemName.toLowerCase()}-quantity`);
    
    let availableQuantity = inventory[itemName.toLowerCase()]; // Get available quantity from inventory display
    let quantity = parseInt(quantityInput.value); // Get the selected product quantity

    console.log(availableQuantity);
    console.log(quantity);
    if (quantity > availableQuantity) {
        // Display out of stock message
        outOfStockMessage.textContent = availableQuantity + " available";
        outOfStockMessage.style.display = "block";
    }
    else if (quantity <= availableQuantity) {
        // Reduce available quantity by the selected quantity
        availableQuantity -= quantity;
        inventory[itemName.toLowerCase()] = availableQuantity; // Update the inventory object

        // Reset the product quantity input to 1 for the next selection
        quantityInput.value = 1;

        // Hide the "Out of Stock" message if it was displayed
        outOfStockMessage.style.display = "none";
    } else {
        // Display out of stock message
        outOfStockMessage.textContent = "Out of Stock";
        outOfStockMessage.style.display = "block";
    } 
}