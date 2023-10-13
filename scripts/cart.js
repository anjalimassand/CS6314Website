document.addEventListener("DOMContentLoaded", function() {
    // Retrieve cart data from session storage
    const cartData = JSON.parse(sessionStorage.getItem('cartData'));
    let subtotal = 0;
    if (cartData && cartData.length > 0) {
        const cartTable = document.getElementById('cartTable').getElementsByTagName('tbody')[0];
        const groupedCart = groupCartItems(cartData);
        
        for (const item of groupedCart) {
            const row = cartTable.insertRow(-1);
            const nameCell = row.insertCell(0);
            const quantityCell = row.insertCell(1);
            const priceCell = row.insertCell(2);

            nameCell.innerHTML = item.name;
            quantityCell.innerHTML = item.quantity;
            quantityCell.classList.add('centerColumn');
            const itemTotal = item.price * item.quantity;
            priceCell.innerHTML = `$${itemTotal.toFixed(2)}`;
            priceCell.classList.add('centerColumn');
            subtotal += itemTotal;
        }

        // Calculate tax (replace 0.08 with your tax rate)
        const taxRate = 0.08; // 8% tax rate
        const tax = subtotal * taxRate;

        // Calculate total price
        const total = subtotal + tax;

        // Display tax and total in the table
        const taxRow = cartTable.insertRow(-1);
        const taxLabelCell = taxRow.insertCell(0);
        const empty = taxRow.insertCell(1);
        const taxAmountCell = taxRow.insertCell(2);
        taxLabelCell.innerHTML = 'Tax (8%)';
        taxAmountCell.innerHTML = `$${tax.toFixed(2)}`;
        taxAmountCell.classList.add('centerColumn');

        const totalRow = cartTable.insertRow(-1);
        const totalLabelCell = totalRow.insertCell(0);
        const empty1 = totalRow.insertCell(1);
        const totalAmountCell = totalRow.insertCell(2);
        totalLabelCell.innerHTML = 'Total';
        totalAmountCell.innerHTML = `$${total.toFixed(2)}`;
        totalAmountCell.classList.add('centerColumn');
    }
});

function groupCartItems(cartData) {
    const groupedCart = [];

    for (const item of cartData) {
        const existingItem = groupedCart.find((groupedItem) => groupedItem.name === item.name);

        if (existingItem) {
            // Item with the same name is already in groupedCart, update the quantity
            existingItem.quantity += item.quantity;
        } else {
            // Item is not in groupedCart, add it
            groupedCart.push({ name: item.name, quantity: item.quantity, price: item.price });
        }
    }

    return groupedCart;
}