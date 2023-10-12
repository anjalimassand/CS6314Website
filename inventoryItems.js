sessionStorage.clear();
if (!sessionStorage.getItem('inventoryList')) {
    const initialInventory = [
        { name: 'strawberries', quantity: 4, price: 3.49 },
        { name: 'grapes', quantity: 5, price: 1.99 },
        { name: 'cucumber', quantity: 6, price: 0.59 },
        // Add more items as needed
    ];
    sessionStorage.setItem('inventoryList', JSON.stringify(initialInventory));
}

function updateItemPrice(itemName) {
    const quantityInput = document.getElementById(`${itemName.toLowerCase()}-quantity`);
    const priceElement = document.getElementById(`${itemName.toLowerCase()}-price`);
    const inventory = JSON.parse(sessionStorage.getItem('inventoryList'));
    
    for (let i = 0; i < inventory.length; i++) {
        if (inventory[i].name.toLowerCase() === itemName.toLowerCase()) {
            const quantity = parseInt(quantityInput.value);
            const total = (inventory[i].price * quantity).toFixed(2);
            priceElement.textContent = `$${total}`;
            break;
        }
    }
}

function addToCart(itemName) {
    const outOfStockMessage = document.getElementById(`${itemName.toLowerCase()}-out-of-stock`);
    const quantityInput = document.getElementById(`${itemName.toLowerCase()}-quantity`);
    
    const inventory = JSON.parse(sessionStorage.getItem('inventoryList'));
    const cart = JSON.parse(sessionStorage.getItem('cartData')) || [];

    let itemIndex = -1;
    
    console.log(inventory.length);
    for (let i = 0; i < inventory.length; i++) {
        if (inventory[i].name.toLowerCase() === itemName.toLowerCase()) {
            itemIndex = i;
            break;
        }
    }
    
    if (itemIndex === -1) {
        return;
    }

    const quantity = parseInt(quantityInput.value);
    const availableQuantity = inventory[itemIndex].quantity;

    if (quantity <= availableQuantity) {
        // Update the item price based on the selected quantity
        updateItemPrice(itemName);

        // Reduce available quantity by the selected quantity
        inventory[itemIndex].quantity -= quantity;
        sessionStorage.setItem('inventoryList', JSON.stringify(inventory));

        // update cart
        const cartItem = {
            name: itemName,
            quantity: quantity,
            price: inventory[itemIndex].price
        };
        cart.push(cartItem);
        sessionStorage.setItem('cartData', JSON.stringify(cart));


        // Reset the product quantity input to 1 for the next selection
        quantityInput.value = 1;

        // Hide the "Out of Stock" message if it was displayed
        outOfStockMessage.style.display = "none";
    } else {
        // Display out of stock message
        outOfStockMessage.textContent = availableQuantity + " available";
        outOfStockMessage.style.display = "block";
    }
}
