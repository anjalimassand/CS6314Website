document.addEventListener("DOMContentLoaded", function() {
    const products = [
        { name: "Frozen Pancakes", price: 5.99, imageSrc: "images/frozenpancakes.webp", mainCat: "Frozen", category: ["rollbacks", "breakfast", "meals"]},
        { name: "Waffles", price: 4.29, imageSrc: "images/waffles.png", mainCat: "Frozen", category: ["meals", "breakfast"]},
        { name: "Breakfast Burritos", price: 1.25, imageSrc: "images/burrito.png", mainCat: "Frozen", category: ["meals", "breakfast"]},
        { name: "Gelato", price: 5.99, imageSrc: "images/gelato.png", mainCat: "Frozen", category: ["dessert", "rollbacks"] },
        { name: "Ice Cream Cones", price: 5.99, imageSrc: "images/icecream.png", mainCat: "Frozen", category: ["dessert", "snacks"]},
        { name: "Cheesecake", price: 5.99, imageSrc: "images/cheesecake.png", mainCat: "Frozen", category: ["dessert", "snacks"]},
        { name: "Pepperoni Pizza", price: 4.99, imageSrc: "images/pepperoni.png", mainCat: "Frozen", category: ["pizza", "meals"]},
        { name: "Four Cheese Pizza", price: 4.99, imageSrc: "images/fourcheese.png", mainCat: "Frozen", category: ["pizza", "meals"]},
        { name: "Four Meat Pizza", price: 4.99, imageSrc: "images/fourmeat.png", mainCat: "Frozen", category: ["pizza", "meals"]},
        { name: "Frozen Meatballs", price: 4.99, imageSrc: "images/meatballs.png", mainCat: "Frozen", category: ["meat", "rollbacks"]},
        { name: "Chicken Strips", price: 9.99, imageSrc: "images/chicken.png", mainCat: "Frozen", category: ["snacks", "meat"]},
        { name: "Popcorn Shrimp", price: 3.99, imageSrc: "images/shrimp.png", mainCat: "Frozen", category: ["snacks", "meat"] },
        
    ];

    const productCardsContainer = document.getElementById("productCards");

    products.forEach(product => {
        const card = document.createElement("div");
        card.classList.add("columnCard");
        card.classList.add("card");
        card.classList.add("filterDiv");
        card.classList.add(product.category); 
        card.setAttribute("name", product.name);

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

        productCardsContainer.appendChild(card);
        filterSelection("all");
    });
});
