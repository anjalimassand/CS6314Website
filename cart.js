document.addEventListener("DOMContentLoaded", function() {
    // Retrieve cart data from session storage
    const cartData = JSON.parse(sessionStorage.getItem('cartData'));

    if (cartData && cartData.length > 0) {
        const cartTable = document.getElementById('cartTable').getElementsByTagName('tbody')[0];
        let subtotal = 0;

        // Loop through cart items and add them to the table
        cartData.forEach(item => {
            const row = cartTable.insertRow(-1);
            // Create the name cell
            const nameCell = row.insertCell(0);
            nameCell.innerHTML = item.name;

            // Create the quantity cell and set the class for center alignment
            const quantityCell = row.insertCell(1);
            quantityCell.innerHTML = item.quantity;
            quantityCell.classList.add('centerColumn'); // Add the 'centered' class

            nameCell.innerHTML = item.name;
            quantityCell.innerHTML = item.quantity;
            const itemTotal = item.price * item.quantity;
            const priceCell = row.insertCell(2);
            priceCell.innerHTML = `$${itemTotal.toFixed(2)}`;
            subtotal += itemTotal;
            
            // Create the price cell and set the class for center alignment
            
            priceCell.classList.add('centerColumn'); // Add the 'centered' class

            
        });

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
