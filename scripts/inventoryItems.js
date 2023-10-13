if (!sessionStorage.getItem('inventoryList')) {
    const initialInventory = [
        // fresh products
        { name: 'strawberries', quantity: 10, price: 3.49 },
        { name: 'grapes', quantity: 10, price: 4.99 },
        { name: 'cucumber', quantity: 10, price: 0.59 },
        { name: 'watermelon', quantity: 10, price: 5.00 },
        { name: "apples", quantity: 10, price: 3.99 },
        { name: "pineapple", quantity: 10, price: 3.99 },
        { name: "broccoli", quantity: 10, price: 1.23 },
        { name: "lettuce", quantity: 10, price: 1.79 },
        { name: "cucumber", quantity: 10, price: 0.59 },
        { name: "tulips", quantity: 7, price: 12.00 },
        { name: "lilies", quantity: 8, price: 4.97 },
        { name: "daisies", quantity: 9, price: 7.49 },
        { name: "guacamole", quantity: 10, price: 3.99 },
        { name: "hummus", quantity: 10, price: 3.50 },
        { name: "salsa", quantity: 10, price: 1.59 },
        { name: "pumpkin", quantity: 6, price: 4.99 },  
        { name: "gourmet mushrooms", quantity: 5, price: 3.99 },

        { name: "frozen pancakes", price: 5.99 },
        { name: "waffles", price: 4.29 },
        { name: "breakfast burritos", price: 1.25 },
        { name: "gelato", price: 5.99 },
        { name: "ice cream cones", price: 5.99 },
        { name: "cheesecake", price: 5.99 },
        { name: "Pepperoni pizza", price: 4.99 },
        { name: "four Cheese pizza", price: 4.99 },
        { name: "four meat pizza", price: 4.99 },
        { name: "frozen meatballs", price: 4.99 },
        { name: "chicken strips", price: 9.99 },
        { name: "popcorn shrimp", price: 3.99 },
        

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
         //   priceElement.textContent = `$${total}`;
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
    
    console.log(inventory);
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
