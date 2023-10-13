document.addEventListener("DOMContentLoaded", function() {
    // Define the product data, for example:
    const products = [
        { name: "Frozen Pancakes", price: 5.99, imageSrc: "images/frozenpancakes.webp", mainCat: "Frozen", category: ["rollbacks", "breakfast"]},
       
        { name: "Gelato", price: 5.99, imageSrc: "images/gelato.png", mainCat: "Frozen", category: ["dessert", "snacks"] },
       
      //  { name: "Watermelon", price: 5.00, imageSrc: "images/watermelon.png", mainCat: "Frozen", category: "precut" },
        
    ];

    // Get the container for product cards
    const productCardsContainer = document.getElementById("productCards");

    // Loop through the product data and create card elements
    products.forEach(product => {
        const card = document.createElement("div");
        card.classList.add("columnCard");
        card.classList.add("card");
        card.classList.add("filterDiv");
        card.classList.add(product.category); // Assign the category dynamically
        card.setAttribute("name", product.name);

        // Create card content
        card.innerHTML = `
            <img src="${product.imageSrc}" alt="Avatar" width="100%" height="180">
            <div class="container">
                <h4><b>${product.name}</b></h4>
                <p id="${product.name.toLowerCase()}-price">$${product.price.toFixed(2)}</p>
                <input type="number" class="center" id="${product.name.toLowerCase()}-quantity" min="1" max="10" value="1">
                <button type="button" class="center" onclick="addToCart('${product.name}')">Add to Cart</button>
                <p class="out-of-stock-message" id="${product.name.toLowerCase()}-out-of-stock"></p>
            </div>
        `;

        // Append the card to the product cards container
        productCardsContainer.appendChild(card);
    });
});
