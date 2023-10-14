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

        { name: "frozen pancakes", quantity: 6, price: 5.99 },
        { name: "waffles", quantity: 6, price: 4.29 },
        { name: "breakfast burritos", quantity: 6, price: 1.25 },
        { name: "gelato", quantity: 6, price: 5.99 },
        { name: "ice cream cones", quantity: 10, price: 5.99 },
        { name: "cheesecake", quantity: 6, price: 5.99 },
        { name: "pepperoni pizza", quantity: 10, price: 4.99 },
        { name: "four cheese pizza", quantity: 10, price: 4.99 },
        { name: "four meat pizza", quantity: 10, price: 4.99 },
        { name: "frozen meatballs", quantity: 10, price: 4.99 },
        { name: "chicken strips", quantity: 10, price: 9.99 },
        { name: "popcorn shrimp", quantity: 6, price: 3.99 },

        { name: "hummus", quantity: 10, price: 3.50 },
        { name: "butter", quantity: 10, price: 3.99 },
        { name: "guacamole", quantity: 10, price: 3.99 },
        { name: "ketchup", quantity: 10, price: 3.29 },
        { name: "penne pasta", quantity: 8, price: 1.25 },
        { name: "spaghetti pasta", quantity: 8, price: 1.50 },
        { name: "rotini pasta", quantity: 8, price: 1.50 },
        { name: "canned grean beans", quantity: 10, price: 0.89 },
        { name: "canned corn", quantity: 10, price: 0.89 },
        { name: "canned peas", quantity: 10, price: 1.59 },
        { name: "alfredo sauce", quantity: 10, price: 2.99 },
        { name: "beef soup", quantity: 10, price: 2.00 },
        { name: "tomato basil soup", quantity: 10, price: 2.19 },
        { name: "mustard", quantity: 10, price: 0.99 },
        { name: "mayonnaise", quantity: 10, price: 3.99 },
       
        { name: "cheerios cereal", quantity: 10, price: 4.99 },
        { name: "crunch berries", quantity: 10, price: 3.99 },
        { name: "raisin bran", quantity: 10, price: 2.50 },
        { name: "pancake mix", quantity: 10, price: 4.99 },
        { name: "waffle mix", quantity: 10, price: 2.89 },
        { name: "maple syrup", quantity: 10, price: 6.49 },
        { name: "strawberry oatmeal", quantity: 10, price: 1.67 },
        { name: "caramel oatmeal", quantity: 10, price: 7.99 },
        { name: "granola bars", quantity: 10, price: 10.99 },
        { name: "croissants", quantity: 10, price: 4.99 }, 
        { name: "bagels", quantity: 10, price: 4.79 },
        { name: "muffins", quantity: 10, price: 4.99 },
        
        { name: "pumpkin mix", quantity: 10, price: 3.99 },
        { name: "pie crust", quantity: 10, price: 5.29 },
        { name: "pie crusts", quantity: 10, price: 3.49 },
        { name: "pan", quantity: 10, price: 7.99 },
        { name: "circular pan", quantity: 10, price: 4.99 },
        { name: "pudding/pie filling mix", quantity: 10, price: 1.67 },

        { name: "snickers", quantity: 6, price: 4.49 },
        { name: "kitkat", quantity: 6, price: 4.49 },
        { name: "jolly rancher", quantity: 6, price: 3.49 },
        { name: "nerds", quantity: 6, price: 1.25 },
        { name: "reeses", quantity: 6, price: 4.49 },
        { name: "butterfinger", quantity: 6, price: 4.49 },

        { name: "oreo cookies", quantity: 10, price: 3.49 },
        { name: "lays chips", quantity: 10, price: 3.99 },
        { name: "animal crackers", quantity: 10, price: 3.59 },
        { name: "pretzel crips", quantity: 10, price: 3.99 },
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
